<?php
    require'config.php';
    session_start();
    $uname="Login";
    $flag1=0;
    $flag2=0;
    $fullname = "";
    $namewithinitials = "";
    $gender = "";
    $NIC = "";
    $passportno = "";
    $dob = "";
    $occupation = "";
    $salary = "";
    $postal = "";
    $work = "";
    $fixed = "";
    $omobile1 = "";
    $omobile2 = "";
    $mobile2 = '';
    $mobile1 = '';
    $mail = "";
    $method = "";
    $waddress='';
    $paddress='';
    $flag11='';
    $flag12='';
    $flag21='';
    $flag22='';
    $flag23='';
    $change="";

    if(isset($_SESSION["USER"])){
        $log="user.php";
        $uname=$_SESSION["USER"];
        $pl=$_SESSION["PL"];
        if($pl>1){
            $flag1=1;
        }
        // checking whether a customer data exists in the system or not to auto fill the registration form if data exists
        if($flag1==1){
            $fetch="SELECT * FROM `customer` WHERE Username='$uname'";

            $fetch2="SELECT CP.ContactNo FROM customercontact CP, customer C WHERE C.NIC=CP.NIC AND C.Username='$uname'";

            if($con->query($fetch)){
                $fetchdata=$con->query($fetch);
                while($row1=$fetchdata->fetch_assoc()){
                    $NIC=$row1["NIC"];
                    $fullname=$row1["CustomerName"];
                    $namewithinitials=$row1["NameWithInitials"];
                    $gender=$row1["Gender"];
                    $passportno=$row1["PassportID"];
                    $paddress=$row1["HomeAddress"];
                    $waddress=$row1["WorkAddress"];
                    $dob=$row1["DOB"];
                    $occupation=$row1["Occupation"];
                    $salary=$row1["Salary"];
                    $mail=$row1["Email"];
                    $fixed=$row1["FixedLine"];
                }
                
                function chkgender($gender){
                    if($gender=='Male'){
                        echo "<script>document.getElementById('male').checked=true; </script>";
                    }
                    
                    else if($gender=='Female'){
                        echo "<script>document.getElementById('female').checked=true; </script>";
                    }
                }//disabling input fields for existing users
                $change="<script>
                    document.getElementById('name').disabled=true;
                    document.getElementById('nwi').disabled=true;
                    document.getElementById('NIC').disabled=true;
                    document.getElementById('passportno').disabled=true;
                    document.getElementById('paddress').disabled=true;
                    document.getElementById('waddress').disabled=true;
                    document.getElementById('fixed').disabled=true;
                    document.getElementById('female').disabled=true;
                    document.getElementById('male').disabled=true;
                    document.getElementById('email').disabled=true;
                    document.getElementById('day').disabled=true;
                    document.getElementById('mobile1').disabled=true;
                    document.getElementById('mobile2').disabled=true;
                    document.getElementById('occupation').disabled=true;
                    document.getElementById('salary').disabled=true;
                </script>";
            }
            else{
                echo"error";
            }
            //read contact numbers from database to display
            $tempno=array();
            $i=0;
            if($con->query($fetch2)){
                $fetchdata1=$con->query($fetch2);
                while($row2=$fetchdata1->fetch_assoc()){
                    $tempno[$i]=$row2["ContactNo"];
                    $i++;
                }
                $lim=sizeof($tempno);
                if($lim<2){
                    $omobile1=$tempno[0];
                }
                else if($lim<3){
                    $omobile1=$tempno[0];
                    $omobile2=$tempno[1];
                }
            }
            //inserting and updating data and alerting status
            if(isset($_POST["submit"])){
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

                $sql1="UPDATE `customer` SET `Preferred_contact`='$method' WHERE Username='$uname'";
                $sql2="INSERT INTO `customer_vehicle`(`NIC`, `RegNo`, `ChassisNo`, `EngineNo`, `Value`, `Model`, `Myear`, `NoOfSeats`, `FuelType`) VALUES ('$NIC','$reg','$chassis','$engine','$marketprice','$model','$manu_year','$seats', '$ftype')";


                if($con->query($sql1) && $con->query($sql2)){
                    $flag11=1;

                }
                else{
                    $flag11=0;
                }
                // validating the status of policy
                if($sdate<$edate){
                    $state="VALID";
                }

                else if($sdate>=$edate){
                    $state="INVALID";
                }

                $cdate=date("Y-m-d");
                if($cdate>$sdate){
                  $rd1="register.php";
                  echo "<script> alert('Invalid Start Date'); window.location='$rd1'; </script>";
                }

                $sql3="INSERT INTO `customer_policy`(`NIC`, `PolicyID`, `RegNo`, `Start_date`, `Expiry_date`, `Type`, `Validity`) VALUES ('$NIC','$policy','$reg','$sdate','$edate','$cover_type','$state')";

                if($con->query($sql3)){
                    $flag12=1;
                }
                else{
                    $flag12=2;
                }
                if($flag11==1 && $flag12==1){
                    echo "<script> alert('Policy Plan has been added to your Account!'); window.location='user.php'; </script>";
                }
            }
        }
        else if($flag1==0){
            function chkgender($gender){
                }
            //new customer must fill the entire form
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

                //data insertion and validation
                if($con->query($sql1) && $con->query($sql2)){
                    $flag21=1;

                }
                else{
                   $flag21=0;
                }

                if(!empty($_POST["mobile2"])){
                    $no1="INSERT INTO `customercontact`(`NIC`, `ContactNo`) VALUES ('$NIC','$mobile1')";
                    $no2="INSERT INTO `customercontact`(`NIC`, `ContactNo`) VALUES ('$NIC','$mobile2')";

                    if($con->query($no1) && $con->query($no2)){
                        $flag22=1;
                    }
                    else{
                        $flag22=0;
                    }

                }
                else if(isset($_POST["mobile1"])){
                    $no1="INSERT INTO `customercontact`(`NIC`, `ContactNo`) VALUES ('$NIC','$mobile1')";

                    if($con->query($no1)){
                        $flag22=1;
                    }
                    else{
                        $flag22=0;
                    }
                }

                if($sdate<$edate){
                    $state="VALID";
                }

                else if($sdate>$edate){
                    $state="INVALID";
                }

                $sql3="INSERT INTO `customer_policy`(`NIC`, `PolicyID`, `RegNo`, `Start_date`, `Expiry_date`, `Type`, `Validity`) VALUES ('$NIC','$policy','$reg','$sdate','$edate','$cover_type','$state')";

                if($con->query($sql3)){
                    $flag23=1;
                }
                else{
                   $flag23=0;
                }
                if($flag21==1 && $flag22==1 && $flag23==1){
                    $upgradeAcc="UPDATE account SET PL='2' WHERE Username='$uname'";
                    $_SESSION["PL"]=2;
                    if($con->query($upgradeAcc)){
                        echo "<script> alert('Policy Plan has been added to your Account!'); window.location='user.php'; </script>";
                    }
                    else{
                        echo "<script> alert('Policy plan subscription failed!!!'); </script>";
                    }
                }
            }
        }
        $con->close();
    }
    else{
        $log="login.php";
        header("Location:login.php");
    }
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel=stylesheet href="./css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel="stylesheet" href="css/register.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

        <script src="js/slider.js"></script>

        <title>Rapid Motor Insurance</title>
    </head>

    <body>
        <div class="backround">
            <section class="header">
                <div class="top">
                    <container>
                        <a href="index.php"><img src="images/LOGO%201.png"></a>
                        <a href="index.php"><h1>Rapid Motor Insurance</h1></a>
                    </container>
                    <container>
                        <a href="<?php echo $log; ?>"><i class="fas fa-user-circle"></i></a>
                        <a  href="<?php echo $log; ?>"><h1 class="log"><?php echo $uname; ?></h1></a>
                    </container>
                </div>

                <div class="links">
                  <ul>
                    <li><a href="index.php">About Us</a></li>
                    <li><a href="#">Join Us</a>
                      <div class="sub1">
                        <ul>
                          <li> <a href="signup.php">Sign Up</a></li>
                        </ul>
                        <ul>
                        <li> <a href="register.php">Buy Policy</a> </li>
                        </ul>
                      </div>
                    </li>

                    <li><a href="products.php">Products</a></li>
                    <li><a href="#">Claims & Renewals</a>
                      <div class="sub1">
                        <ul>
                          <li> <a href="crequest.php">Claim Requests</a></li>
                        </ul>
                        <ul>
                        <li> <a href="renew.php">Renew Policies</a></li>
                        </ul>
                      </div>
                    </li>
                    <li><a href="payments.php">Payment Portal</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                  </ul>
              </div>
            </section>
            <!-- All enterd data is being validated using html validation techniques -->
            <section class="rform">
                <div class="form">
                            
                    <form action="" method="POST">
                    <h1>Ride fearlessly with our Policies</h1>
                            <p>Note: Please fill all details unless it says it is optional</p>
                        <br><br>
                        
                    <h2>Personal Details</h2>

                        <div class="col-25">
                            Full Name:</div>
                            <div class="col-75">
                                <input type="ftext" name="fullname" id="name" value="<?php echo $fullname ?>" maxlength="100"  required ></div><br><br>

                        <div class="col-25">
                            Name with initials:</div>
                            <div class="col-75">
                                <input type="ftext" name="namewithinitials" id="nwi" value="<?php echo $namewithinitials ?>" maxlength="40" required></div><br><br>

                        <div class="col-25">
                            Gender:</div>
                            <div class="col-75">
                                <input type="radio" name="gender" id="male" value="Male"  > Male
                                <input type="radio" name="gender" id="female" value="Female"> Female</div> <br><br>

                        <div class="col-25">
                            National Identity Number:</div>
                            <div class="col-75">
                                <input type="NIC" name="NIC" maxlength="13" id="NIC" pattern="[0-9]{12}|[0-9]{12}[V-v]" value="<?php echo $NIC ?>" required></div><br><br>

                        <div class="col-25">
                            Passport Number:</div>
                            <div class="col-75">
                                <input type="passport" name="passportno" id="passportno" value="<?php echo $passportno ?>" maxlength="15"></div><br><br>

                        <div class="col-25">

                            Date of Birth:</div>
                            <div class="col-75">
                                <input type="date" id="day" name="day" value="<?php echo $dob ?>" required></div><br><br>

                        <div class="col-25">

                                Occupation:</div>
                                <div class="col-75">
                                    <input type="ftext" name="occupation" id="occupation" maxlength="50" value="<?php echo $occupation ?>" required></div><br><br>

                            <div class="col-25">

                                Salary:</div>
                                <div class="col-75">
                                    <input type="salary" name="salary" id="salary" pattern="[0-9]{3-9}" maxlength="20" value="<?php echo $salary ?>" required></div><br><br>

                            <div class="col-25">

                                Postal Address:</div>
                                <div class="col-75">
                                    <textarea name="paddress" id='paddress' rows="4" cols="40" maxlength="200" required><?php echo $paddress; ?></textarea></div><br><br>

                            <div class="col-25">
                                <br><br><br>
                                Work Address:</div>
                                <div class="col-75">
                                    <textarea name="waddress" id='waddress' rows="4" cols="40" maxlength="200"></textarea><?php echo $waddress ?></div><br><br>
                                        <br><br><br><br>

                            <br><br>
                            <h2>Contact Details</h2>


                        <div class="col-25">
                            Fixed Line:</div>
                            <div class="col-75">
                                <input type="phone" name="fixed" id="fixed" pattern="[0-9]{10}|[+][0-9]{11}" value="<?php echo $fixed ?>" maxlength="12" required></div><br><br>

                        <div class="col-25">
                            Mobile 1:</div>
                            <div class="col-75">
                                <input type="phone" name="mobile1" id="mobile1" pattern="[0-9]{10}|[+][0-9]{11}" value="<?php echo $omobile1 ?>" maxlength="12" required></div><br><br>

                        <div class="col-25">
                            Mobile 2:(Optional)</div>
                            <div class="col-75">
                                <input type="phone" name="mobile2" id="mobile2" pattern="[0-9]{10}|[+][0-9]{11}" value="<?php echo $omobile2 ?>" maxlength="12"></div><br><br>

                        <div class="col-25">
                            E-mail:</div>
                            <div class="col-75">
                                <input type="email" name="mail" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9._]+\.[a-z]{2,3}]" maxlength="300" value="<?php echo $mail ?>" required></div><br><br>

                        <div class="col-25">
                            Preferred Contact Method:</div>
                            <div class="col-75">

                                <input type="radio" name="method" value="Mobile" checked>Mobile
                                <input type="radio" name="method" value="Fixed Line" >Fixed
                                <input type="radio" name="method" value="E-mail" >E-mail
                                <input type="radio" name="method" value="Post" >Post
                            </div>
                            <br><br><br>

                            <h2>Vehicle Details</h2>

                        <div class="num">
                        <div class="col-25">
                            Chassis Number:</div>
                            <div class="col-75">
                                <input type="num" name="chassis" maxlength="17" required></div><br><br>

                        <div class="col-25">
                            Engine Number:</div>
                            <div class="col-75">
                                <input type="num" name="engine" maxlength="17" required></div><br><br>

                        <div class="col-25">
                            Registration Number:</div>
                            <div class="col-75">
                                <input type="num" name="reg" pattern="[A-Z]{2-3}[-][0-9]{4}" maxlength="8" required></div><br><br>

                        <div class="col-25">
                            Estimated Market Value:</div>
                            <div class="col-75">
                                <input type="num" name="marketprice" pattern="[0-9]{3-10}" maxlength="10" required></div><br><br>
                        </div>
                        <div class="col-25">
                            Model:</div>
                            <div class="col-75">
                                <input type="model" name="model" maxlength="50" required></div><br><br>

                        <div class="col-25">
                            Year of Manufacture:</div>
                            <div class="col-75">
                                <input type="year" pattern="[0-9]{4}" name="manuyear" maxlength="4" required></div><br><br>

                        <div class="col-25">
                            Number of Seats:</div>
                            <div class="col-75">
                                <input type="seat" name="seats" pattern="[0-9]{1-2}" required></div><br><br>

                        <div class="col-25">
                            Fuel type:</div>
                            <div class="col-75">
                                <input type="radio" name="type" value="Gasoline" checked>Gasoline
                                <input type="radio" name="type" value="Deisel">Diesel
                                <input type="radio" name="type" value="Hybrid">Hybrid
                                <input type="radio" name="type" value="Electric">Electric</div><br>

                        <br><br>

                            <h2>Insurance Details</h2>


                        <div class="col-25">
                            Policy Type:</div>
                            <div class="col-75">
                                <select name="policy">
                                    <option value="P001">Motorcycles and Three Wheelers</option>
                                    <option value="P002">Cars and Mini Vans</option>
                                    <option value="P003">Vans and SUVs</option>
                                    <option value="P004">Heavy Vehicles</option>
                                    <option value="P005">Vehicles on Rent</option>
                                </select></div><br><br>

                        <div class="col-25">
                            Validity Period:</div>
                            <div class="col-75">
                                From: <input type="date" name="sdate" id="sdate" required>
                                To: <input type="date" name="edate" id="edate" required></div><br><br>



                        <div class="col-25">
                            Type of Cover:</div>
                            <div class="col-75">
                                <input type="radio" name="covertype" value="Comprehensive" checked>Comprehensive
                                <input type="radio" name="covertype" value="Third Party">Third Party</div><br>


                        <div class="sub">
                            <div>
                            <input type="checkbox" id="chkbox" name="chkbox" onclick="enbsub()">All above details are correct and I accept company terms and conditions
                            </div>
                        <!-- date validation -->
                        <input type="submit" onclick="dval()" id="sub" name="submit" disabled>
                        </div><br>
                    </form>
                </div>
            </section>

            <?php chkgender($gender); echo $change; ?> <!-- php variables to disable and select gender automatically of an existing user-->

            <section class="footer">
                <h4>Follow Us On</h4>
                <div class="smicons">
                    <a href="https://twitter.com/login"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com"><i class="fab fa-facebook-square"></i></a>
                </div>
                <hr>
                <div class="bottom">
                        <div class="data">
                            <p>2021 Rapid Motor Insurance PLC - All Rights Reserved.</p>
                        </div>
                        <div class="blink">
                            <a href="">Terms of Use</a>
                            <a href="">Data & Web Privacy Policies</a>
                        </div>
                </div>
            </section>
        </div>
    </body>
</html>
