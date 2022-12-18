<?php
    require("config.php");
    session_start();
    $name="Login";
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
    }
    else{
        $log="login.php";
    }
    //inserting data into inquiry table
    if(isset($_POST["submit"])){
        $policy=$_POST["policy"];
        $fname=$_POST["fname"];
        $mail=$_POST["mail"];
        $mobile1=$_POST["mobile1"];
        $adinfo=$_POST["adinfo"];
        $insert="INSERT INTO `inquiry`(`PolicyID`, `FullName`, `Email`, `ContactNo`, `Additional_info`) VALUES ('$policy','$fname','$mail','$mobile1','$adinfo')";

        if($con->query($insert)){
            echo "<script> alert('Inquiry Sent');</script>";
        }
        else{
            echo "Failed";
        }
        $con->close();
    }
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel=stylesheet href="./css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel="stylesheet" href="css/products.css">
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
                
                <div class="grid">
                    <a href="Policy.php" ><div class='thumb1' >
                        <div class="htxt" >
                            <h1 class="th1" >Motorbikes & Three wheelers</h1>
                        </div>
                    </div></a>
                    <a href="#"><div class='thumb6'>
                        <div class="htxtM">
                            <h1 class="th1">Our Plans</h1>
                        </div>
                        </div></a>
                    <a href="Policy.php"  ><div class="thumb2" >
                        <div class="htxt" >
                            <h1 class="th1">Cars & Mini Vans</h1>
                        </div>
                    </div></a>
                    <a href="Policy.php"  ><div class='thumb3' >
                        <div class="htxt" >
                            <h1 class="th1">Vans & SUVs</h1>
                        </div>
                    </div></a>
                    <a href="Policy.php" ><div class='thumb4' >
                        <div class="htxt">
                            <h1 class="th1">Heavy Vehicles</h1>
                        </div>
                    </div></a>
                    <a href="Policy.php"  ><div class='thumb5' >
                        <div class="htxt">
                            <h1 class="th1">Vehicles on Rent</h1>
                        </div>
                    </div></a>
                    
                </div>

            </section>

            <secction>
                <div class="grid2">
                    <div class="form">
                        <h1>Send a Quick Inquiry</h1>
                        <form method="post" action="">
                            <div class="tin">
                                <select name="policy" required>
                                    <option value="P001" selected>Motorcycles and Three Wheelers</option>
                                    <option value="P002">Cars and Mini Vans</option>
                                    <option value="P003">Vans and SUVs</option>
                                    <option value="P004">Heavy Vehicles</option>
                                    <option value="P005">Vehicles on Rent</option>
                                </select>
                                <input type="text" name="fname" maxlength="70" placeholder="Full Name" required>
                                <input type="email" name="mail" pattern="[a-z0-9._%+-]+@[a-z0-9._]+\.[a-z]{2,3}]" maxlength="300" required placeholder="Email">
                                <input type="text" name="mobile1" pattern="[0-9]{10}|[+][0-9]{11}" maxlength="12" required placeholder="Contact No">
                            </div>
                            <div class="tarea">
                                 <textarea maxlength="400" name="adinfo" class="adinfo"> </textarea>
                            </div>
                            <div class="sub">

                                <input type="submit" class="submit" name="submit" value="Send Inquiry">
                            </div>
                        </form>
                    </div>
                    <div class="cimg">
                        <div class="info">
                        </div>
                    </div>
                </div>
            </secction>

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
