<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include 'functions.php';
require_once 'functions.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
    
    	<div>
            
            <a href="index.php"><p>Insert Logo Here</p></a>
            
        </div>
    
    
        <?php
        
        function registrationForm()
        {
        
        ?>
        
         <div>
            
            <h2>Enter the information below to create a new account</h2>
            
        </div>
        
         <form action="register.php" method="POST">
                
                Username: <input name="username" type="text"/>
                Password: <input name="password" type="password"/>
                <br/>
                <br/>
                Last Name: <input name="lastName" type="text"/>
                Email: <input name="email" type="email"/>
                <br/>
                <br/>
                <br/>
                ZIP Code: <input name="zipCode" type="number"/>
                <!-- Instead select field with countries from a DB table?-->
                Country: <input name="country" type="text"/>
                <br/>
                <br/>
                Street: <input name="street" type="text"/>
                Number: <input name="number" type="number"/>
                <br/>
                <br/>
                <input name="register" type="submit" value="Register"/>
                
            </form>

        
        <?php
        
        //This function is Copy-Paste, TODO: There is several inserts necessary, one for the table users, address and user_address (After the insert of the two first tables, we need to extract the ids to insert them into user_adress)
        
         function addUser()
        {
            
            $con = createConnection();
            
            $name = mysqli_real_escape_string($con,$_POST['nombre']);
            $user = mysqli_real_escape_string($con,$_POST['usuario']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
            
            $sentencia = "INSERT INTO users (nombre,usuario,password,last_access) VALUES('".$name."','".$user."','".password_hash($password,PASSWORD_DEFAULT)."','".date("Y-m-d H:i:s")."');";
            
            $result = mysqli_query($con, $sentencia);
            
            if(!$result)
            {
                mysqli_close($con);
                die("ERROR: Se ha producido un error al ejecutar la sentencia");
            }
            else
            {
                $_SESSION["user"] = $user;
                mysqli_free_result($result);
                mysqli_close($con);
                header("Location: ".$_SESSION["origin"]);
            }
            
            
        }
        
        
        }
        
        //If we have pressed the register button
        if(isset($_POST['register']))
        {
            addUser();
        }
        else
        {
            registrationForm();
        }  
        
        ?>
        
        <br>
        
        <footer>Legal stuff goes here</footer>
    </body>
</html>
