<?php
require_once "includeMe.php" ;

require("DBInfo.inc");

//Avoid CSRF attack
// make sure it is post process
if($_POST){
    // if token not vaild reject request
    if($_POST["csrf"] != $_SESSION["token"]){
        echo " not valid request";
        return ;
    }
}
//connect to database
$connect = mysqli_connect($hostDB, $userDB,$passwordDB,$databaseDB);

$action= $_GET["action"];
if (!empty($action)){
    $action() ;
}



function AddTrans(){
    global $connect;

    if(mysqli_connect_errno()){
       echo " cannot connect to database ". mysqli_connect_error();
    }

    //Add new Activitiy
    if(!empty($_POST['fromUserName']) and !empty($_POST['ToUserName'])) {

        $query ="insert into activities(fromUserName,ToUserName,Amount)
      values ('".$_POST['fromUserName'] ."','".$_POST['ToUserName'] ."',".$_POST['Amount'] .")" ;

        $result= mysqli_query($connect,$query);
        if (!$result){
             echo ' Error cannot run query';
        }else{
            echo "Data is saved";
        }

    }
    mysqli_close($connect);
}