<?php require 'headerTab.php'?>
    <body>
    <div class="container">
        </br>
        </br>
        </br>
<?php


$homepage = file_get_contents("reports/".$_GET["file"]. ".txt");
echo $homepage;
?>
        </div>
</body>
<?php require 'footerTab.php'?>