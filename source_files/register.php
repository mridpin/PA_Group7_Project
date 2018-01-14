<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include 'functions.php';
require_once 'functions.php';
/* Las funciones se ponen siempre al principio del fichero: */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <header>
            <div>

                <a href="index.php"><p>Insert Logo Here</p></a>

            </div>
        </header>

        <div>
            <h2>Enter the information below to create a new account</h2>
        </div>
        <?php
        if (isset($_POST['submit'])) {

            $error = [];
            // Check fields for errors:
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Email not valid";
            }
            if (strlen($_POST["password"]) < 8) {
                $error[] = "Password must contain at least 8 characters";
            }

            if (empty($error)) {
                $link = createConnection();

                $name = mysqli_real_escape_string($link, $_POST['username']);
                $lastName = mysqli_real_escape_string($link, $_POST['lastName']);
                $pwd = mysqli_real_escape_string($link, $_POST['password']);
                $email = mysqli_real_escape_string($link, $_POST['email']);
                $hash = password_hash($pwd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (type, name, password, last_name, email) VALUES ('user', '" . $name . "', '" . $hash . "', '" . $lastName . "', '" . $email . "')";
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    var_dump($result);
                    mysqli_close($link);
                    die("CREATE USER QUERY ERROR");
                } else {
                    // If register successful
                    //$_SESSION["user"] = $user;
                    mysqli_free_result($result);
                    mysqli_close($link);
                    //header("Location: " . $_SESSION["origin"]);
                    //header("Location: index.php");
                }
            }
        }
        if (!isset($_POST['submit']) || !empty($error)) {
            echo printErrorMessage($error);
            ?>
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
                <input name="submit" type="submit" value="Register"/>

            </form>
            <?php
        }
        ?>
        <br>

        <footer>Legal stuff goes here</footer>
    </body>
</html>
