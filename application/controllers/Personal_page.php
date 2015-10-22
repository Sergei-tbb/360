<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 20.10.15
 * Time: 22:15
 */
class Personal_page extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(array('tbname' => 'users'));
        $this->load->library('session');

    }

    public function index()
    {
        if($this->session->has_userdata('id'))
        {
            if($this->read_one($this->session->userdata('id')))
            {
                $data['user'] = $this->read_one($this->session->userdata('id'));
                $data['contractors'] = $this->read_custom("SELECT * FROM users_contractors WHERE id_user='{$this->session->userdata('id')}'");
                $data['phones'] = $this->read_custom("SELECT * FROM users_phones, phones WHERE id_user='{$this->session->userdata('id')}' AND users_phones.id_phone=phones.id");
                $this->load->view('personal_page/header_view');
                $this->load->view('personal_page/index_view', $data);
                $this->load->view('personal_page/footer_view');
            }
        }
    }
}