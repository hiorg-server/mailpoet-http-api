<?php
/*
  Plugin Name: MailPoet HTTP API
  Plugin URI: https://github.com/hiorgserver/mailpoet-http-api
  Description: HTTP-API, um neue Abonnenten zu MailPoet hinzuzufügen
  Version: 0.1
  Author: HiOrg Server GmbH
  Author URI: http://www.hiorg-server.de
  License: GPL
 */

add_action('init', 'mailpoet_http_api_init');

function mailpoet_http_api_init() {
    add_shortcode("http2mailpoet","process_http2mailpoet");
}

function mailpoet_get_list_ids() {
    $listmodel = WYSIJA::get("list","model");
    $listarray = $listmodel->get(array("name","list_id"), array("is_enabled"=>1));
    $lists = array();
    foreach ($listarray as $list) {
        $listarray[] = $list["list_id"];
    }
    return $lists;
}

function process_http2mailpoet($atts) {
    
    // required as REQUEST: email
    $email = $_REQUEST["email"];

    // optional as REQUEST or Shortcode-Param: list_ids OR list_id
    // Import-Priority: 
    // - list_ids preferred over list_id
    // - request preferred over shortcode-param
    // default: all active lists
    
    $list_ids = $_REQUEST["list_ids"];
    if(!empty($list_ids)) {
        $list_ids = explode(",",$list_ids);
    } else {
        $list_id = $_REQUEST["list_id"];
        if(!empty($list_id)) {
            $list_ids = array($list_id);
        } else {
            extract(shortcode_atts(array("list_ids" => "", 
                                         "list_id" => ""), 
                                   $atts));
            if(!empty($list_ids)) {
                $list_ids = explode(",",$list_ids);
            } elseif(!empty($list_id)) {
                $list_ids = array($list_id);
            } else {
                $list_ids = mailpoet_get_list_ids();
            }
        }
    }
    
    // optional:
    $lastname = $_REQUEST["lastname"];
    $firstname = $_REQUEST["firstname"];
    
    if(!empty($email) && !empty($list_ids)) {
        $user_data = array(
            "email" => $email,
            "lastname" => $lastname,
            "firstname" => $firstname
        );
        
        $data_subscriber = array(
            "user" => $user_data,
            "user_list" => array("list_ids" => $list_ids)
        );
        
        $helper_user = WYSIJA::get("user", "helper");
        $user_id = $helper_user->addSubscriber($data_subscriber);
        
        if($user_id === true) {
            return "OK: already exists";
        } elseif($user_id === false) {
            return "ERROR";
        } else {
            return "OK: " . $user_id;
        }
    }
}
