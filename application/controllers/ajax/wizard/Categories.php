<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 30.10.15
 * Time: 11:30
 */

class Categories extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'categories'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");

        $this->result = array();
    }

    public function display_all()
    {
        $data['categories'] = $this->read_all();
        $data['wizards'] = $this->read_custom('SELECT wizard.name as wizard_name
                        FROM wizard, wizard_categories, categories
                        WHERE wizard.id=wizard_categories.id_wizard
                        AND categories.id=wizard_categories.id_categories');
        if(empty($data['categories'])):
            echo 'Для отображения списка категорий нужно создать хотя бы одну категорию!';
        else:
            $this->load->view('admin_panel/wizard/wizard_categories_list_view', $data);
        endif;
    }

    public function add_new_category()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }
            $data = $this->input->post();

            if(is_null($data) || $this->_validate_categories() === FALSE)
            {
                throw new Exception("Invalid data");
            }

            if($this->create($data))
            {
                $id = $this->_get_id($data);
                if(!is_numeric($id) || is_null($id) || strlen($id) > 5)
                {
                    throw new Exception("Invalid id");
                }

                $data['picture'] = $this->_do_upload($id);

                if(!empty($data['picture']))
                {
                    if($this->update($id, $data))
                    {
                        $this->result = array("message" => "Category was create successfully");
                        echo $this->result['message'];
                    }
                    else
                    {
                        throw new Exception("Can't add new category");
                    }
                }
            }
            else
            {
                throw new Exception("Can`t add new category");
            }

        }
        catch(Exception $exp)
        {
            if(!empty($id))
            {
                $this->delete($id);
            }
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _get_id($data)
    {
        $query_str = $this->db->select("id")->from($this->tbname)->where("name", $data['name'])->limit(1)->order_by('id', 'DESC');

        $id = $this->read_custom_($query_str);

        return (int)$id[0]->id;
    }

    private function _do_upload($id)
    {
        $config['upload_path']   = 'download/wizard_images/categories';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 50;
        $config['max_width']     = 100;
        $config['max_height']    = 100;
        $config['file_name']     = $id."_category_image";

        $this->load->library('upload', $config);
        if($this->upload->do_upload('image'))
        {
            $pic_data = $this->upload->data();
            chmod($pic_data['full_path'], 0777);

            return $pic_data['file_name'];
        }
        else
        {
            throw new Exception("Invalid image data. Image was not save.");
        }
    }

    public function delete_category()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(is_null($data) || !is_numeric($data['id']) || strlen($data['id']) > 2)
            {
                throw new Exception("Invalid data!");
            }

            if($this->_delete_picture($data['id']) === TRUE)
            {
                if($this->delete($data['id']))
                {
                    $this->result = array("message" => "Category was delete successfully.");
                    echo $this->result['message'];
                }
                else
                {
                    throw new Exception("Can't delete a category.");
                }
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _delete_picture($id)
    {
        $picture_name = $this->_get_picture_name($id);
        if(empty($picture_name))
        {
            return FALSE;
        }

        if(unlink("download/wizard_images/categories/" . $picture_name) === TRUE)
        {
            return TRUE;
        }
    }

    private function _get_picture_name($id)
    {
        $query_str = $this->db->select("picture")->from($this->tbname)->where("id", $id)->limit(1);
        $picture = $this->read_custom_($query_str);

        return $picture[0]->picture;
    }

    public function get_one_category()
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE) {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if (!is_numeric($data['id']) || strlen($data['id']) > 5) {
                throw new Exception("Invalid data!");
            }

            $data['category'] = $this->read_one($data['id']);

            if(empty($data['category'][0]))
            {
                throw new Exception("Failure of data wizard");
            }

            $this->load->view("admin_panel/wizard/wizard_categories_edit_view", $data);

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    public function edit_category()
    {
        try {
            if ($this->input->is_ajax_request() === FALSE) {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(is_numeric($data['id']) || strlen($data['id']) <= 5)
            {
                if($_FILES['image']['error'] === 0) {
                    foreach (array('gif', 'jpg', 'png') as $format){

                        $file_path = base_url() . "download/wizard_images/categories" . $data['id'] . "_category_image." . $format;
                        $headers = @get_headers($file_path);

                        if (preg_match("|200|", $headers[0]))
                        {
                            if (strpos($headers[0], '200'))
                            {
                                unlink("download/wizard_images/categories".$data['id']."_category_image.".$format);
                                break;
                            }
                        }
                    }
                    $data['picture'] = $this->_do_upload($data['id']);
                }

                if($this->update($data['id'], $data) === FALSE)
                {
                    throw new Exception("Data was not update");
                }
                else
                {
                    $this->result = array("message" => "Wizard was update successfully");
                    echo $this->result['message'];
                }
            }
        }
        catch(Exeption $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validate_categories()
    {
        $this->form_validation->set_rules(
            "name",
            "Категория мастера заказов",
            "required|trim|max_length[100]|xss_clean"
        );
        return $this->form_validation->run();
    }
}