<?php 
    require 'config.php';
    session_start();
    $name="Login";
    $flag=0;
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
    }
    else{
        $log="login.php";
    }
// explained in crequest.php

    if (isset($_POST["submit"])) {
      $uname=$_POST["Username"];
      $pass=$_POST["pass"];
      $hpass=password_hash($pass, PASSWORD_BCRYPT); //one way hashing the password to improve security
      $fetch="SELECT Username FROM account WHERE Username='$uname'";
      if($con->query($fetch)){ //checking for a matching account
        $result=$con->query($fetch);
        while ($row=$result->fetch_assoc()) {
          if (sizeof($row)>0) {
            $flag=1;
          }
        }
      }
      if ($flag==1) {
        $update="UPDATE `account` SET `Password`='$hpass' WHERE Username='$uname'";
        if($con->query($update)){
          $msg="password change success";
          $rd="login.php";
        }
        else {
          $msg="password change failed";
          $rd="forgot.php";
        }
        $con->close();
      }
      if ($flag==0) {
         $msg="No Account with Specified Username!, Try Creating one";
         $rd="signup.php";
      }
      function response($msg){
        global $rd;
        echo "<script> alert('$msg'); window.location='$rd'; </script>";
      }
      response($msg);
    }
    
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel=stylesheet href="./css/signup.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <script src="../src/js/slider.js"></script>

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
                        <a  href="<?php echo $log; ?>"><h1 class="log"><?php echo $name; ?></h1></a>
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

            <section>
              <h1 class="th1">Reset Password</h1>
                <div class="grid">
                  <div class="form">
                    <h2>Fill all Fields</h2>
                        <form action="" method="post">
                          <div class="tform">
                            <input type="text" name="Username" required maxlength="50" placeholder="Username" pattern="[0-9A-Za-z_]{5,50}">
                            <input type="password" placeholder="New Password" name="pass" id="pass" pattern="[A-Za-z0-9_@$#!%^&*/<>]{8,50}" maxlength="50" required>
                            <input type="password" maxlength="50" placeholder="Re-Type New Password" name="rpass" id="rpass" required>
                          </div>   <!-- Checking password pattern and requirements -->
                          <div class="sub">
                            <input type="submit" name="submit" value="Reset Password" onclick="chkpass(); rstmsg();"> 
                          </div>
                        </form>
                  </div>
                  <div class="timg1">
                  </div>
                </div>
            </section>

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
