<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 16.10.15
 * Time: 18:41
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Users_model extends CI_Model
{
    var $id;
    var $name;
    var $middlename;
    var $surname;
    var $email;
    var $password;
    var $reg_date;
    var $is_verify;
    var $is_online;
    var $id_user_role;
}