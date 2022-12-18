<?php
    session_start();
    $name="Login";
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
    }
    else{
        $log="login.php";
    }
    
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel="stylesheet" href="css/policy.css">
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
              <h1 class="th1">Policy Details</h1> <!-- Using buttons to swap details of policies in  -->
              <div class="buttons3">
                <input type="button" onclick="loadpolicy('P001');" value="MB&TW">
                <input type="button" onclick="loadpolicy('P002');" value="C&MV">
                <input type="button" onclick="loadpolicy('P003');" value="V&S">
                <input type="button" onclick="loadpolicy('P004');" value="HV">
                <input type="button" onclick="loadpolicy('P005');" value="RV">
              </div>
            </section>

            <section>
                <h1 class="th2" id="po">Motorbikes & Three Wheelers</h1>
                <div class="grid">
                    <div>
                      <img src="./images/bike.jpg" id="timg" class="timg">
                    </div>
                    <div class="info">
                        <h1>General</h1>
                        <p id="pi"class="para">
                            Insurance for Motorcycles and Three Wheelers is a type of insurance policy which covers your vehicles from potential risks financially. Policyholder's Motorcycle or Three Wheeler is provided financial security against damages arising out of accidents and other threats. A Motorcycles and Three Wheelers insurance is bought by personal owners using thier vehicle for personal use. There are different types of policies which a vehicle owner can choose.
                        </p>
                    </div>
                    <div class="tc">
                        <h3>What does this policy cover?</h3>
                        <div class="list1">
                        <p id="p0">Damages/Loses caused by Accident, External Explotion, Fire, Theft of vehicle parts and 3rd party damages.</p>
                        </div>


                        <h3>Policy terms and conditions</h3>
                        <div class="list2">
                            <p id="p1">You will be given a free accidental hospitalization cover worth Rs.5000 per day.</p>
                            <p id="p2">For an added premium you can obtain personal accident benefits.</p>
                            <p id="p3">Due to misrepresentation and non-payment of premium, insurer cancelation will be take place.</p>
                            <p id="p4" hidden></p>
                            <p id="p5" hidden></p>
                            <p id="p6" hidden></p>
                        </div>
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
