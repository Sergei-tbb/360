<?php

defined("BASEPATH") or exit("No direct script access allowed!");

class Api_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array("Curl", "unit_test"));
    }

    public function index()
    {
        $this->_login_test();
        $this->_get_info_files_test();
    }

    /**
     * Do test of method login()
     * private
     * return null
     */
    private function _login_test()
    {
        $url = "index.php/Api/login";
        $test_query = array(
            0 => array(
                'data' => array(
                    "email" => "mail@mail.com",
                    "password" => 12345
                ),
                'check_data' => 200,
                'message_text' => "Test Login method. Success"
            ),
            1 => array(
                'data' => array(
                    "email" => "mail@mail.ru",
                    "password" => 1
                ),
                'check_data' => 400,
                'message_text' => "Test Login method. Failed. Invalid password"
            ),
            2 => array(
                'data' => array(
                    "email" => "",
                    "password" => 12345
                ),
                'check_data' => 400,
                'message_text' => "Test Login method. Failed. Invalid email"
            ),
            3 => array(
                'data' => array(
                    "email" => "",
                    "password" => ""
                ),
                'check_data' => 400,
                'message_text' => "Test Login method. Failed. Invalid all data"
            )
        );
        foreach($test_query as $val)
        {
            $this->_send_curl($url, $val['check_data'], $val['message_text'], TRUE, $val['data']);
        }
    }

    /**
     * Do test of method get_info_files()
     * private
     * return null
     */
    private function _get_info_files_test()
    {
        $url = "index.php/Api/get_info_files/";

        $test_query = array(
            0 => array(
                'url' => $url."1",
                'check_data' => 200,
                'message_text' => "Test get_info_files. Success"
            ),
            1 => array(
                'url' => $url."0",
                'check_data' => 400,
                'message_text' => "Test get_info_files. Failed user_id"
            )
        );

        foreach($test_query as $val)
        {
            $this->_send_curl($val['url'], $val['check_data'], $val['message_text']);
        }
    }

    /**
     * Do cURL query
     * private
     * @param string $url - url of method
     * @param int $check_data - the value to test
     * @param string $message_text - text of message
     * @param bool $post - default FALSE. Set POST query
     * @param null $data - data of POST query
     * return null
     */
    private function _send_curl($url, $check_data, $message_text, $post = FALSE, $data = NULL)
    {
        $this->curl->url(base_url().$url);
        $this->curl->header(TRUE);
        $this->curl->returntransfer(TRUE);
        if(!is_null($data) AND $post === TRUE)
        {
            $this->curl->post($post);
            $this->curl->postfields($data);
        }

        $result = $this->curl->do_request();
        $this->curl->do_reset();

        echo $this->unit->run($result, $check_data, $message_text);
    }
}