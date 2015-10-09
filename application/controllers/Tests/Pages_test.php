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
        $this->load->library('unit_test');
        $this->load->model('Pages_model');
    }

    public function index()
    {
        $this->_select_pages();
        $this->_select_page();
        $this->_addition_page();
        $this->_deleting_page();
        $this->_publish_page();
    }

    private function _select_pages()
    {
        $test = $this->Pages_model->select_pages();

        $testname = " test on select pages from database ";

        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'1');
        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'2');
        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'3');
        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'4');

        echo $this->unit->run($test, 'is_bool', 'Failed'.$testname.'1');
        echo $this->unit->run($test, 'is_int', 'Failed'.$testname.'2');
        echo $this->unit->run($test, 'is_string', 'Failed'.$testname.'3');
        echo $this->unit->run($test, 'is_object', 'Failed'.$testname.'4');
    }

    private function _select_page()
    {
        $data['id'] = rand(0, 100);

        $test = $this->Pages_model->select_page($data);

        $testname = " test on select 1 page from database ";

        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'1');
        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'2');
        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'3');
        echo $this->unit->run($test, 'is_array', 'Success'.$testname.'4');

        echo $this->unit->run($test, 'is_bool', 'Failed'.$testname.'1');
        echo $this->unit->run($test, 'is_int', 'Failed'.$testname.'2');
        echo $this->unit->run($test, 'is_string', 'Failed'.$testname.'3');
        echo $this->unit->run($test, 'is_object', 'Failed'.$testname.'4');
    }

    private function _addition_page()
    {
        $data = array(
            'title' => 'asfdsf',
            'page' => 'asfdsf',
            'keywords' => 'asdfasfda',
            'description' => 'asdfasdf',
            'page_data' => 'asdfasdfa',
            'date_time' => '2015-09-10',
            'is_published' => 0
        );

        $test = $this->Pages_model->addition_page($data);

        $testname = " test on create page ";

        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'1');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'2');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'3');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'4');

        echo $this->unit->run($test, 'is_bool', 'Failed'.$testname.'1');
        echo $this->unit->run($test, 'is_array', 'Failed'.$testname.'2');
        echo $this->unit->run($test, 'is_string', 'Failed'.$testname.'3');
        echo $this->unit->run($test, 'is_object', 'Failed'.$testname.'4');
    }

    private function _deleting_page()
    {
        $data['id'] = rand(0, 100);

        $test = $this->Pages_model->deleting_page($data);

        $testname = " test on delete page ";

        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'1');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'2');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'3');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'4');

        echo $this->unit->run($test, 'is_bool', 'Failed'.$testname.'1');
        echo $this->unit->run($test, 'is_array', 'Failed'.$testname.'2');
        echo $this->unit->run($test, 'is_string', 'Failed'.$testname.'3');
        echo $this->unit->run($test, 'is_object', 'Failed'.$testname.'4');

    }

    private function _publish_page()
    {
        $data = array(
            'id' => rand(0,100),
            'state' => rand(0, 1),
        );

        $test = $this->Pages_model->publish_page($data);

        $testname = " test on publish page ";

        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'1');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'2');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'3');
        echo $this->unit->run($test, 'is_int', 'Success'.$testname.'4');

        echo $this->unit->run($test, 'is_bool', 'Failed'.$testname.'1');
        echo $this->unit->run($test, 'is_array', 'Failed'.$testname.'2');
        echo $this->unit->run($test, 'is_string', 'Failed'.$testname.'3');
        echo $this->unit->run($test, 'is_object', 'Failed'.$testname.'4');
    }
}