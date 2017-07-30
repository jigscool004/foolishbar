<?php

/**
 *  @author :   Jigar Prajapati
 *  @date   :   13-04-2017
 *  @uses   :   This helper is basically use for check user is logged in or not for admin side
 * 
 */
function isLoggedIn() {
    $ci = & get_instance();
    if (!$ci->session->userdata('logged_in')) {
        redirect('admin/user/login');
    }
}

function isFrontLoggedIn() {
    $ci = & get_instance();
    if (!$ci->session->userdata('isFrontLoggedIn')) {
        redirect('site/login');
    }
}


function checkedLoggedinFront() {
	$ci = & get_instance();
	return $ci->session->userdata('isFrontLoggedIn');
}