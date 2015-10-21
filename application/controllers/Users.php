<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 19.10.15
 * Time: 15:30
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Users extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'users'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('email');

        $this->result = array();
    }


    public function registration_view()
    {
        $this->load->helper('string');
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data['token'] = random_string('alnum', 32);

            if(!empty($data['token']))
            {
                $this->load->view('index_page/registration_view', $data);
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }

    }
    /**
     * method for registration new user
     */
    public function add_user()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $session_token = array(
                'token' => $data['token'],
                'email' => $data['email']
            );

            $this->session->set_userdata($session_token);

            if ($this->_validation_user() === false)
            {
                throw new Exception("Invalid data!");
            }

            $select_count = "SELECT COUNT(*) as count FROM users WHERE email='{$data['email']}'";

            $result_count = $this->read_custom($select_count);

            $password = $this->encrypt->encode($data['password']);

            $date = date('Y-m-d');

            if($result_count['0']->count==0)
            {
                $new_user = array(
                    'email' => $data['email'],
                    'password' => $password,
                    'name' => $data['name'],
                    'reg_date' => $date
                );

                if ($this->create($new_user))
                {
                    $this->result = array("message" => "Чтобы продолжить регистрацию перейдите на свой почтовый ящик({$data['email']}) и подтвердите свой аккаунт.");
                    echo $this->result['message'];
                    $this->_sending_email($data['email'], $data['token']);
                }
                else
                {
                    throw new Exception("Ошибка при завершении регистрации!");
                }
            }
            else
            {
                throw new Exception("Пользователь с таким почтовым ящиком уже зарегистрирован!");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $email
     * method for sending email to new user
     */
    private function _sending_email($email, $token)
    {
        $this->email->initialize();
        $this->email->from('registration@360.com.ua', '360dpi');
        $this->email->to($email);

        $this->email->subject('Email Test');
        $this->email->message("http://360dpi/users/verification?token={$token}");

        $this->email ->send();
    }

    public function verification()
    {
        $token = $this->input->get();
        if($token['token']==$this->session->userdata('token'))
        {
            $email = $this->session->userdata('email');
            $select_email = "SELECT COUNT(*) as count FROM users WHERE email='{$email}'";
            $result = $this->read_custom($select_email);

            if($result['0']->count==1)
            {
                $update_data = array('is_verify' => 1);
                $update_where = array('email' => $email);
                if($this->update_custom($update_data, $update_where))
                {
                    echo 'Вы успешно зарегистрированы!';
                    $this->session->sess_destroy();
                }
            }
        }
        else
        {
            header('Content-type: text/html', 404);
        }
    }

    public function authorization()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $select_count = "SELECT COUNT(*) as count, password, is_verify, id FROM users WHERE email='{$data['email']}'";

            $result = $this->read_custom($select_count);

            if($result['0']->count==1)
            {
                if($result['0']->is_verify==1)
                {
                    $db_pass = $this->encrypt->decode($result['0']->password);
                    if ($db_pass == $data['password'])
                    {
                        echo 'ok';
                        $session_id = array(
                            'id' => $result['0']->id,
                        );

                        $this->session->set_userdata($session_id);
                    }
                    else
                    {
                        echo 'Неверный email или пароль!';
                    }
//                    header("Location:".base_url());
                }
                elseif($result['0']->is_verify==0)
                {
                    throw new Exception("Для успешной авторизации Вы должны завершить регистрацию!");
                }
            }
            else
            {
                 echo "Пользователь с почтовым ящиком {$data['email']} не зарегистрирован!";
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function logout()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }
            if($this->session->has_userdata('id'))
            {
                $this->result = array('message' => 'Вы успешно вышли из своей учетной записи');
                echo $this->result['message'];
                $this->session->unset_userdata('id');
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function send_reset()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $select_user = "SELECT COUNT(*) as count, id FROM users WHERE email='{$data['email']}'";
            $user = $this->read_custom($select_user);

            if($user['0']->count==1)
            {
                $this->email->initialize();
                $this->email->from('password@360.com.ua', '360dpi');
                $this->email->to($data['email']);

                $this->email->subject('Email Test');
                $this->email->message("http://360dpi/users/recovery_password?id={$user['0']->id}");

                if($this->email ->send())
                {
                    echo 'Письмо с инструкциями по восстановлению пароля успешно отправлены!';
                }
                else
                {
                    throw new Exception("Ошибка при отправке письма с инстукциями по восстановлению пароля! Попробуйте повторить операцию позже.");
                }
            }
            elseif($user['0']->count==0)
            {
                throw new Exception("Такого пользователя не существует! Проверьте правильность введенных данных и попробуйте снова");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function recovery_password()
    {
        try
        {
            $data = $this->input->get();

            if(empty($data['id']))
            {
                header('Content-type: text/html', 404);
            }
            else
            {
                $this->load->view('index_page/header_view');
                $this->load->view('index_page/recovery_password_view', $data);
                $this->load->view('index_page/footer_view');
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function save_new_password($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(!empty($id) and !empty($data['password']))
            {
                if ($this->update_custom(array('password' => $this->encrypt->encode($data['password'])), array('id' => $id)))
                {
                    $this->result = array('message' => 'Пароль успешно восстановлен! Вы можете войти в свою учетную запись');
                    echo $this->result['message'];
                }
            }
            else
            {
                throw new Exception("При сбросе пароля произошла ошибка! Попробуйте позже.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validation_user()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Пароль', 'required');
        $this->form_validation->set_rules('name', 'Имя пользователя', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function load_user_data($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->read_one($id))
            {
                $data['user'] = $this->read_one($id);
                $data['id'] = $id;
                $data['phone'] = $this->read_custom("SELECT * FROM users_phones, phones WHERE users_phones.id_phone=phones.id AND users_phones.id_user={$id}");
                $this->load->view('personal_page/user_data_view', $data);
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_user_data($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $user_data = array(
                'name' => $data['name'],
                'middlename' => $data['middlename'],
                'surname' => $data['surname'],
                'email' => $data['email']
            );

            if($this->update($id, $user_data))
            {
                if($this->update_free_custom("UPDATE phones SET phone={$data['phone']} WHERE id={$data['id_phone']}"))
                {
                    $this->result = array('message' => 'Данные пользователя успешно обновлены');
                    echo $this->result['message'];
                }
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function new_contractor_view($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data['id'] = $id;
            $this->load->view('personal_page/new_contractor_view', $data);
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function add_contractor($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $contractor_data = array(
                'id_user' => $id,
                'name' => $data['name'],
                'middlename' => $data['middlename'],
                'surname' => $data['surname'],
                'email' => $data['email'],
            );

            $contractor_phone = array(
                'phone' => $data['phone'],
                'is_main' => 1,
                'is_notify' => 1
            );

            if($this->create_custom('users_contractors', $contractor_data))
            {
                if($this->read_custom("SELECT id FROM users_contractors WHERE email='{$contractor_data['email']}'"))
                {
                    $contractor = $this->read_custom("SELECT id FROM users_contractors WHERE email='{$contractor_data['email']}'");
                    if(!empty($contractor['0']->id))
                    {
                        if($this->create_custom('phones', $contractor_phone))
                        {
                            if($this->read_custom("SELECT id FROM phones WHERE phone='{$contractor_phone['phone']}'"))
                            {
                                $phones = $this->read_custom("SELECT id FROM phones WHERE phone='{$contractor_phone['phone']}'");
                                $phones_data = array('id_users_contactors' => $contractor['0']->id, 'id_phones' => $phones['0']->id);
                                if($this->create_custom('contractor_phones', $phones_data))
                                {
                                    echo 'Подрядчик успешно добвлен!';
                                }

                            }
                        }
                    }
                }
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_password_view($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if(!empty($id))
            {
                $data['id'] = $id;
                $this->load->view('personal_page/update_password_view', $data);
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_password($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->read_one($id))
            {
                $user_data = $this->read_one($id);
                $old_password = $this->encrypt->decode($user_data['0']->password);

                if($old_password==$data['old_password'])
                {
                    if($this->update($id, array('password' => $this->encrypt->encode($data['new_password']))))
                    {
                        $this->result = array('message' => 'Password was successfully updated');
                        echo $this->result['message'];
                    }
                }
                else
                {
                    throw new Exception('Введите правильный старый пароль!');
                }
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }
}