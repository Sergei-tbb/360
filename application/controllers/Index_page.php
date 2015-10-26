<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_page extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct(array('tbname' => 'menus_pages'));
	}

	public function index()
	{
		$data['pages'] = $this->read_custom("SELECT * FROM menus_pages, pages
												WHERE menus_pages.id_page=pages.id
												AND pages.is_published!=0");
		$data['faq'] = $this->read_custom("SELECT * FROM faq");
		$this->load->view('index_page/header_view');
		$this->load->view('index_page/index_view', $data);
		$this->load->view('index_page/footer_view');
	}
}
