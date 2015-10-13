<?

defined("BASEPATH") or exit("No direct script access allowed");

class View extends CI_Controller
{
    public function admin($page_name)
    {
        switch($page_name):
        case 'pages_list_view': $this->_pages_list(); break;
        endswitch;

    }

    private function _pages_list()
    {
        $this->load->model('Pages_model');
        $data['pages'] = $this->Pages_model->get();
        $this->load->view('admin_panel/pages/pages_list_view');
    }

    public function roles_list()
    {
        $this->load->model("Roles_model");
        $data['roles'] = $this->Roles_model->gel_all();
        $this->load->view("admin_panel/roles_list_view", $data);
    }
}