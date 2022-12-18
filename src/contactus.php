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
// getting current logged user's name via sessions and using it to reassign urls dynamically
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel="stylesheet" href="./css/contact.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <script src="../src/js/slider.js"></script>
        <!-- Used google online fonts for easy font change -->
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
                    <container> <!-- change login button link if user is logged in -->
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
                <h1 class="th1">Contact Us</h1>
                <div class="Contactgrid">
                    <div class="contacts">
                        <div class="column">
                            <i class="fa fa-phone"></i>
                            <label for="">Hotlines :</label>
                            <ul>
                                <li>+94 16 4532 8764</li>
                                <li>+94 04 6574 8723</li>
                                <li>+94 12 6754 0987</li>
                                <li>+94 22 3344 6677</li>
                            </ul>
                        </div>
                        <div class="column">
                        <i class="fa fa-map-marker"></i>    
                        <label for="">Emails :</label>
                            <ul>
                                <li>rapidmortorinsurance@rapid.lk</li>
                                <li>rapidmortorinsurance@gmail.com</li>
                                <li>rapidmortorinsurance@outlook.com</li>
                                <li>rapidinsuranceplc@rapid.lk</li>
                            </ul>
                        </div>
                        <div class="column">
                        <i class="fa fa-envelope"></i>    
                        <label for="">Visit Us at :</label>
                            <p>Rapid Motor Insurance PLC,<br>78/2,Union Place,<br>Colombo 4,<br>Sri Lanka.</p>
                        </div>
                    </div> <!-- iframe map link was ripped from google maps for better user interaction--> 
                    <div class="map">
                        <div class="mapouter"><div class="gmap_canvas"><iframe width="400" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=sliit&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/">divi discount</a><br><style>.mapouter{position:relative;text-align:right;border-radius:20px;box-shadow: 3px 6px 18px -3px rgba(0,0,0,0.53);height:400px;width:400px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:400px;border-radius:20px;box-shadow: 3px 6px 18px -3px rgba(0,0,0,0.53);}</style></div></div>
                    </div>
                    <div class="image">
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