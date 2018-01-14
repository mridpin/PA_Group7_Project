<!DOCTYPE html>
<!--
This structure is a WIP, so you can edit it as much as your want.
-->
<?php
session_start();
include 'functions.php';
require_once 'functions.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Account Information</title>
    </head>
    <body>

        <div>

            <a href="index.php"><p>Insert Logo Here</p></a>


        </div>

        <?php
        if (isset($_SESSION["user"])) {
            echo "Welcome back, " . $_SESSION["user"] . "!";
            echo "<div class='linkToAccount'><a href='account.php'>My Account</a></div>";
        } else {
            echo "<a href='login.php'><p>Login/Register</p></a>";
        }

        //Function that uses a SQL query to get the current account information
        function accountDetails() {
            $link = createConnection();
            $sql = "SELECT * FROM users WHERE email='". $_SESSION["user"] . "'";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                mysqli_close($link);
                die("ERROR: There is an error in SELECT ACCOUNT query");
            } else {
                $line = mysqli_fetch_array($result);
                return $line;
            }
        }

        //Function that shows the current account information using the function accountDetails
        function showAccountDetails() {
            $info = accountDetails();
            $result = "";
            $result .= "<li class='detailsLi' id='name'><div>Name: </div><div id='name'>".$info["name"]."</div></li>";
            $result .= "<li class='detailsLi' id='lastName'><div>Last name: </div><div id='name'>".$info["last_name"]."</div></li>";
            $result .= "<li class='detailsLi' id='email'><div>Email: </div><div id='name'>".$info["email"]."</div></li>";
            
            return $result;
        }
        ?>


        <article class="mainAricle" id="accountInfoArticle">
            <h2>Your Account Information</h2>

            <section class="informationSection" id="personalDetailsSection">
                <h3>Personal Information</h3>
                <ul class="personalInfoDetails">
                    <?php
                    echo showAccountDetails();
                    ?>
                </ul>

            </section>

            <section>
                <h3>Addresses</h3>
            </section>

            <section>
                <h3>Payment Methods</h3>
            </section>
        </article>

        <div>

            <a href="manageAccount.php"><p>Manage Account</p></a>

        </div>


        <footer>Legal stuff goes here</footer>

    </body>
</html>
