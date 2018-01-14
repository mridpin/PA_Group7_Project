<?php

function printErrorMessage($errors) {
    $res = "<p style='color:red'>";
    if (isset($errors) && !empty($errors)) {
        foreach ($errors as $error) {
            $res = $res . $error . "<br />";
        }
    }
    $res = $res . "</p>";
    return $res;
}

function createConnection() {
    $con = mysqli_connect("localhost", "root", "");
    //Lo que yo quiero hacer:
    //$con = mysqli_connect("198.91.81.7", "grupoa0_admin", "admin");
    if (!$con) {
        die("ERROR: Can't connect to host");
    }
    $db = mysqli_select_db($con, "grupopa0_db");

    if (!$db) {
        die("ERROR: Can't connect to DB ");
    }
    return $con;
}

// Check if session is up. If not, send user to login or to speciefied site
function checkSession($location = "login") {
    if (!isset($_SESSION["user"])) {
        header("Location: $location.php");
    }
}

// Print a welcome message and account options
function printWelcome() {
    if (isset($_SESSION["user"])) {
        echo "Welcome back, " . $_SESSION["user"] . "!";
        echo "<div class='linkToAccount'><a href='account.php'>My Account</a></div>";
    } else {
        echo "<a href='login.php'><p>Login/Register</p></a>";
    }
}


?>