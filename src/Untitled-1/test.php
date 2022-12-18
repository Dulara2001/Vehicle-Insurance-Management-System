<?php
    require'config.php';
    if(isset($_POST["submit"])){
        $uname = $_POST["uname"];
        $pass = $_POST["pass"];
        $pl = $_POST["pl"];

        echo "$uname, $pass, $pl.<br>";

        $sql= "INSERT INTO `account`(`Username`, `Password`, `PL`) VALUES ('$uname','$pass',$pl)";

        if($con->query($sql)){
            echo "Insertion Success";
            header("Location:login.php");

        }
        else{
            echo "Insertion Failed";
        }
    }

?>

<div class="">
  <img class="profpic" src="./images/user2.jpg" alt="">
</div>
<div class="row">
  <h1>AJLUCI</h1>
</div>
<div class="">
  <h2>Arana Jayavihan</h2>
</div>
<div class="">
  <h3>Assistant Manager</h3>
</div>


$sql="SELECT * FROM `account` WHERE Username='".$uname."'";

        if($con->query($sql)){
            $result=$con->query($sql);
            $row=$result->fetch_assoc();

            if($row["Username"]==$uname and $row["Password"]==$pass){

                $_SESSION["USER"]=$uname;
                $msg="Login Success";
                $msg2="Have a nice Day";
                $msg3="location.href='user.php'";
            }
            else{
                $msg="OOPS!";
                $msg2="Invalid Username or Password Entered";
                $msg3="location.href='login.html'";
                }
            }



       /*

        if(isset($_POST["submit"])){
            $fullname = $_POST['fullname'];
            $namewithinitials = $_POST['namewithinitials'];
            $gender = $_POST['gender'];
            $NIC = $_POST['NIC'];
            $passportno = $_POST['passportno'];
            $dob = $_POST['day'];
            $occupation = $_POST['occupation'];
            $salary = $_POST['salary'];
            $postal = $_POST['paddress'];
            $work = $_POST['waddress'];


            $fixed = $_POST['fixed'];
            $mobile1 = $_POST['mobile1'];
            $mobile2 = $_POST['mobile2'];
            $mail = $_POST['mail'];
            $method = $_POST['method'];


            $chassis = $_POST['chassis'];
            $engine = $_POST['engine'];
            $reg = $_POST['reg'];
            $marketprice = $_POST['marketprice'];
            $model = $_POST['model'];
            $manu_year = $_POST['manuyear'];
            $seats = $_POST['seats'];
            $ftype = $_POST['type'];


            $policy = $_POST['policy'];
            $sdate = $_POST['sdate'];
            $edate = $_POST['edate'];
            $cover_type = $_POST['covertype'];

            $sql1="INSERT INTO `customer`(`NIC`, `Username`, `NameWithInitials`, `CustomerName`, `Gender`, `PassportID`, `DOB`, `Occupation`, `Salary`, `WorkAddress`, `HomeAddress`, `Email`, `FixedLine`, `Preferred_contact`) VALUES ('$NIC','$uname','$namewithinitials','$fullname','$gender','$passportno','$dob','$occupation','$salary','$work','$postal','$mail','$fixed', '$method')";


            $sql2="INSERT INTO `customer_vehicle`(`NIC`, `RegNo`, `ChassisNo`, `EngineNo`, `Value`, `Model`, `Myear`, `NoOfSeats`, `FuelType`) VALUES ('$NIC','$reg','$chassis','$engine','$marketprice','$model','$manu_year','$seats', '$ftype')";


            if($con->query($sql1) && $con->query($sql2)){
                echo "Insertion Success";

            }
            else{
                echo "Insertion Failed";
            }

            if(!empty($_POST["mobile2"])){
                $no1="INSERT INTO `customercontact`(`NIC`, `ContactNo`) VALUES ('$NIC','$mobile1')";
                $no2="INSERT INTO `customercontact`(`NIC`, `ContactNo`) VALUES ('$NIC','$mobile2')";

                if($con->query($no1) && $con->query($no2)){
                    echo "success2";
                }
                else{
                    echo "failed1";
                }

            }
            else if(isset($_POST["mobile1"])){
                $no1="INSERT INTO `customercontact`(`NIC`, `ContactNo`) VALUES ('$NIC','$mobile1')";

                if($con->query($no1)){
                    echo "success";
                }
                else{
                    echo "failed";
                }
            }

        }*/



<?php
    require("config.php");
    session_start();
    $name="Login";
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
    }
    else{
        $log="login.html";
    }

    $pfetch="SELECT `PolicyID`, `PolicyName`, `RenewAmount`, `AnnualAmount` FROM `policy` WHERE 1";

    if($con->query($pfetch)){
        $data=$con->query($pfetch);
    }
    else{
        echo"error";
    }

    while($row=$data->fetch_assoc()){
        echo $row["PolicyID"]." ".$row["PolicyName"]."  ".$row["RenewAmount"]." ".$row["AnnualAmount"]."<br>";
    }


?>
<div class="mbox">
                <a href="" class="mlink">Manage Personal Details</a>
              </div>
              <div class="mbox">
                <a href="" class="mlink">Manage Contact Details</a>
              </div>
              <div class="mbox">
                <a href="" class="mlink">Manage Policies</a>
              </div>