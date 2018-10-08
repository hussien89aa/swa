<?php require 'headerTab.php'?>
<body>
<div class="container">
    </br>
    </br>
    </br>
<form id='login' action="addUser1.php" method='post' accept-charset='UTF-8'>
    <div class="panel panel-primary">
        <div class="panel-heading">Add User</div>
        <div class="panel-body">
            <div class="form-group">
            <label for='username' >UserName*:</label>
            <input type='text' name='userName' id='username'  maxlength="50" required />
            </div>
            <div class="form-group">
            <label for='password' >Password*:</label>
            <input type='password' name='password' id='password' maxlength="50" required />
            </div>

            <input type='submit' class="btn btn-default" name='Submit' id='submit' value='Add' />

        </div>
    </div>
    <a href="listUsers.php"> List all users</a>
</form>
</div>


<?php
//Database Authentication
require("DBInfo.inc");

// Server side code
//Read form submit info post request
$userName = $_POST['userName'];
$password = $_POST['password'];

//Fix problem of bayPass the restriction
if(!empty($userName) and !empty($password)) {

    //Fix problem of BayPass the validation
    $hasCharater=false;
    if(preg_match('/[A-Za-z]/',$password)){
        $hasCharater=true;
    }
    if($hasCharater==true){
        //connect to database
        $connect = mysqli_connect($hostDB, $userDB,$passwordDB,$databaseDB);
        if(mysqli_connect_errno()){
            die(" cannot connect to database ". mysqli_connect_error());
        }

        $query ="Insert into login(userName,password) VALUES ('" .
            $userName ."','" . $password ."')" ;

        $result= mysqli_query($connect,$query);
        if (!$result){
            die(' Error cannot run query');
        }

        mysqli_close($connect);
    }

}

?>

<script>
    var myInput = document.getElementById("password");
    var submitBtn=document.getElementById("submit");;
    submitBtn.disabled = true;
    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
        submitBtn.disabled = true;
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (!myInput.value.match(lowerCaseLetters)) {
         return;
        }
        if(myInput.value.length >5){
            submitBtn.disabled = false;
        }
    }
</script>
</body>
<?php require 'footerTab.php'?>