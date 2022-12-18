<?php
    require 'config.php';
    session_start();
    $name="Login";
    $flag=0;
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
        header("location:user.php");
    }
    else{
        $log="login.php";
    }

    if (isset($_POST["submit"])) {
      $uname=$_POST["Username"];
      $pass=$_POST["pass"];
      $rpass=$_POST["rpass"];
      //hashing password before storing in the daatabase to improve security
      $hpass = password_hash($rpass, PASSWORD_BCRYPT);
      //checking for existing usernames for minimize insertion errors
      $fetch="SELECT Username FROM account WHERE Username='$uname'";
      if($con->query($fetch)){
        $result=$con->query($fetch);
        while ($row=$result->fetch_assoc()) {
          if (sizeof($row)>0) {
            echo "<script > alert('Username Unavailable, Please try using another unsername'); window.location='signup.php'</script>";
            $flag=1;
          }
        }

      }
      //inserting data into th database after double checking the password
      if ($flag==0) {
        $insert="INSERT INTO account VALUES('$uname', '$hpass', 1, './profileImages/default.png')";
        if($con->query($insert)){
          echo"<script > alert('Account Created!, Please Login To Continue'); window.location='login.php'</script>";
        }
        else {
          echo "<script > alert('Account Creation Unsuccessfull!); window.location='signup.php'</script>";
        }
      }
      $con->close();
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
              <h1 class="th1">Create Account</h1>
                <div class="grid">
                  <div class="form">
                    <h2>Fill all Fields</h2>
                        <form action="" method="post">
                          <div class="tform">
                            <input type="text" name="Username" required maxlength="50" placeholder="Username" pattern="[0-9A-Za-z_]{5,50}">
                            <input type="password" placeholder="Password" name="pass" id="pass" pattern="[A-Za-z0-9_@$#!%^&*/<>]{8,50}" maxlength="50" required>
                            <input type="password" maxlength="50" placeholder="Re-Type Password" name="rpass" id="rpass" required>
                          </div>
                          <div class="sub">
                            <input type="submit" name="submit" value="Create Account" onclick="chkpass()">
                          </div>
                        </form>
                  </div>
                  <div class="timg">
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
