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
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>
    <body class="w3-light-grey">


        <header class="w3-teal w3-text-white w3-container w3-center">

            <a href="index.php"><p>Insert Logo Here</p></a>

        </header>

        <?php

        function loginForm() {
            ?>


            <article class="w3-container w3-margin w3-display-middle">
                <section class="w3-card">
                    <div class="w3-teal w3-text-white w3-container w3-center">
                        <h2>Welcome to PC GalaxyNova</h2>
                    </div>
                    <div class="w3-container w3-padding-16 w3-white">
                        <form action="login.php" method="POST">
                            Email: <input class="w3-input w3-hover-grey" name="username" type="text"/>
                            <br/>
                            <br/>
                            Password: <input class="w3-input w3-hover-grey" name="password" type="password"/>
                            <br/>
                            <br/>
                            <input class="w3-block w3-button w3-teal" name="login" type="submit" value="Submit"/>
                        </form>
                        <form action="register.php" method="GET">
                            <br/>
                            <input class="w3-block w3-button w3-teal" name="submit" type="submit" value="Register"/>
                        </form>
                    </div>
                </section>
            </article>


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

        <footer class="w3-container w3-bottom w3-teal">Legal stuff goes here</footer>
 
    </body>
</html>
