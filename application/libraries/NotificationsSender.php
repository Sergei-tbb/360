<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationsSender
 *
 * @author snegas
 */
class NotificationsSender {
    
    /**
     * @access public
     * @var string
     */
    public $turbo_sms_login = "";
    
    /**
     * @access public
     * @var string
     */
    public $turbo_sms_password = "";
    
    /**
     * @access public
     * @var string
     */
    public $turbo_sms_sender_name = "360dpi.com.ua";
    
    /**
     * @access public
     * @var string
     */
    public $email_from_email = "";
    
    /**
     * @access public
     * @var string
     */
    public $email_from_name = "";
    
    /**
     * CodeIgniter instance for
     * encapsulation
     * @access private
     * @var object
     */
    private $ci;
    
    /**
     * Public constructor
     * Getting CodeIgniter instance
     * @param void
     * @access public
     */
    public function __construct() {
        $this->ci =& get_instance();
    }
    
    /**
     * Get all of users phones which can have 
     * notifications from users which have roles
     * which notifications can be sent 
     * @access private
     * @param int $id_notifications
     * @return array
     */
    private function _get_users_phones_from_db($id_notifications) {
        return $this->ci->db
                    ->query("SELECT phone "
                            . "FROM phones "
                            . "WHERE is_notify = 1 AND id IN ("
                                . "SELECT id_phones "
                                . "FROM users_phones "
                                . "WHERE id_users IN ("
                                    . "SELECT id "
                                    . "FROM users "
                                    . "WHERE id_user_roles IN ("
                                        . "SELECT id_user_roles "
                                            . "FROM notifications_roles "
                                            . "WHERE id_notifications = {$id_notifications})))")
                    ->result();
    }
    
    /**
     * Get all emails from users which
     * can have role which notification can
     * be sent 
     * @access private
     * @param int $id_notifications
     * @return array
     */
    private function _get_users_emails_from_db($id_notifications) {        
        return $this->ci->db
                ->query("SELECT email "
                        . "FROM users "
                        . "WHERE is_verify = 1 AND id_user_roles IN ("
                            . "SELECT id_user_roles "
                            . "FROM notifications_roles "
                            . "WHERE id_notifications = {$id_notifications})")
                ->result();
    }

    /**
     * Get notification data
     * from notifications table,
     * user's data from users table,
     * and role's data from roles table
     * @access private
     * @param int $id_notifications
     * @return array
     */
    private function _get_notification_data($id_notifications) {
        return $this->ci->db
                ->query("SELECT "
                            . "notifications.name AS notification_name, "
                            . "notifications.text AS notification_message, "
                            . "users.name AS user_name, "
                            . "users.surname AS user_surname, "
                            . "users.middlename AS user_middlename, "
                            . "user_roles.name AS user_role_name "
                        . "FROM "
                            . "notifications, "
                            . "users, "
                            . "user_roles "
                        . "WHERE "
                            . "notifications.id_users = users.id AND "
                            . "user_roles.id = users.id_user_roles"
                            . "notifications.id = {$id_notifications}")
                ->result();
    }
    
    /**
     * Send SMS using TurboSMS API
     * SOAP
     * Need to put
     * 1) login
     * 2) password
     * 3) sender
     * 4) destination
     * 5) text
     * @access protected
     * @param array $args
     * @return void
     */
    protected function _sms(array $args) {
        $client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');
        
        $client->Auth(array(
            "login" => $args["login"],
            "password" => $args["password"]
        ));
        
        $client->SendSMS(array(
            "sender" => $args["sender"],
            "destination" => $args["destination"],
            "text" => $args["text"]
        ));
    }
    
    /**
     * Send email using standart mail()
     * php's function
     * Need to put
     * 1)from
     * 1.1)email
     * 1.2)name
     * 2)to
     * 3)subject
     * 4)message
     * @access protected
     * @param array $args
     * @return void
     */
    protected function _email(array $args) {
        $this->ci->load->library("email");
        
        $this->ci->email->from($args["from"]["email"], $args["from"]["name"]);
        $this->ci->email->to($args["to"]);
        
        $this->ci->email->subject($args["subject"]);
        $this->ci->email->message($args["message"]);
        
        $this->ci->email->send();
        
        $this->ci->email = null;
    }
    
    /**
     * Main function
     * Send notification via
     * choosen type
     * 1) sms
     * 2) email
     * @param string $type
     * @param int $id_notifications
     * @return boolean
     */
    public function send($type, $id_notifications) {
        $notification = $this->_get_notification_data($id_notifications);
        
        switch ($type) {
            default: 
                return false;
                break;
            case "sms":
                $phones = $this->_get_users_phones_from_db($id_notifications);
                
                $args = array(
                    "login"         => $this->turbo_sms_login,
                    "password"      => $this->turbo_sms_password,
                    "sender"        => $this->turbo_sms_sender_name,
                    "destination"   =>  "",
                    "text"          => $notification->text
                );
                
                foreach ($phones as $phones) {
                    $args["destination"] = $phones->phone;
                    $this->_sms($args);
                }
                break;
            case "email":
                $emails = $this->_get_users_emails_from_db($id_notifications);
                
                $args = array(
                    "from"      => array(
                        "email"     => "",
                        "name"      => "{$notification->user_role_name} {$notification->user_surname} {$notification->user_name} {$notification->user_middlename}"
                    ),
                    "to"        => "",
                    "subject"   => "{$notification->notification_name}",
                    "message"   => "{$notification->notification_message}"
                );
                    
                foreach($emails as $email) {
                    $args["to"] = $email->email;
                    
                    $this->_email($args);
                }
                break;
        }
        
        return true;
    }
    
    public function __destruct() {
        $this->ci = null;
    }
}