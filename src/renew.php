<?php
    require("config.php");
    session_start();
    $name="Login";
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
        $PL=$_SESSION["PL"];
        if($PL<2){
          echo "<script> alert('Please subscribe to a policy plan to continue'); window.location='register.php';</script>";
        }//preventing non policy holders from accessing the payment portal
    }
    else{
        $log="login.php";
        header("Location:login.php");
    }
    $NIC="";
    $flag=0;
    //fetching NIC to autofill
    $fchNIC="SELECT NIC FROM customer WHERE Username='$name'";
    if($con->query($fchNIC)){
      $result=$con->query($fchNIC);
      while($row=$result->fetch_assoc()){
        $NIC=$row["NIC"];
      }
    }

    if(isset($_POST["submit"])){
      $NIC=$_POST["NIC"];
      $policy=$_POST["policy"];
      $reg=$_POST["reg"];
      $day=$_POST["day"];

      $cdate=date("Y-m-d"); //current date to validate the extend date
      if($cdate>$day){
        $rd1="renew.php";
        echo "<script> alert('Invalid Extend Date'); window.location='$rd1'; </script>";
      }

      $val="SELECT NIC, PolicyID, RegNo FROM customer_policy WHERE NIC='$NIC' and PolicyID='$policy' and RegNo='$reg'";

      if($con->query($val)){
        $result=$con->query($val);
        while($row=$result->fetch_assoc()){
          if (sizeof($row)>0) {
            $flag=1;
          }
        }
      }

      if($flag==1){
        $rd1="payments.php";
        $update="UPDATE `customer_policy` SET `Expiry_date`='$day',`Validity`='VALID' WHERE NIC='$NIC' AND PolicyID='$policy' AND RegNo='$reg'";
        //setting cookies for paymentportal for auto fill form and minimize faluty records
        setcookie("pid", $policy, time()+(360), "payments.php");
        setcookie('ptype', 'Renewal', time()+(360), "payments.php");
        setcookie('reg', $reg, time()+(60), "payments.php");
        setcookie("rnwdata", $update, time()+(360),"payments.php");

        echo "<script> alert('Policy plan Exists, OK to Continue!'); window.location='$rd1'; </script>";
      }

      else {
        $rd1="renew.php";
        echo "<script> alert('No Matching Policies'); window.location='$rd1'; </script>";
      }
      $con->close();
    }
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel="stylesheet" href="./css/reg.css">
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
              <h1 class="th1">Renew your Insurance in a Glance</h1>
              <div class="grid">
                <div class="form1">
                  <h2>Fill all Fields</h2>
                  <form  action="" method="post">
                    <div class="label">
                      <label>Policy Hoder NIC</label>
                      <input type="text" name="NIC" value="<?php echo $NIC; ?>" maxlength="13" pattern="[0-9]{12}|[0-9]{12}[V-v]" required>
                      <label>Policy Name</label>
                      <select name="policy" required>
                          <option value="P001">Motorcycles and Three Wheelers</option>
                          <option value="P002">Cars and Mini Vans</option>
                          <option value="P003">Vans and SUVs</option>
                          <option value="P004">Heavy Vehicles</option>
                          <option value="P005">Vehicles on Rent</option>
                      </select>
                      <label>Registration Number</label>
                      <input type="text" name="reg" pattern="[A-Z]{2-3}[-][0-9]{4}" maxlength="8" required>
                      <label>Extend Date</label>
                      <input type="date" name="day" required id="nday">
                  </div>
                  <div class="sub" >
                    <input type="submit" name="submit" value="Confirm and Proceed to Payment">
                  </div>
              </form>
              </div>
              <div class="img1">
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
