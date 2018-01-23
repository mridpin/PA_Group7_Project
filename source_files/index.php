<!DOCTYPE html>
<?php
session_start();
$_SESSION["origin"] = $_SERVER['PHP_SELF'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>
    <body class="w3-light-grey">
        <div>
            <?php include("header.php"); ?>
        </div>

        <!--
        This div is for the product boxes (see document Vision de la apliacion)
        for reference. TODO: Probably all the links can take to the same place but 
        depending on what we click the page newProduct.php can change what it shows
        -->
        <article class="w3-container w3-mobile" style="width:60%;margin:auto;">
            <section class="w3-section w3-card">

                <div class="w3-container w3-teal w3-text-white" >
                    <h2>Choose a product</h2>
                </div>

                <div class="w3-container w3-padding-16 w3-bar">
                    <form action="newProduct.php" method="POST">
                        <input class="w3-button w3-xxlarge w3-bar-item w3-ripple" style="width:50%;" type="image" src="img/pc.jpg"  name="computer" alt="Build a computer" /> 
                        <input type="hidden" name="computer" value="computer"/> 
                    </form>

                    <form action="newProduct.php" method="POST">
                        <input class="w3-button w3-xxlarge w3-bar-item w3-ripple" style="width:50%;" type="image" src="img/phone.jpg" name="phone" alt="phone" />
                        <input type="hidden" name="phone" value="phone"/> 
                    </form>
                </div>
            </section>

        </article>

        <?php include("footer.php"); ?>

    </body>
</html>
