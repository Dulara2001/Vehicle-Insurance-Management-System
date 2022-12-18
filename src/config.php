<?php 
    $con = new mysqli("localhost", "root", "", "vims");

    if ($con->connect_error){
        die("Connection Failed : ".$con->connect_error);   
    }
?>