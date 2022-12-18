//digital clock function in payment portal

setInterval(
  function(){
    var time= new Date();
    var Y=time.getFullYear();
    var M=time.getMonth();
    m++;
    var D=time.getDate();
    var H=time.getHours();
    var m=time.getMinutes();
    var S=time.getSeconds();

    document.getElementById("time").innerHTML= Y + "-" + M + "-" + D + "--" + H + " : " + m + " : " + S;
  }

, 500);

// home page image slider timer
var counter = 1;
setInterval(
    function()
    {
      document.getElementById('radio' + counter).checked = true;
      counter++;
      if(counter > 4){
          counter = 1;
        }
    }, 10000);

//register page enable submit button function
 function enbsub(){
  if(document.getElementById("chkbox").checked){
         document.getElementById("sub").disabled=false;
     }
  else{
         document.getElementById("sub").disabled=true;
     }
 }

// register page extend date cannot be a date before the start date this function test it an alerts if false 
function dval(){
    var sdate=document.getElementById("sdate").value;
    var edate=document.getElementById("edate").value;

    if(edate<sdate){
         alert("Please Select a Valid Extend Date");
         document.getElementById("edate").value="";
     }
}

//The function checks the retype password mismatch errors if there are mismatches and alert them in sign up page
function chkpass(){
  var pass = document.getElementById("pass").value;
  var rpass = document.getElementById("rpass").value;
  if(pass!=rpass){
    alert("Passwords Mismatch Please try again");
    document.getElementById("pass").value="";
    document.getElementById("rpass").value="";
  }
}

//
document.getElementsByName("gender").value="Male"

function swap(){
  document.getElementById("timg").src="./images/bike2.jpg";
}

// this function loads the different data on listed policies on a buttom click
function loadpolicy(pid){
  if(pid=="P001") {
    document.getElementById("timg").src="./images/bike2.jpg";
    document.getElementById("po").innerHTML="Motorbikes & Three Wheelers";
    document.getElementById("pi").innerHTML="Insurance for Motorcycles and Three Wheelers is a type of insurance policy which covers your vehicles from potential risks financially. Policyholder's Motorcycle or Three Wheeler is provided financial security against damages arising out of accidents and other threats. A Motorcycles and Three Wheelers insurance is bought by personal owners using thier vehicle for personal use. There are different types of policies which a vehicle owner can choose.";

    document.getElementById("p0").innerHTML="Damages/Loses caused by Accident, External Explotion, Fire, Theft of vehicle parts and 3rd party damages.";

    document.getElementById("p1").innerHTML="You will be given a free accidental hospitalization cover worth Rs.5000 per day.";
    document.getElementById("p2").innerHTML="For an added premium you can obtain personal accident benefits.";
    document.getElementById("p3").innerHTML="Due to misrepresentation and non-payment of premium, insurer cancelation will be take place.";
    document.getElementById("p4").hidden=true;
    document.getElementById("p5").hidden=true;
    document.getElementById("p6").hidden=true;

  }

  else if(pid=="P002"){
    document.getElementById("timg").src="./images/car2.jpg";
    document.getElementById("po").innerHTML="Cars & Mini Vans";
    document.getElementById("pi").innerHTML="Insurance for Cars and Mini Vans is a type of insurance policy which covers your vehicles from potential risks financially. Policyholder's car or mini van is provided financial security against damages arising out of accidents and other threats. A private cars and mini vans insurance is bought by personal owners using thier vehicle for personal use. There are different types of policies which a car owner or a mini van owner can choose.";

    document.getElementById("p0").innerHTML="Damages/Loses caused by Accident, External Explotion, Fire, Theft of vehicle parts and 3rd party damages.";

    document.getElementById("p1").innerHTML="A free towing cover upto Rs.10000.00";
    document.getElementById("p2").innerHTML="Free acidental hospitalization cover including ambulance service upto Rs.50000.00 maximum.";
    document.getElementById("p3").innerHTML="Due to misrepresentation and non-payment of premium, insurer cancelation will be take place.";
    document.getElementById("p4").hidden=true;
    document.getElementById("p5").hidden=true;
    document.getElementById("p6").hidden=true;
  }

  else if(pid=="P003"){
    document.getElementById("timg").src="./images/suv2.jpg";
    document.getElementById("po").innerHTML="Vans & SUVs";
    document.getElementById("pi").innerHTML="Insurance for Vans and SUVs is a type of insurance policy which covers your vehicles from potential risks financially. Policyholder's van or SUV is provided financial security against damages arising out of accidents and other threats. A private Vans and SUVs insurance is bought by personal owners using thier vehicle for personal use. There are different types of policies which a owner can choose.";

    document.getElementById("p0").innerHTML="Our vans and SUVs insurance offers two levels of cover, comprehensive and third-party fire and theft. A broad commercial van insurance policy that covers you for a range of eventualities.";

    document.getElementById("p1").innerHTML="If your van is met for an accident, fire or flood you will be given the following beefits";
    document.getElementById("p2").innerHTML="Receiving the payment to the value of replacing the van";
    document.getElementById("p3").innerHTML="You can pay the balance and go for an update";
    document.getElementById("p4").hidden=false;
    document.getElementById("p4").innerHTML="Due to misrepresentation and non-payment of premium, insurer cancelation will be take place";
    document.getElementById("p5").hidden=true;
    document.getElementById("p6").hidden=true;
  }

  else if(pid=="P004"){
    document.getElementById("timg").src="./images/truck.jpg";
    document.getElementById("po").innerHTML="Heavy Vehicles";
    document.getElementById("pi").innerHTML="A heavy vehicle insurance is a type of a commercial vehicle insurance policy specifically for the purpose of covering for heavy duty vehicles such as bulldozers, cranes, lorries, trailers, etc. A basic, third-party heavy vehicle insurance covers for any damages and losses caused to a third-party due to the vehicle, whereas a comprehensive heavy vehicle insurance would also help cover for own damages along with additional covers for maximum protection.";

    document.getElementById("p0").innerHTML="Damages/Loses caused by Accident, External Explotion, Fire, Self-ignition, Theft, Malicious acts, Natural disasters and 3rd party damages. You can also obtain the additional covers like Legal liability cover and Terrorism cover.";

    document.getElementById("p1").innerHTML="First and third party plans are available";
    document.getElementById("p2").innerHTML="Instant renewal for expired policies";
    document.getElementById("p3").innerHTML="Available covers for driver, helper, etc";
    document.getElementById("p4").hidden=false;
    document.getElementById("p4").innerHTML="Due to misrepresentation and non-payment of premium, insurer cancelation will be take place";
    document.getElementById("p5").hidden=true;
    document.getElementById("p6").hidden=true;
  }

  else if(pid=="P005"){
    document.getElementById("timg").src="./images/rent.jpg";
    document.getElementById("po").innerHTML="Vehicles on Rent";
    document.getElementById("pi").innerHTML="Buying rental car insurance could save you thousands in repair costs. We provide complete protection at it's best as a leading insurance company.";

    document.getElementById("p0").innerHTML="Damages/Loses caused by Accident, External Explotion, Fire, Theft of vehicle parts and 3rd party damages. You can also obtain the additional covers like Legal liability cover and Terrorism cover.";

    document.getElementById("p1").innerHTML="Flat tires, cracked windshields, damaged headlights, lost keys, and towing";
    document.getElementById("p2").innerHTML="Charges added to your repair bill, including fees for loss of use, processing, relocation and towing";
    document.getElementById("p3").innerHTML="Complete coverage for all authorized drivers";
    document.getElementById("p4").hidden=false;
    document.getElementById("p4").innerHTML="Rentals for maximum 30 days";
    document.getElementById("p5").hidden=false;
    document.getElementById("p5").innerHTML="Due to misrepresentation and non-payment of premium, insurer cancelation will be take place";
    document.getElementById("p6").hidden=true;
  }
}


// this function enables the police report upload input in claim request form
function enbup(){
  if(document.getElementById("pr1").checked){
    document.getElementById("file").disabled=false;
  }
  else if(document.getElementById("pr2").checked){
    document.getElementById("file").disabled=true;
  }
}


// this function automatically calculate the payment amount for selected policy type and payment type 
// r1, r2... a1, a2... variables are declared in the php section of the payment portal

function calamt(){
  
  var ptype = document.getElementById("type").value;
  var pid = document.getElementById("pid").value;
  if(ptype=="Renewal"){
    if(pid=="P001"){
      document.getElementById("amt").value=r1;
    }
    else if (pid=="P002") {
      document.getElementById("amt").value=r2;
    }
    else if (pid=="P003") {
      document.getElementById("amt").value=r3;
    }
    else if (pid=="P004") {
      document.getElementById("amt").value=r4;
    }
    else if (pid=="P005") {
      document.getElementById("amt").value=r5;
    }
  }
  else if (ptype=="Annual") {
    if(pid=="P001"){
      document.getElementById("amt").value=a1;
    }
    else if (pid=="P002") {
      document.getElementById("amt").value=a2;
    }
    else if (pid=="P003") {
      document.getElementById("amt").value=a3;
    }
    else if (pid=="P004") {
      document.getElementById("amt").value=a4;
    }
    else if (pid=="P005") {
      document.getElementById("amt").value=a5;
    }
  }
}


// enables and disables detail management and policy management sections on button click
function swap(){
  if(document.getElementById("mudata").hidden==true){
    document.getElementById("mudata").hidden=false;
  }
  else if(document.getElementById("mudata").hidden==false){
    document.getElementById("mudata").hidden=true; 
  }
} 

function swap2(){
  if(document.getElementById("Mpolicy").hidden==true){
    document.getElementById("Mpolicy").hidden=false;
  }
  else if(document.getElementById("Mpolicy").hidden==false){
    document.getElementById("Mpolicy").hidden=true; 
  }
}


