<!DOCTYPE html>
<!--
This structure is a WIP, so you can edit it as much as your want.
-->

<?php
include 'functions.php';
require_once 'functions.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Users Login</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        
        <div>
            
            <a href="index.php"><p>Insert Logo Here</p></a>
            
        </div>
        
        <div>
            
            <h2>Please enter your login credentials</h2>
            
        </div>

        <div>
            
            <form action="." method="POST">
                
                Username: <input name="username" type="text"/>
                <br/>
                <br/>
                Password: <input name="password" type="password"/>
                <br/>
                <br/>
                <input name="submit" type="submit" value="Submit"/>
                
            </form>
            
            <form action="register.php" method="POST">
                
		<br/>
                <input name="submit" type="submit" value="Register"/>
                
            </form>

            
        </div>
        
        <br>
        
        <footer>Legal stuff goes here</footer>
        
    </body>
</html>
