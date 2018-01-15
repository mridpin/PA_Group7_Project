<!DOCTYPE html>
<!--
This structure is a WIP, so you can edit it as much as your want.
TODO: If incorrect credentials, still show login form
-->

<?php
include 'functions.php';
require_once 'functions.php';
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Users Login</title>
    </head>
    <body>


        <div>

            <a href="index.php"><p>Insert Logo Here</p></a>

        </div>

        <?php

        function loginForm() {
            ?>


            <div>

                <h2>Please enter your login credentials</h2>

            </div>

            <div>

                <form action="login.php" method="POST">

                    Email: <input name="username" type="text"/>
                    <br/>
                    <br/>
                    Password: <input name="password" type="password"/>
                    <br/>
                    <br/>
                    <input name="login" type="submit" value="Submit"/>

                </form>

                <form action="register.php" method="GET">

                    <br/>
                    <input name="submit" type="submit" value="Register"/>

                </form>


            </div>


            <?php
        }

        function checkLogin() {
            $con = createConnection();
            $user = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['password']);

            $sentencia = "SELECT * FROM users WHERE email='" . $user . "';";
            $query = mysqli_query($con, $sentencia);

            if (!$query) {
                mysqli_close($con);
                die("ERROR: There is an error in the LOGIN SQL query");
            }
            //We found a user
            else if (mysqli_num_rows($query) == 1) {

                $aux = mysqli_fetch_array($query);

                if (password_verify($password, $aux["password"])) {
                    mysqli_free_result($query);
                    mysqli_close($con);
                    $_SESSION["user"] = $user;
                    $_SESSION["type"] = $aux["type"];
                    header("Location: " . $_SESSION["origin"]);
                } else {
                    mysqli_free_result($query);
                    mysqli_close($con);
                    die("ERROR: Incorrect login information: password");
                }
            } else {
                mysqli_free_result($query);
                mysqli_close($con);
                var_dump($user);
                die("ERROR: Incorrect login information: user");
            }
        }

        if (isset($_POST['login'])) {
            checkLogin();
        }

        loginForm();
        ?>

        <br />

        <footer>Legal stuff goes here</footer>

    </body>
</html>
