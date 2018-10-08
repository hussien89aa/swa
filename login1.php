<?php //@session_start();?>
<?php require 'headerTab.php'?>
<body>
</br>
</br>
</br>
<div class="container">
    <form id='login' action="login1.php" method='post' accept-charset='UTF-8'>
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


<?php
/*
    Test data:</br>
    userName: admin</br>
    password: admin</br>
*/
?>

<?php
//Database Authentication
require("DBInfo.inc");

// Server side code
//Read form submit info post request
$userName = $_POST['userName'];
$password = $_POST['password'];

//Not secure post call
if(!empty($userName) and !empty($password)) {
    //connect to database
    $connect = mysqli_connect($hostDB, $userDB,$passwordDB,$databaseDB);
    if(mysqli_connect_errno()){
        die(" cannot connect to database ". mysqli_connect_error());
    }

    $query ="select * from login  where userName='" .
        $userName ."' and password='" . $password ."'" ;

    $result= mysqli_query($connect,$query);
    if (!$result){
        die(' Error cannot run query');
    }

    $loginInUser=null;
    $userToken = null;
    while ($row= mysqli_fetch_assoc($result)) {
        $loginInUser= $row["userName"];
        $userToken= $row["userToken"];
        break; // to be save
    }

    mysqli_free_result($result);
    mysqli_close($connect);

    echo "<pre>";
    echo "Server data:</br>";
    echo "username: " . $userName. "</br>";
    echo "password: " . $password. "</br>";
    echo "query: " . $query . "</br>";
    if (! empty($loginInUser)) {

       // $_SESSION["userName"] = $loginInUser;

        echo "</br><div class=\"alert alert-success\">Database Message: Success login with user name (". $loginInUser .")";
        echo "</br></br><a class=\"btn btn-success\" href='myActivities1.php?userToken=" .$userToken ."'> My Activities</a>";
         echo "</div>";

    }else{
        echo "</br><div class=\"alert alert-danger\">Database Message: Fail login</div>";
    }
    echo "</pre>";
}

?>

</div>

<script>

    <?php
    // submit user name to server
?>
</script>
</body>
<?php require 'footerTab.php'?>