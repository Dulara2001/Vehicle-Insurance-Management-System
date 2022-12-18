<?php //php html css by W.M.A.J.Wijesinghe
      /* each account has a privilege level 1,2,3
         1 for non policy holder accounts
         2 for policy holder customers
         3 for admins
         
         this page will load differently for each account type and it will load 
         Account details of logged in user
         
         for level 1 users it will only show profile picture upload and logout, remove account
         for level 2 users it will show their policy status payment history and they can manage their personal details, remove policies etc...
         for level 3 users it will allow them to update policy data prices, names etc..*/ 

    require('config.php');
    session_start();

    if(isset($_SESSION["USER"])){
      $log="user.php";
      $name=$_SESSION["USER"];
      $PL=$_SESSION["PL"];

      $fchAcc="SELECT * FROM account WHERE Username='$name'";
      if($con->query($fchAcc)){
        $accData=$con->query($fchAcc);
        while($row=$accData->fetch_assoc()){
          $PL=$row["PL"];
          $uImgLocation=$row["ImgLocation"];
        }
      }//fetching account details of the logged user to display
      else{
        echo 'fetch failed';
      }

      if($PL==1){
        $NIC='';
        $dob='';
        //account deletion of level one accounts
        if(isset($_POST["DelAcc"])){
          $removeAcc="DELETE FROM account WHERE Username='$name'";

          if($con->query($removeAcc)){
            session_destroy();
            echo "<script> alert('Account Removed!'); window.location='index.php'</script>";
          }
          else{
            echo "<script> alert('Account Removal Unsuccess'); window.location='user.php'</script>";
          }
        }
        
        $unhide="<script> document.getElementById('lvl01').hidden=false; </script>";
        if(isset($_POST["lvl01update"])){
          //profile image upload
          if(!empty($_FILES['uimg2'])){    
            $imgName=$_FILES['uimg2']['name'];
            $tempName=$_FILES["uimg2"]['tmp_name'];
            $imgSize=$_FILES['uimg2']['size'];
            $imgError=$_FILES['uimg2']['error'];
  
            $tExt=explode('.', $imgName);
            $rExt=strtolower(end($tExt));
  
            echo $rExt;
  
            $validExt=array('jpg', 'png', 'jpeg', 'jfif', 'gif', 'raw', 'bmp');
            if(in_array($rExt, $validExt)){
              if($imgError===0){
                if($imgSize<50000000){
                  $newImgName=$name.'.'.$rExt;
                  $imgLocation='./profileImages/'.$newImgName;
                  move_uploaded_file($tempName, $imgLocation);
                  $insertImg="UPDATE account SET ImgLocation='$imgLocation' WHERE Username='$name'";
                  if($con->query($insertImg)){
                    echo "Image Uploaded";
                  }
                  else{
                    echo "Image Upload Failed";
                  }
                }
                else{
                  echo "File is too large";
                }
              }
              else{
                echo "Error Occured";
              }
            }
            else{
              echo "Invalid File Type";
            } 
          }
          else {
            echo "image null";
          }
          echo "<script> alert('Detail Update Success'); window.location='user.php'</script>";
        }
        
      }       

      
      elseif($PL==2){

        $valCustomer="SELECT COUNT(CP.PolicyID) AS pCount FROM customer_policy CP, customer C, account A WHERE A.Username=C.Username AND C.NIC=CP.NIC AND A.Username='$name'";
        if($con->query($valCustomer)){
          $count=$con->query($valCustomer);
          while($row=$count->fetch_assoc()){
            $pCount=$row["pCount"];
            }
          }
        
        if($pCount<1){
          $dgrdeAcc="UPDATE account SET PL='1' WHERE Username='$name'";
          $resetCust="DELETE FROM customer WHERE Username='$name'";
          if($con->query($dgrdeAcc) && $con->query($resetCust)){
            session_destroy();
            echo "<script> alert('You have no existing plans subscribed your customer acoount will be reset'); window.location='index.php' </script>";
          }
        } 

        $unhide="<script> document.getElementById('customer').hidden=false; </script>";
        $fchUdata="SELECT * FROM customer WHERE Username='$name'";
        $fetch2="SELECT CP.ContactNo FROM customercontact CP, customer C WHERE C.NIC=CP.NIC AND C.Username='$name'";

        $waddress='';
        $omobile1='';
        $omobile2='';

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
      

        if($con->query($fchUdata)){
          $Udata=$con->query($fchUdata);
          while($row=$Udata->fetch_assoc()){
            $NIC=$row["NIC"];
            $fullname=$row["CustomerName"];
            $namewithinitials=$row["NameWithInitials"];
            $gender=$row["Gender"];
            $passportno=$row["PassportID"];
            $dob=$row["DOB"];
            $occupation=$row["Occupation"];
            $salary=$row["Salary"];
            $mail=$row["Email"];
            $fixed=$row["FixedLine"];
            $paddress=$row["HomeAddress"];
            $waddress=$row["WorkAddress"];
          }
        }
        else{
          echo "fetch Failed";
        }

        if(isset($_POST["DelAcc"])){
          $removeAcc="DELETE FROM account WHERE Username='$name'";
          $removeCustomer="DELETE FROM customer WHERE NIC='$NIC'";
          if($con->query($removeAcc)){
            session_destroy();
            echo "<script> alert('Account Removed!'); window.location='index.php'</script>";
          }
          else{
            echo "<script> alert('Account Removal Unsuccess'); window.location='user.php'</script>";
          }
        }

        if(isset($_POST["remove"])){
          $pid=$_POST["policy"];
          $reg=$_POST["reg"];
          $NIC=$_POST["NIC"];
          
          $flag=0;
          $flag2=0;
          $val="SELECT NIC, PolicyID, RegNo FROM customer_policy WHERE NIC='$NIC' and PolicyID='$pid' and RegNo='$reg'";
  
          if($con->query($val)){
            $result=$con->query($val);
            while($row=$result->fetch_assoc()){
              if (sizeof($row)>0) {
                $flag=1;
              }
            }
          }
            
          if($flag==1){
            $chkVehicle="SELECT COUNT(RegNo) AS policyCount FROM customer_policy WHERE NIC='$NIC' AND RegNo='$reg'";
            $removePol="DELETE FROM `customer_policy` WHERE NIC='$NIC' AND RegNo='$reg' AND PolicyID='$pid'";
            $remVehicle="DELETE FROM customer_vehicle WHERE NIC='$NIC' AND RegNO='$reg'";
            $msg2='';
            if($con->query($removePol)){
              $msg='Policy Plan Removed From The Vehicle';
            }
            else{
              $msg='Policy removal Failed';
            }
            if($con->query($chkVehicle)){
              $result=$con->query($chkVehicle);
              while($row=$result->fetch_assoc()){
                if ($row["policyCount"]<1) {
                  $flag2=1;
                }
              }
            }
            if($flag2==1){
              if($con->query($remVehicle)){
                $msg2='Vehicle Removed from account Due to no existing Plans!';
              }
            }
          }
          else{
            echo "<script> alert('No Policy plan exists given Data');</script>";
          }
          echo "<script> alert($msg); window.location='user.php'; </script>";
        }

        if(isset($_POST["UpData"])){
          $fullname = $_POST['fullname'];
          $namewithinitials = $_POST['namewithinitials'];  
          $occupation = $_POST['occupation'];
          $salary = $_POST['salary'];
          $postal = $_POST['paddress'];
          $work = $_POST['waddress'];
          $fixed = $_POST['fixed'];
          $mobile1 = $_POST['mobile1'];
          $mobile2 = $_POST['mobile2'];
          $mail = $_POST['mail'];
          $method = $_POST['method'];
          $paddress = $_POST["paddress"];
          $waddress = $_POST["waddress"];

          $upCust="UPDATE `customer` SET `NameWithInitials`='$namewithinitials',`CustomerName`='$fullname',`Occupation`='$occupation',`Salary`='$salary',`WorkAddress`='$waddress',`HomeAddress`='$paddress',`Email`='$mail',`FixedLine`='$fixed',`Preferred_contact`='$method' WHERE Username='$name'";
          $upCusCo="UPDATE `customercontact` SET `ContactNo`='$mobile1' WHERE NIC='$NIC' AND ContactNo='$omobile1'";
          
          
          if(!empty($omobile2)){
            $upCusCo2="UPDATE `customercontact` SET `ContactNo`='$mobile2' WHERE NIC='$NIC' AND ContactNo='$omobile2'";
          }
          else{
            $upCusCo2="INSERT INTO `customercontact` VALUES('$NIC', '$mobile2')";
          }

          if($con->query($upCust) && $con->query($upCusCo) && $con->query($upCusCo2)){
            echo "Update Success";
          }
          else{
            echo "Update failed";
          }
  
          if(!empty($_FILES['uimg'])){    
            $imgName=$_FILES['uimg']['name'];
            $tempName=$_FILES["uimg"]['tmp_name'];
            $imgSize=$_FILES['uimg']['size'];
            $imgError=$_FILES['uimg']['error'];
  
            $tExt=explode('.', $imgName);
            $rExt=strtolower(end($tExt));
  
            echo $rExt;
  
            $validExt=array('jpg', 'png', 'jpeg', 'jfif', 'gif', 'raw', 'bmp');
            if(in_array($rExt, $validExt)){
              if($imgError===0){
                if($imgSize<50000000){
                  $newImgName=$name.'.'.$rExt;
                  $imgLocation='./profileImages/'.$newImgName;
                  move_uploaded_file($tempName, $imgLocation);
                  $insertImg="UPDATE account SET ImgLocation='$imgLocation' WHERE Username='$name'";
                  if($con->query($insertImg)){
                    echo "Image Uploaded";
                  }
                  else{
                    echo "Image Upload Failed";
                  }
                }
                else{
                  echo "File is too large";
                }
              }
              else{
                echo "Error Occured";
              }
            }
            else{
              echo "Invalid File Type";
            } 
          }
          echo "<script> alert('Detail Update Success'); window.location='user.php'</script>";
        }
      }
      
      elseif($PL==3){
        $NIC='';
        $dob='';

        if(isset($_POST["DelAcc"])){
          echo "<script> alert('You don't have enough privileges to remove an Admin account!!!'); window.location='user.php'</script>";
        }
        
        $unhide="<script> 
                document.getElementById('lvl01').hidden=false;
                document.getElementById('managePolicy').hidden=false;
                </script>";
        if(isset($_POST["lvl01update"])){

          if(!empty($_FILES['uimg2'])){    
            $imgName=$_FILES['uimg2']['name'];
            $tempName=$_FILES["uimg2"]['tmp_name'];
            $imgSize=$_FILES['uimg2']['size'];
            $imgError=$_FILES['uimg2']['error'];
  
            $tExt=explode('.', $imgName);
            $rExt=strtolower(end($tExt));
  
            echo $rExt;
  
            $validExt=array('jpg', 'png', 'jpeg', 'jfif', 'gif', 'raw', 'bmp');
            if(in_array($rExt, $validExt)){
              if($imgError===0){
                if($imgSize<50000000){
                  $newImgName=$name.'.'.$rExt;
                  $imgLocation='./profileImages/'.$newImgName;
                  move_uploaded_file($tempName, $imgLocation);
                  $insertImg="UPDATE account SET ImgLocation='$imgLocation' WHERE Username='$name'";
                  if($con->query($insertImg)){
                    echo "Image Uploaded";
                  }
                  else{
                    echo "Image Upload Failed";
                  }
                }
                else{
                  echo "File is too large";
                }
              }
              else{
                echo "Error Occured";
              }
            }
            else{
              echo "Invalid File Type";
            } 
          }
          else {
            echo "image null";
          }
          echo "<script> alert('Detail Update Success'); window.location='user.php'</script>";
        }

        if(isset($_POST["P001"]) || isset($_POST["P002"]) || isset($_POST["P003"]) || isset($_POST["P004"]) ||isset($_POST["P005"])){
          $pid=$_POST["pid"];
          $rAmt=$_POST["renewAmt"];
          $AnnAmt=$_POST["annualAmt"];
          
          $updatePolicy="UPDATE policy SET RenewAmount='$rAmt', AnnualAmount='$AnnAmt' WHERE PolicyID='$pid'";
          if($con->query($updatePolicy)){
            echo "<script> alert('Update Success'); window.location='user.php' </script>";
          }
          else{
            echo "Update Failed";
          }
        }
      }
    
      function loadUimg(){
        global $uImgLocation;
        echo "<script> document.getElementById('profpic').style.backgroundImage = 'url($uImgLocation)'; </script>";
      }

      function loadUimg2(){
        global $uImgLocation;
        echo "<script> document.getElementById('profpic2').style.backgroundImage = 'url($uImgLocation)'; </script>";
      }
      
      $cdate=date("Y-m-d");
      $tday= new DateTime("$cdate");
      $bday= new DateTime("$dob");
      $age = date_diff($bday, $tday);
      $fetch3="SELECT * FROM customer_policy WHERE NIC='$NIC' ORDER BY Expiry_date ASC";
      $fchvle="SELECT COUNT(RegNo) AS vehicles FROM customer_vehicle WHERE NIC='$NIC'";
      $fchval="SELECT COUNT(RegNo) AS valid FROM customer_policy WHERE NIC='$NIC' AND Validity='VALID'";
      $fchinval="SELECT COUNT(RegNo) AS invalid FROM customer_policy WHERE NIC='$NIC' AND Validity='INVALID'";

      $chkval="SELECT RegNo, PolicyID, Expiry_date AS eday FROM customer_policy WHERE NIC='$NIC'";
      if($con->query($chkval)){
        $result4=$con->query($chkval);
        while($row=$result4->fetch_assoc()){
          $treg=$row['RegNo'];
          $tpid=$row["PolicyID"];
          $teday=$row["eday"];
          if($cdate>$teday){
            $updateCP="UPDATE customer_policy SET Validity='INVALID' WHERE NIC='$NIC' AND RegNo='$treg' AND PolicyID='$tpid'";
            if($con->query($updateCP)){
              echo "<script> alert('You Have Outdated Policies');</script>";
            }
          }
        }
      }
      else{
        echo "Validation failed";
      }

      if($con->query($fchvle) && $con->query($fchval) && $con->query($fchinval)){
        $result1=$con->query($fchvle);
        $result2=$con->query($fchval);
        $result3=$con->query($fchinval);
        $row1=$result1->fetch_assoc();
        $row2=$result2->fetch_assoc();
        $row3=$result3->fetch_assoc();
        $vehicles=$row1["vehicles"];
        $valid=$row2["valid"];
        $invalid=$row3["invalid"];
      }
      else{
        echo "Fetch failed";
      }

      function loadPolicyData(){
        global $con, $fetch3;
        if($con->query($fetch3)){
          $pdata=$con->query($fetch3);
          while($row=$pdata->fetch_assoc()){
            $pid=$row["PolicyID"];
            $reg=$row["RegNo"];
            $type=$row["Type"];
            $eday=$row["Expiry_date"];
            $sts=$row["Validity"];
            echo "<div>
              <ul class='td'>
                <li class='row'>
                  <div class='col1'>$pid</div>
                  <div class='col2'>$reg</div>
                  <div class='col3'>$type</div>
                  <div class='col4'>$eday</div>
                  <div class='col5'>$sts</div>
                </li>
              </ul>
            </div>";
          }
        }
      }
      
      $fetch5="SELECT PaymentID, Amount, Type, CardType, Date_Time FROM payments WHERE NIC='$NIC' ORDER BY Date_Time ASC";

      function loadPayData(){
        global $con, $fetch5;
        if($con->query($fetch5)){
          $paydata=$con->query($fetch5);
          while($row=$paydata->fetch_assoc()){
            $payid=$row["PaymentID"];
            $amt=$row["Amount"];
            $ctype=$row["CardType"];
            $day=$row["Date_Time"];
            $ptype=$row["Type"];
            echo "<div>
              <ul class='td'>
                <li class='row'>
                  <div class='col1'>$payid</div>
                  <div class='col2'>$ptype</div>
                  <div class='col3'>$amt</div>
                  <div class='col4'>$ctype</div>
                  <div class='col5'>$day</div>
                </li>
              </ul>
            </div>";
          }
        }
      }

      $bname = array();
      function policyManageTable(){
        global $con, $bname;
        $i=0;
        $fchPData="SELECT * FROM policy";
        if($con->query($fchPData)){
          $policyData=$con->query($fchPData);
          while($row=$policyData->fetch_assoc()){
            $bname[$i]=$row["PolicyID"];
            $pname=$row["PolicyName"];
            $renewAmt=$row["RenewAmount"];
            $annualAmt=$row["AnnualAmount"];
            echo "<div>
                  <form action='' method='POST'>
                    <ul class='td'>
                      <li class='row'>
                        <div class='colpa1'><input type='text' name='pid' maxlength='4' pattern='[P][0-9]{3}' required value=$bname[$i]></div>
                        <div class='colpa2'><input type='text' name='pname' maxlength='50' required value=$pname></div>
                        <div class='colpa3'><input type='number' name='annualAmt' maxlength='9' required value=$annualAmt></div>
                        <div class='colpa4'><input type='number' name='renewAmt' maxlenght='7' required value=$renewAmt></div>
                        <div class='colpa5'><input type='submit' value='Update' name=$bname[$i] ></div> 
                      </li>
                    </ul>
                  </form>
                  </div>";
            $i++;
          }
        }

        else{
          echo "fetch failed";
        }
      }
    }
  
    else{
        $log="login.php";
        header("Location:login.php");
    }

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location:index.php");
    }
?>

<html>
    <head>
        <meta name="viewport" content="with=device-width, initial-scale=1.0">

        <link rel=stylesheet href="./css/header and footer.css">
        <link rel=stylesheet href="./css/all.css">
        <link rel=stylesheet href="./css/user.css">
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
            <section id="customer" hidden >
              <section>
                <h1 class="th1">Dashboard</h1>
                <div class="grid">
                  <div class="user">
                    <div class="udata">
                      <label>Name :</label>
                      <p class="misc"><?php echo $fullname; ?></p>
                      <label>Occupation :</label>
                      <p class="misc"><?php echo $occupation; ?></p>
                      <label>Age :</label>
                      <p class="misc"><?php echo $age->y." Years"; ?></p>
                    </div>
                    <div  id="profpic" class="uimg">
                      <h1><?php echo $name; ?></h1>
                      <?php echo loadUimg(); ?>
                    </div>
                    <div class="udata">
                    <label>Email :</label>
                      <p class="misc"><?php echo $mail; ?></p>
                      <label>Mobile :</label>
                      <p class="misc"><?php echo $omobile1; ?></p>
                      <label>Fixed :</label>
                      <p class="misc"><?php echo $fixed; ?></p>
                    </div>
                  </div>
                  <div class="cards">
                    <div class="card">
                      <h3>Valid</h3>
                      <h1><?php echo $valid ?></h1>
                    </div>
                    <div class="card">
                      <h3>Outdated</h3>
                      <h1><?php echo $invalid ?></h1>
                    </div>
                    <div class="card">
                      <h3>Vehicles</h3>
                      <h1><?php echo $vehicles ?></h1>
                    </div>
                  </div>  
                </div>
              </section>
              
              <section>
              <h1 class="th1">Current Policy Status</h1>
                <div class="table">
                  <div>
                    <ul class="td">
                      <li class="topic">
                        <div class="col1">POLICY ID</div>
                        <div class="col2">VEHICLE REG NO</div>
                        <div class="col3">COVERAGE</div>
                        <div class="col4">EXPIRY DATE</div>
                        <div class="col5">STATUS</div>
                      </li>
                  </div>
                  <?php loadPolicyData();?>
                </div>
              </section>

              <section>
              <h1 class="th1">Payment History</h1>
                <div class="table">
                  <div>
                    <ul class="td">
                      <li class="topic">
                        <div class="col1">PAYMENT ID</div>
                        <div class="col2">TYPE</div>
                        <div class="col3">AMOUNT</div>
                        <div class="col4">METHOD</div>
                        <div class="col5">DATE</div>
                      </li>
                  </div>
                  <?php loadPayData();?>
                </div>
              </section>

              <section>
              <h1 class="th1">Manage</h1>
                <div class="manage">
                  <input type="button" class="mlink" onclick="swap();" value="Manager Personal Details">
                  <input type="button" class="mlink" onclick="swap2();" value="Manage Policies">
                </div>
              </section>

              <section id="mudata" hidden>
                <h1 class="th1">Manage Your Data</h1>
                <form action="" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Do you confirm detail update?');">
                  <div class="mudata">
                    <div class="cold1">
                      <label for="">Full Name</label>
                      <input type="text" name="fullname" id="name" value="<?php echo $fullname ?>" maxlength="100" required>
                      <label for="">Name With Initials</label>
                      <input type="text" name='namewithinitials' value="<?php echo $namewithinitials ?>" maxlength="40" required>
                      <label>Occupation</label>
                      <input type="text" name='occupation' value="<?php echo $occupation ?>" maxlength="50" required>
                      <label>Salary</label>
                      <input type="number" name='salary' value="<?php echo $salary ?>" maxlength="20" required>
                      <label>Fiexd Line</label>
                      <input type="text" name="fixed" pattern="[0-9]{10}|[+][0-9]{11}" value="<?php echo $fixed ?>" maxlength="12" required>
                      <label>Preffered Contact</label>
                      <div>
                        <input type="radio" name="method" value="Mobile" checked>Mobile
                        <input type="radio" name="method" value="Fixed Line" >Fixed
                        <input type="radio" name="method" value="E-mail" >E-mail
                        <input type="radio" name="method" value="Post" >Post
                      </div>
                    </div>
                    <div class="cold2">
                      <label for="">Postal Address</label>
                      <textarea name="paddress" rows="4" cols="40"  maxlength="200" required><?php echo $paddress?></textarea>
                      <label for="">Work Address</label>
                      <textarea name="waddress" rows="4" cols="40"  maxlength="200"><?php echo $waddress?></textarea>
                      <label>Mobile 1</label>
                      <input type="text" name="mobile1" pattern="[0-9]{10}|[+][0-9]{11}" value="<?php echo $omobile1 ?>" maxlength="12" required>
                      <label>Mobile 2</label>
                      <input type="text" name="mobile2" pattern="[0-9]{10}|[+][0-9]{11}" value="<?php echo $omobile2 ?>" maxlength="12">
                      <label>Email</label>
                      <input type="text" name="mail" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9._]+\.[a-z]{2,3}]" maxlength="300" value="<?php echo $mail ?>" required>
                      <label for="">Profile Picture</label>
                      <input type="file" name="uimg">
                    </div>
                  </div>

                  <center>
                  <input type="submit" name="UpData" Value="Update Details" >
                  </center>
                </form>
              </section>

              <section id="Mpolicy" hidden>
                <h1 class="th1">Remove Policies</h1>
                <div class="grid1">
                  <div class="form1">
                    <h2>Fill all Fields</h2>
                    <form  action="" method="post" onsubmit="return confirm('Do you really want to remove the above policy?');">
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
                    </div>
                  </div>
                  <div class="img1">
                  </div>
                </div>
                <center>
                <input type="submit" name="remove" value="Confirm and Remove Policy Plan">
                </form>
                </center>   
              </section>
            </section>
            
            <section id="lvl01" hidden>
              <h1 class="th1">Account</h1>
              <div class="grid3">
                <div id="profpic2" class="uimg2">
                  <h1><?php echo $name; ?></h1>
                  <?php loadUimg2(); ?>
                </div>
                <div class="form1">
                  <h2>Account Details</h2>
                  <form  action="" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Do you confirm detail update?');">
                    <div class="label">
                      <label for="">Profile Picture</label>
                      <input type="file" name="uimg2">
                      <input type="submit" name="lvl01update">
                  </form>
                  </div>
                </div>
              </div>
            </section>

            <section id='managePolicy' hidden>                       
              <h1 class="th1">Manage Policy Data</h1>
              <div class="table">
                <div>
                  <ul class="td">
                    <li class="topic">
                      <div class="colpa1">Policy ID</div>
                      <div class="colpa2">Policy Name</div>
                      <div class="colpa3">Annual Payment</div>
                      <div class="colpa4">Renew Payment</div>
                      <div class="colpa5">Action</div>
                    </li>
                </div>
                <?php policyManageTable(); ?>
              </div>
            </section>

            <?php echo $unhide?>

            <section>
              
                <div class='control'>
                  <form method="post" action="" onsubmit="return confirm('Do you really want to Logout?');">
                    <div class="cb"><input type="submit" name="logout" value="Log Out"></div>
                  </form> 
                  <form method="post" action="" onsubmit="return confirm('Do you really want to Delete the Account?');">
                    <div class="cb"><input type="submit" name="DelAcc" value="Remove Account"></div>
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


