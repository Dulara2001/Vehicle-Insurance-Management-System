<?php 
    require("config.php"); // config file holds database connection data
    session_start();
    $name="Login";
    if(isset($_SESSION["USER"])){
        $log="user.php";
        $name=$_SESSION["USER"];
        $PL=$_SESSION["PL"]; //using privilege level to redirect non policy holder users 
        if($PL<2){
          echo "<script> alert('Please subscribe to a policy plan to continue'); window.location='register.php';</script>";
        }
    }
    else{
        $log="login.php"; //using sessions to allow users only if they are logged in
        header("Location:login.php");
    }

    

    $flag=0;
    $NIC="";
// selecting data from customer table of the current logged in user
    $fchNIC="SELECT NIC FROM customer WHERE Username='$name'";
    if($con->query($fchNIC)){
      $result=$con->query($fchNIC);
      while($row=$result->fetch_assoc()){
        $NIC=$row["NIC"];
      }
    }
// getting form inputs 
    $PreportLocation='';
    if(isset($_POST["submit"])){
        $NIC=$_POST["NIC"];
        $policy=$_POST["policy"];
        $reg=$_POST["reg"];
        $chno=$_POST["chassis"];
        $day=$_POST["day"];
        $time=$_POST["time"];
        $place=$_POST["place"];
        $nocp=$_POST["nocp"];
        $PRsts=$_POST["PRsts"];
        $adinfo=$_POST["adinfo"];

        //validating form data to prevent wrong data being entered by customers by mistakes

        $val="SELECT C.NIC, C.PolicyID, C.RegNo FROM customer_policy C, customer_vehicle V WHERE C.NIC='$NIC' and C.PolicyID='$policy' and C.RegNo='$reg' and V.ChassisNo='$chno'";

        if($con->query($val)){
          $result=$con->query($val);
          while($row=$result->fetch_assoc()){
            if (sizeof($row)>0) {
              $flag=1;
            }
          }
        }
         
        
        if ($flag==1) {

          $fchLastCRID="SELECT ClaimRequestID FROM claim_request";
          if($con->query($fchLastCRID)){
            $CRIDarray=$con->query($fchLastCRID);
            $result=$CRIDarray->fetch_assoc();
            if(!empty($result)){
              $lastID=$result[array_key_last($result)];
            }
            else{
              $lastID = 0;
            }
          }
          $lastIDNo=(int)$lastID;
          $newID=$lastIDNo+1;

          //uploading police report, files will be stored in a separate folder called 'PoliceReports'
          //file will be renamed according to the claim request id and the policy holder NIC number
          //only the path of the file will be stored in the database to optimize queries.
          
          if(!empty($_FILES['Preport'])){    
            $pr=$_FILES['Preport'];
            $PreportName=$_FILES['Preport']['name'];
            $PreportTempName=$_FILES["Preport"]['tmp_name'];
            $PreportSize=$_FILES['Preport']['size'];
            $PreportError=$_FILES['Preport']['error'];
  
            $tExt=explode('.', $PreportName); //split the file name from extention
            $rExt=strtolower(end($tExt)); //transforming extention to lowercase to avoid insertion anomalies
  
          
    
            $validExt=array('jpg', 'png', 'jpeg', 'doc', 'docx', 'pdf', 'bmp'); // approved file extentions 
            if(in_array($rExt, $validExt)){
              if($PreportError===0){
                if($PreportSize<50000000){
                  $newPreportName='PR_'.$newID.'_'.$NIC.'.'.$rExt;
                  $PreportLocation='./PoliceReports/'.$newPreportName;
                  move_uploaded_file($PreportTempName, $PreportLocation); 
                }
                else{
                  echo "<script> alert('File size is over the maximun limit'); window.location='crequest.php';</script>";
                }
              }
              else{
                echo "<script> alert('File Upload Error'); window.location='crequest.php';</script>";
              }
            }
            else{
              echo "<script> alert('Invalid File Type'); window.location='crequest.php';</script>";
            }
          } 

          $insert="INSERT INTO `claim_request`(`NIC`, `PolicyID`, `RegNo`, `ChassisNo`, `AccidentDate`, `AccidentTime`, `Place`, `NoOfOccupants`, `PRStatus`, `Additional_info`, `PRLocation`) VALUES ('$NIC','$policy','$reg','$chno','$day','$time','$place','$nocp','$PRsts','$adinfo','$PreportLocation')";
          if($con->query($insert)){
            echo "<script> alert('Claim Request submitted'); window.location='user.php';</script>";
          }
          else{
            echo "<script> alert('Claim Request submit failed'); window.location='user.php';</script>";
          }
        }
        else{
          echo "<script> alert('Claim Request submit failed, No matching plan found'); window.location='crequest.php';</script>";
        }
        $con->close(); 
      }
      
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/header%20and%20footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel=stylesheet href="./css/reg.css">
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
              <h1 class="th1">Request Your Claim</h1>
              <div class="grid">
                <div class="form">
                  <h2>Fill all Fields</h2>
                    <form  action="" method="post" enctype="multipart/form-data" onsubmit="return confirm('Do you confirm above submission details?');">
                      <div class="label">
                        <label>Policy Holder NIC</label>
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
                        <label>Chassis Number</label>
                        <input type="text" name="chassis" maxlength="17" required>
                        <label>Accedent Date</label>
                        <input type="date" name="day" required>
                        <label>Accident Time</label>
                        <input type="time" name="time" required>
                        <label>Accident Place</label>
                        <textarea name="place" rows="4" cols="50" maxlength="200"></textarea>
                        <label>No of Occupants</label>
                        <input type="text" name="nocp">
                        <label>Police Report Status</label>
                        <div>
                          <input type="radio" name="PRsts" value="Yes" id="pr1" onclick="enbup()">
                          <label>Yes</label>
                          <input type="radio" name="PRsts" value="No" id="pr2" onclick="enbup()" checked>
                          <label>No</label>
                        </div>
                        <label>Upload Police Report</label>
                        <input type="file" name="Preport" disabled id="file">
                        <label>Additional Information</label>
                        <textarea name="adinfo" rows="4" cols="50" maxlength="400"></textarea>
                      </div>
                    <div class="sub" >
                      <input type="submit" name="submit" value="Submit Request">
                    </div>
                  </form>
                </div>
                <div class="info">
                  <h2>It's This Easy...</h2>
                  <p>We believe that making a claim should be as easy as ordering a pizza! That’s why we’ve made it our mission to make this as simple as humanly possible for you
                      If you meet with an accident, give us a call on 011 1458756 to report the accident
                      You may choose to do the examine yourself by taking a some photos and sending them across to us OR you can ask for an assessor to be sent to wherever you are.
                      Our team of engineers OR assessor on location will assess the damages and give you an estimate for the cost of repairs.
                      You can agree to the amount offered and collect the cash within a matter of seconds OR require to go in for a garage mend whereby we will sort out everything with the respective garage
                  </p>
                </div>
                <div class="img">
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
