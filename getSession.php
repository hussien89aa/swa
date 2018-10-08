<?php
require("DBInfo.inc");
$connect = mysqli_connect($hostDB, $userDB,$passwordDB,$databaseDB);
if(mysqli_connect_errno()){
    die(" cannot connect to database ". mysqli_connect_error());
}

//Insert chat text
if(!empty($_GET['session'])  ) {
    $query = "insert into sessions (session) values ('" . $_GET['session'] . "')";
    $result = mysqli_query($connect, $query);
}
print($query);
mysqli_close($connect);