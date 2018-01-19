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
            <?php include("header.php"); ?>
        </div>

        <!--
        This div is for the product boxes (see document Vision de la apliacion)
        for reference. TODO: Probably all the links can take to the same place but 
        depending on what we click the page newProduct.php can change what it shows
        -->
        <div>

            <h2>Choose a product</h2>

            <form action="newProduct.php" method="POST">
                <input type="submit" name="computer" value="Build a new computer"/>
            </form>
            
            <form action="newProduct.php" method="POST">
                <input type="submit" name="phone" value="Build a new phone"/>
            </form>
            
            <form action="newProduct.php" method="POST">
                <input type="submit" name="product" value="Buy a product"/>
            </form>


        </div>

        <?php include("footer.php"); ?>

    </body>
</html>
