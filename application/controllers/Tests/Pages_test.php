<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 09.10.15
 * Time: 15:50
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pages_model');
    }

    public function index()
    {
        $this->load->library('unit_test');
        $this->_select_pages();
        $this->_select_page();
        $this->_addition_page();
        $this->_publish_page();
        $this->_deleting_page();
    }

    private function _select_pages()
    {
        $test_success = $this->Pages_model->select_pages();
        $test_failed = $this->Pages_model->select_pages();

        $testname = " test on select pages from database ";

        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'1');
        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'2');
        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'3');
        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'4');

        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'1');
        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'2');
        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'3');
        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'4');
    }

    private function _select_page()
    {
        $data_success['id'] = 2;
        $data_failed['id'] = 1299;

        $test_success = $this->Pages_model->select_page($data_success);
        $test_failed = $this->Pages_model->select_page($data_failed);

        $testname = " test on select 1 page from database ";

        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'1');
        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'2');
        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'3');
        echo $this->unit->run($test_success, 'is_array', 'Success'.$testname.'4');

        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'1');
        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'2');
        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'3');
        echo $this->unit->run($test_failed, 'is_bool', 'Failed'.$testname.'4');
    }

    private function _addition_page()
    {
        $data_success = array(
            'title' => 'asfdsf',
            'page' => 'asfdsf',
            'keywords' => 'asdfasfda',
            'description' => 'asdfasdf',
            'page_data' => 'asdfasdfa',
            'date_time' => '2015-09-10',
            'is_published' => 0
        );

        $data_failed = array(
            'title' => '',
            'page' => '',
            'keywords' => '',
            'description' => '',
            'page_data' => '',
            'date_time' => '0',
            'is_published' => ''
        );

        $test_success = $this->Pages_model->addition_page($data_success);
        $test_failed = $this->Pages_model->addition_page($data_failed);

        $testname = " test on create page ";

        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'1');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'2');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'3');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'4');

        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'1');
        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'2');
        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'3');
        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'4');
    }

    private function _deleting_page()
    {
        $data_success['id'] = 1;
        $data_failed['id'] = 2100;

        $test_success = $this->Pages_model->deleting_page($data_success);
        $test_failed = $this->Pages_model->deleting_page($data_failed);

        $testname = " test on delete page ";

        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'1');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'2');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'3');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'4');

        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'1');
        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'2');
        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'3');
        echo $this->unit->run($test_failed, 'is_int', 'Failed'.$testname.'4');

    }

    private function _publish_page()
    {
        $data_success = array(
            'id' => 1,
            'state' => 1,
        );
        $data_failed = array(
            'id' => 1000,
            'state' => 1
        );

        $test_success = $this->Pages_model->publish_page($data_success);
        $test_error = $this->Pages_model->publish_page($data_failed);

        $testname = " test on publish page ";

        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'1');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'2');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'3');
        echo $this->unit->run($test_success, 'is_int', 'Success'.$testname.'4');

        echo $this->unit->run($test_error, 'is_int', 'Failed'.$testname.'1');
        echo $this->unit->run($test_error, 'is_int', 'Failed'.$testname.'2');
        echo $this->unit->run($test_error, 'is_int', 'Failed'.$testname.'3');
        echo $this->unit->run($test_error, 'is_int', 'Failed'.$testname.'4');
    }
}