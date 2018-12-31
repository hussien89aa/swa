<?php
/*
* This code to avoid Session Hijacking,
* By making sure the requests is coming from same browser and same IP address for every session.
* If session info requested from different browser or IP address, we will reject request.
* NOTE: DONOT add session_start() anywhere.
* If your file needs session, make sure to include this header -->  require_once 'SessionManagement.php';
*/

session_start();

// generate user token from IP and user agent
function getUserPCInfo(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ip = null;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return  $ip . ":" .$user_agent ;
}
// first time login generate token
if(empty($_SESSION['tokenH'])){
    $_SESSION['tokenH'] = password_hash(getUserPCInfo(), PASSWORD_DEFAULT);
}else {
    // if attack happen, or user IP changed(switch to other router), ask user to re-open the browser
    if(!password_verify(  getUserPCInfo(),$_SESSION['tokenH'] ) ) {
        die("You are not using a valid Token, close the browser and open it again");
    }
}
