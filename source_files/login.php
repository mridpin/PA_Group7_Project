<!DOCTYPE html>

<?php
include 'functions.php';
require_once 'functions.php';
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8"></meta>
        <title>Users Login</title>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>
    <body class="w3-light-grey">
        <?php include("header.php"); ?>
        <?php

        function loginForm() {
            ?>

            <article class="w3-container w3-mobile" style="width:35%;margin:auto;">
                <section class="w3-card">
                    <div class="w3-teal w3-text-white w3-container w3-center">
                        <h2>Welcome to PC GalaxyNova</h2>
                    </div>
                    <div class="w3-container w3-padding-16 w3-white">
                        <form action="login.php" method="post">
                            <label>Email: </label><input class="w3-input w3-hover-grey" name="username" type="text" />
                            <br/>
                            <br/>
                            <label>Password: </label><input class="w3-input w3-hover-grey" name="password" type="password" />
                            <br/>
                            <br/>
                            <input class="w3-block w3-button w3-teal" name="login" type="submit" value="Submit" />
                        </form>
                        <form action="register.php" method="get">
                            <br/>
                            <input class="w3-block w3-button w3-teal" name="submit" type="submit" value="Register" />
                        </form>
                    </div>
                </section>
            </article>


            <?php
        }

        function checkLogin() {
            $error = [];
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
                    $_SESSION["user_id"] = $aux["user_id"];
                    $_SESSION["type"] = $aux["type"];
                    header("Location: " . $_SESSION["origin"]);
                } else {
                    mysqli_free_result($query);
                    mysqli_close($con);
                    $error[] = "User and password do not match";
                }
            } else {
                mysqli_free_result($query);
                mysqli_close($con);
                $error[] = "User and password do not match";
            }
            return $error;
        }

        $error = [];
        if (isset($_POST['login'])) {
            $error = checkLogin();
            echo printErrorMessage($error);
        }
        loginForm();
        ?>

        <br />
    </body>
</html>
