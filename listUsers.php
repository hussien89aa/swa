<?php require 'headerTab.php'?>
<body>
<div class="container">
    </br>
    </br>
    </br>

    <h1> List of users</h1>
<table class="table table-bordered">
    <thead>
    <tr>
        <td> UserID </td>
        <td> UserName</td>
        <td> Password</td>
    </tr>
    </thead>
    <tbody>



<?php

//Database Authentication
require("DBInfo.inc");

    //connect to database
    $connect = mysqli_connect($hostDB, $userDB,$passwordDB,$databaseDB);
    if(mysqli_connect_errno()){
        die(" cannot connect to database ". mysqli_connect_error());
    }

    $query ="select * from login " ;

    $result= mysqli_query($connect,$query);
    if (!$result){
        die(' Error cannot run query');
    }

    $userInfo=array();
    $loginInUser=null;
    while ($row= mysqli_fetch_assoc($result)) {
        //$userInfo[]= $row ;
       echo " <tr>";
       echo " <td>". $row["userID"] ." </td>";
       echo "  <td>". $row["userName"]."</td>";
       echo " <td>". $row["password"]."</td>";
       echo " </tr>";
    }

    mysqli_free_result($result);
    mysqli_close($connect);



?>

    </tbody>
</table>
</div>
</body>
<?php require 'footerTab.php'?>