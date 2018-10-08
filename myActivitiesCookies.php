<?php require 'headerTab.php'?>
    <body>
    <div class="container">
        </br>
        </br>
        </br>
        <form id='login' action="myActivitiesCookies.php" method='post' accept-charset='UTF-8'>
            <div class="panel panel-primary">
                <div class="panel-heading">Send Money</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for='ToUserName' >To UserName*:</label>
                        <input type='text' name='ToUserName' id='ToUserName'  maxlength="50" required />
                        <label for='Amount' >Amount:</label>
                        <input type='text' name='Amount' id='Amount' maxlength="50" required />
                    <input type="hidden" name="fromUserName" value="<?= $_COOKIE['userName'];?>" />

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

$userName = $_COOKIE['userName'];

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