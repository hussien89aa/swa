<?php require 'headerTab.php'?>
    <body>
    <div class="container">
        </br>
        </br>
        </br>
<?php

if( preg_match("/^[a-zA-Z0-9]+$/",$_GET["file"])) {
    $homepage = file_get_contents("reports/".$_GET["file"]. ".txt");
    echo $homepage;
}else{
    echo "input not valid";
}
?>
        </div>
</body>
<?php require 'footerTab.php'?>