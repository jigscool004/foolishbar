<?php

/**
 * Created by PhpStorm.
 * User: Jigar Kumar
 * Date: 8/20/2017
 * Time: 11:06 PM
 */
class PHPMailer_Library {
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once(APPPATH."third_party/phpmailer/third_party/phpmailer/PHPMailerAutoload.php");
        $objMail = new PHPMailer;
        return $objMail;
    }
}