<?php //php html js css by W.M.A.J.Wijesinghe
    require("config.php");
    session_start();
    $name="Login";
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
        $PL=$_SESSION["PL"];
        if($PL<2){
          echo "<script> alert('Please subscribe to a policy plan to continue'); window.location='register.php';</script>";
        } //preventing non policy holders from accessing the payment portal
    }
    else{
        $log="login.php";
        header("Location:login.php");
    }

    //reading from database assigning policy plan prices to an array for easier access
    $fchPPrice="SELECT RenewAmount, AnnualAmount FROM policy";
    $price = array();
    $i=0;
    $j=$i+1;
    if($con->query($fchPPrice)){
      $policyPrices=$con->query($fchPPrice);
      while($row=$policyPrices->fetch_assoc()){
        $price[$i]=$row['RenewAmount'];
        $price[$j]=$row["AnnualAmount"];
        $i+=2;
        $j+=2;
      }
      echo "<script>
              var r1=$price[0];
              var r2=$price[2];
              var r3=$price[4];
              var r4=$price[6];
              var r5=$price[8];

              var a1=$price[1];
              var a2=$price[3];
              var a3=$price[5];
              var a4=$price[7];
              var a5=$price[9];
          </script>";
    }
   
    else{
      echo "Connection failed";
    } 

    $flag=0;
    $NIC="";
    $policy='';
    $reg='';
    $amount='';
    $ptype='';
    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d h:i:s'); //get current date time in asia colombo timezone

    // fetching nic for auto fill 
    $fchNIC="SELECT NIC FROM customer WHERE Username='$name'";
    if($con->query($fchNIC)){
      $result=$con->query($fchNIC);
      while($row=$result->fetch_assoc()){
        $NIC=$row["NIC"];
      }
    }
    // checking cookies for form fill automation
    if(isset($_COOKIE["pid"]) and isset($_COOKIE["ptype"]) and isset($_COOKIE["reg"])){ 
      $policy=$_COOKIE["pid"];
      $ptype=$_COOKIE["ptype"];
      $reg=$_COOKIE["reg"];
    }

    if(isset($_COOKIE["amt"])){
      $policy=$_COOKIE["pid"];
      $ptype=$_COOKIE["ptype"];
      $reg=$_COOKIE["reg"];
      $amount=$_COOKIE["amt"];
    }

    //fetching  customer policy details to validate payments
    $fchdata="SELECT CP.NIC, CP.PolicyID, CP.RegNo FROM customer_policy CP, account A, customer C WHERE A.Username=C.Username AND C.NIC=CP.NIC AND A.Username='$name'";
    if(isset($_POST["val"])){
    if($con->query($fchdata)){
      $data=$con->query($fchdata);
      while($row=$data->fetch_assoc()){
        $NIC=$_POST["NIC"];
        $policy=$_POST["policy"];
        $reg=$_POST["reg"];
        $amount=$_POST["amount"];
        $ptype=$_POST["type"];

        if($ptype=="Renewal" and !isset($_COOKIE["rnwdata"])){
          echo "<script> alert('Please Fill the Policy Renewal Form'); window.location='renew.php'; </script>";
        }

        if($NIC==$row["NIC"] and $policy==$row["PolicyID"] and $reg==$row["RegNo"]){
          $flag=1;
          break;
        }
      }

      if($flag==1){ //setting cookies for form fill automation
        setcookie('pid', $policy, time()+(60), "payments.php");
        setcookie('ptype', $ptype, time()+(60), "payments.php");
        setcookie('reg', $reg, time()+(60), "payments.php");
        setcookie('amt', $amount, time()+(60), "payments.php");

        echo "<script> alert('Data Validated'); window.location='payments.php'</script>";
      }
      elseif ($flag==0) {
        $amount='';
        $policy='';
        $ptype='';
        $reg='';
        echo "<script> alert('No Valid Records'); </script>";
      }
    }
  }

  //validating data to ensure error minimization
  if(isset($_POST["submit"])){
    $cnumb=$_POST["cnumb"];
    $ctype=$_POST["ctype"];
    $eday=$_POST["eday"];
    $cvc=$_POST["cvc"]; 
    $insertpay="INSERT INTO `payments`(`NIC`, `PolicyID`, `RegNo`, `Amount`, `Type`, `CardType`, `CardNumber`, `ExpiryDate`, `CVC`, `Date_Time`) VALUES ('$NIC','$policy','$reg','$amount','$ptype','$ctype','$cnumb','$eday','$cvc','$date')";

    if($ptype=="Renewal" and isset($_COOKIE["rnwdata"])){
      $updateCP=$_COOKIE["rnwdata"];
      //inserting data and unsetting cookies
      if($con->query($insertpay) and $con->query($updateCP)){
        setcookie("rnwdata",'',time()-(60));
        setcookie('pid', '', time()-(60));
        setcookie('ptype', '', time()-(60));
        setcookie('reg', '', time()-(60));
        setcookie('amt', '', time()-(60)); 
        echo "<script> alert('Renewal Payment Success'); window.location='user.php'</script>";
      }
      else{
        echo "<script> alert('Renewal Payment Failed!'); window.location='payments.php'</script>";
      }
    }
    elseif($ptype=="Renewal" and !isset($_COOKIE["rnwdata"])){
        setcookie("rnwdata",'',time()-(60));
        setcookie('pid', '', time()-(60));
        setcookie('ptype', '', time()-(60));
        setcookie('reg', '', time()-(60));
        setcookie('amt', '', time()-(60));
      echo "<script> alert('Time Expired!, Please Fill the Policy Renewal Form.'); window.location='renew.php'; </script>";
    }
    else{
      if($con->query($insertpay)){
        setcookie("rnwdata",'',time()-(60));
        setcookie('pid', '', time()-(60));
        setcookie('ptype', '', time()-(60));
        setcookie('reg', '', time()-(60));
        setcookie('amt', '', time()-(60));
        echo "<script> alert('Annual Payment Success'); window.location='user.php'</script>";
      }
      else{

        echo "<script> alert('Annual Payment Failed!'); window.location='payments.php'</script>";
      }
    }
    setcookie("rnwdata",'',time()-(60));
    
    $con->close();
  }
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel=stylesheet href="./css/payment.css">
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
              <h1 class="th1">Pay With Ease</h1>
              <div class="form">
                <form  action="" method="post">
                  <h2>Policy Details</h2>
                  <div class="label">
                    <label>Curent Time</label>
                    <p id="time"></p>
                    <label> Payment Type</label>
                    <select id="type" name="type" value="<?php echo $ptype; ?>">
                      <option value="">Select Payment Type</option>
                      <option value="Annual" <?php if($ptype=="Annual"){ echo "selected='selected'";} ?> >Annual Payment</option>
                      <option value="Renewal" <?php if($ptype=="Renewal"){ echo "selected='selected'";} ?> >Renewal Payment</option>
                    </select>
                    <label>Policy Holder NIC</label>
                    <input type="text" name="NIC" value="<?php echo $NIC; ?>" maxlength="13" pattern="[0-9]{12}|[0-9]{12}[V-v]" required>
                    <label>Policy Name</label>
                    <select id="pid" name="policy" value="<?php echo $policy; ?>" required>
                        <option value="def">Select a Policy</option>
                        <option value="P001" <?php if($policy=="P001"){ echo "selected='selected'";} ?> >Motorcycles and Three Wheelers</option>
                        <option value="P002" <?php if($policy=="P002"){ echo "selected='selected'";} ?> >Cars and Mini Vans</option>
                        <option value="P003" <?php if($policy=="P003"){ echo "selected='selected'";} ?> >Vans and SUVs</option>
                        <option value="P004" <?php if($policy=="P004"){ echo "selected='selected'";} ?> >Heavy Vehicles</option>
                        <option value="P005" <?php if($policy=="P005"){ echo "selected='selected'";} ?> >Vehicles on Rent</option>
                    </select>
                    <label>Vehicle Registration Number</label>
                    <input type="text" name="reg" pattern="[A-Z]{2-3}[-][0-9]{4}" maxlength="8" value="<?php echo $reg; ?>" required>
                    <label>Amount</label>
                    <input type="number" name="amount" required onclick="calamt();" value="<?php echo $amount; ?>" id="amt">
                  </div>
                  <div class="sub">
                      <input type="submit" name="val" value="Validate" id="val" onclick="calamt();">
                  </div>
                </form>
                <form action="" method="post" onsubmit>
                  <h2>Card Details</h2>
                  <div class="label">
                    <label>Card Type</label>
                    <select name="ctype">
                      <option value="">Select Card</option>
                      <option value="Visa">Visa</option>
                      <option value="Master Card">Master Card</option>
                      <option value="American Express">American Express</option>
                    </select>
                    <label>Card Number</label>
                    <input type="text" name="cnumb" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="19" required pattern="[0-9]{4}[-]+[0-9]{4}[-]+[0-9]{4}[-]+[0-9]{4}">
                    <label>Expiry Date</label>
                    <input type="date" name="eday" required>
                    <label>CVC</label>
                    <input type="text" name="cvc" required pattern="[0-9]{3-4}">
                  </div>
                  <div class="sub">
                    <input type="submit" name="submit" value="Confirm and Pay">
                  </div>
                </form>
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
