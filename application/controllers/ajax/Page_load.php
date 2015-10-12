<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 12.10.15
 * Time: 14:24
 */

class Page_load extends CI_Controller
{
    public function admin($page_name)
    {
        switch($page_name):
            case 'menu': $this->_menu();
        endswitch;
    }

    private function _menu()
    {
        $this->load->view('admin_panel/pages/menu_view');
    }
}