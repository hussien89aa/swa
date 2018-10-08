<?php
require("DBInfo.inc");
?>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>chat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    </br>
    
<form id='login' action='chat.php' method='post' accept-charset='UTF-8'>
    <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea name="chatText" class="form-control" rows="5" id="comment"></textarea>
    </div>
    <input type='submit' name='Submit' value='submit' class="btn btn-success" />

</form>
    </br>
    <div class="panel panel-primary">
        <div class="panel-heading">Chat Room</div>
        <div class="panel-body">

<?php



$connect = mysqli_connect($hostDB, $userDB,$passwordDB,$databaseDB);
if(mysqli_connect_errno()){
    die(" cannot connect to database ". mysqli_connect_error());
}

//Insert chat text
if(!empty($_POST['chatText'])  ) {
    $query ="insert into chating (chatText) values ('" . $_POST['chatText'] . "')" ;
    $result= mysqli_query($connect,$query);
    /*if (!$result){
        $output ="{ 'msg':'fail'}" ;
    }else{
        $output ="{ 'msg':'user is added'}" ;
    }
    echo $query;*/
}

//Get chat room text
    $query ="select * from chating" ;
    $result= mysqli_query($connect,$query);

    if (!$result){
        die(' Error cannot run query');
    }

    $userInfo=array();
    echo "<ul class=\"list-group\">";
    while ($row= mysqli_fetch_assoc($result)) {

        echo   "<li class=\"list-group-item\">" . htmlentities( $row["chatText"]) . "</li>";
    }

    echo "</ul>";

    mysqli_free_result($result);
    mysqli_close($connect);


?>

        </div>
    </div>

</div>

<script>
    var name=<?= json_encode($_GET["name"])?>;
document.write(name);
</script>
</body>
