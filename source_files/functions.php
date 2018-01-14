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
    //$con = mysqli_connect("localhost", "grupoa0_admin", "admin");
    if (!$con) {
        die("ERROR: Can't connect to host");
    }
    $db = mysqli_select_db($con, "grupopa0_db");

    if (!$db) {
        die("ERROR: Can't connect to DB ");
    }
    return $con;
}

?>