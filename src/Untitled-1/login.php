<!-- <?php
    require'config.php';
    $sql1 = "select * from account";
    if($con->query($sql1)){
        $result = $con->query($sql1);
    }
    else{
        $result = "Connection Failed";
    }

    function printqry(){
        global $result;
        while($row = $result->fetch_assoc()){
            echo $row["Username"]." - ".$row["Password"]." - ".$row["PL"]."<br>";
            
        }
    }

?>-->

<html>
    <head></head>
    <body>
        
        <form method="POST" action="test.php">
            <input type="text" name="uname" value="Username">
            <input type="text" name="nic" value="NIC">
            <input type="password" name="pass" value="Password">
            <input type="number" name="pl" value="PrivilegeLVL">
            <input type="submit" name="submit">
            <input type="reset">
        </form>
        <?php 
        
        printqry();
        ?>
    </body>
</html>