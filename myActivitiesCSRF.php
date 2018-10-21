<?php require 'headerTab.php'?>


    <script>
        var userName='<?= json_encode($_GET["userName"])?>';
        document.write(userName);
    </script>
    <body>

    <div class="container">
        </br>
        </br>
        </br>

        <?php
    //Avoid CSRF attack
    // make sure it is post process
        if($_POST){
            // if token not vaild reject request
            if($_POST["csrf"] != $_SESSION["token"]){
                echo " not valid request";
                return ;
            }

        }
// create new token for every new request
        $_SESSION["token"] = md5(uniqid(mt_rand(),true));
        echo $_SESSION["token"];
        ?>

        <form id='login' action="myActivitiesCSRF.php" method='post' accept-charset='UTF-8'>
            <div class="panel panel-primary">
                <div class="panel-heading">Send Money</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for='ToUserName' >To UserName*:</label>
                        <input type='text' name='ToUserName' id='ToUserName'  maxlength="50" required />
                        <label for='Amount' >Amount:</label>
                        <input type='text' name='Amount' id='Amount' maxlength="50" required />
                        <input type="hidden" name="fromUserName" id="fromUserName" value="<?= htmlentities($_GET['userName']);?>" />
                        <input type="hidden" name="csrf" value="<?= $_SESSION["token"] ?>">
                        <input type='submit' class="btn btn-default" name='Submit' id='submit' value='Send' />
                    </div>
                </div>
            </div>

        </form>

        <h1> List of Activities</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td> transaction Key </td>
                <td> from </td>
                <td> To</td>
                <td> Amount</td>
            </tr>
            </thead>
            <tbody>



<?php
//Database Authentication
require("DBInfo.inc");

$userName = $_GET['userName'];

//connect to database
$connect = mysqli_connect($hostDB, $userDB,$passwordDB,$databaseDB);
if(mysqli_connect_errno()){
    die(" cannot connect to database ". mysqli_connect_error());
}


//Add new Activitiy
if(!empty($_POST['fromUserName']) and !empty($_POST['ToUserName'])) {

    $query ="insert into activities(fromUserName,ToUserName,Amount)
      values ('".$_POST['fromUserName'] ."','".$_POST['ToUserName'] ."',".$_POST['Amount'] .")" ;

    $result= mysqli_query($connect,$query);
    if (!$result){
        die(' Error cannot run query');
    }

}

// get user activities
if( !empty($userName)) {
    $query ="select * from activities  where fromUserName='". $userName ."' or ToUserName='". $userName ."'" ;
    $result= mysqli_query($connect,$query);
    if (!$result){
        die(' Error cannot run query');
    }

    $userInfo=array();
    $loginInUser=null;
    while ($row= mysqli_fetch_assoc($result)) {
        $rowColor ="class='success'";
        if($row["fromUserName"]==$userName){
            $rowColor ="class='danger'";
        }
        echo " <tr ". $rowColor .">";
        echo " <td>". $row["transactionKey"] ." </td>";
        echo " <td>". $row["fromUserName"] ." </td>";
        echo "  <td>". $row["ToUserName"]."</td>";
        echo " <td>". $row["Amount"]."</td>";
        echo " </tr>";
    }
    mysqli_free_result($result);
}
mysqli_close($connect);



?>

            </tbody>
        </table>
    </div>
    </body>

<?php require 'footerTab.php'?>
