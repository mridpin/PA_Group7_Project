<!DOCTYPE html>
<?php
session_start();
$_SESSION["origin"] = $_SERVER['PHP_SELF'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
    </head>
    <body>
        <div>

            <a href="index.php"><p>Insert Logo Here</p></a>

        </div>

        <div>
            <?php
            if (isset($_SESSION["user"])) {
                echo "Welcome back, " . $_SESSION["user"] . "!";
            } else {
                echo "<a href='login.php'><p>Login/Register</p></a>";
            }
            ?>
        </div>
        <!--
        This div is for the product boxes (see document Vision de la apliacion)
        for reference.
        -->
        <div>

            <h2>Choose a product</h2>

            <a href="newProduct.php">Build a new Computer</a>


        </div>

        <footer>Legal stuff goes here</footer>

    </body>
</html>
