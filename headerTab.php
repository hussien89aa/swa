<?php session_start();
header('X-XSS-Protection:0'); ?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Online Bank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 

<style>

    body{
        background: #f9f9f9;
    }
    body.container{
        padding-left: 10%;
        padding-right: 10%;
        background-color:#FFFFFF;
    }
</style>

</head>
<?php



?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="login.php" class="navbar-brand">Online Bank</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if ($websiteType==0 or $websiteType==1):?>
               <!-- <li><a href="./library.php">My Activities</a></li> -->
                <?php endif;?>
            </ul>

        </div>
    </div>
</div>
