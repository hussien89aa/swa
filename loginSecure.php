<?php //@session_start();?>
<?php require 'headerTab.php'?>
<body>
</br>
</br>
</br>

<div class="container">
    <form id='login' action="loginSecure.php" method='post' accept-charset='UTF-8'>
        <div class="panel panel-primary">
            <div class="panel-heading">Login User</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for='username' >UserName*:</label>
                    <input type='text' name='userName' id='username'  maxlength="50"  required/>
                </div>
                <div class="form-group">
                    <label for='password' >Password*:</label>
                    <input type='password' name='password' id='password' maxlength="50" required/>
                </div>

                <input type='submit' class="btn btn-default" name='Submit' value='Login' />

            </div>
        </div>
    </form>


Test data:</br>
userName: admin</br>
password: admin</br>
</br>


<?php

//Database Authentication
require("DBInfo.inc");

// secure post call
if(!empty($_POST['userName']) and !empty($_POST['password'])) {

    $mysqli = new mysqli($hostDB, $userDB,$passwordDB,$databaseDB);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query ="select userName from login  where userName=? and password=?" ;
    $loginInUser=null;
    /* create a prepared statement */
    if ($stmt = $mysqli->prepare($query)) {

        /* bind parameters for markers */
        $stmt->bind_param("ss", $_POST['userName'],$_POST['password']);
        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($loginInUser);

        /* fetch value */
        $stmt->fetch();

        /* close statement */
        $stmt->close();
    }

    /* close connection */
    $mysqli->close();

    echo "<pre>";
    echo "Server data:</br>";
    echo "username: " . htmlentities($_POST['userName']). "</br>";
    echo "password: " . htmlentities($_POST['password']). "</br>";
    echo "query: " . htmlentities($query) . "</br>";
    if (! empty($loginInUser)) {

        // $_SESSION["userName"] = $loginInUser;

        echo "</br><div class=\"alert alert-success\">Database Message: Success login with user name (". $loginInUser .")";
        echo "</br></br><a class=\"btn btn-success\" href='myActivities.php?userName=" .$loginInUser ."'> My Activities</a>";
        echo "</div>";

    }else{
        echo "</br><div class=\"alert alert-danger\">Database Message: Fail login</div>";
    }
    echo "</pre>";
}

?>
</div>
</body>
<?php require 'footerTab.php'?>