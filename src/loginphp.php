<?php
    require'config.php';
    session_start();
    $uname="Login";
    
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
    }
    else{
        $log="login.php";
    }
    $pass="";

    //fetching account details to validate login 
    if(isset($_POST["submit"])){
        $sql="SELECT * FROM `account` WHERE 1";

        $uname=$_POST["Username"];
        $pass=$_POST["Password"];
        $flag=0;
        
        if($con->query($sql)){
            $result=$con->query($sql);
            while($row=$result->fetch_assoc()){ //verifying hashed password
                if($row["Username"]==$uname and password_verify($pass, $row["Password"])){
                    $pLvl=$row["PL"];
                    $hpass=$row["Password"];
                    $uImgLoc=$row["ImgLocation"]; //fetching dynamic user details at login success
                    $flag=1;
                    break;
                }
            }
            if($flag==1){
                $_SESSION["USER"]=$uname;
                $_SESSION["PL"]=$pLvl;
                $_SESSION["uImgLoc"]=$uImgLoc; //setting sessions from dynamic account details
                if(isset($_POST["rme"])){
                    setcookie("user", $uname, time()+(3600),"/");//setting username as a cookie if the remember me check box is ticked
                }
                $msg="Hello ".$uname; //Dynamic login messeges according to login status
                $msg2="Have a nice Day";
                $msg3="location.href='user.php'";
             }
            else{
                $uname="Login";
                $msg="OOPS!";
                $msg2="Invalid Username or Password Entered";
                $msg3="location.href='login.php'";
            }
        }
        $con->close();
    }
    else{
        echo "Conenction Error";
    }

?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel=stylesheet href="./css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel=stylesheet href="./css/home.css">
        <link rel=stylesheet href="css/login.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

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
                        <a  href="<?php echo $log; ?>"><h1 class="log"><?php echo $uname ?></h1></a>
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

            <section class="msg">
                <div class="smsg">
                    <H1><?php echo $msg; ?></H1><!--  Display generated messeges-->
                    <p><?php echo $msg2; ?></p> <!-- Setting an automatic redirect to user to relevent page upon the login status-->
                    <script>
                        setTimeout("<?php echo $msg3; ?>", 3000);
                    </script>
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
