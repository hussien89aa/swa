<?php
//This code to avoid Session Hijacking by making sure the request is comming from same browser and same IP address
session_start();

// generate token from IP and user agent
function getToken(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ip = null;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
//echo $ip . ":" .$user_agent;
    return md5($ip . ":" .$user_agent);
}

// first time login generate token
if(empty($_SESSION['tokenH'])){
    $_SESSION['tokenH'] = getToken();

}else{

// if attemp to attack stop him
    if($_SESSION['tokenH'] != getToken() ){

        die("Token isnot valid");

    }
}

?>
