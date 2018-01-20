<?php
include 'functions.php';
require_once 'functions.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Account Information</title>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>

    <body class="w3-light-grey">
        <h2>Your order</h2>
        <ul>
            <?php
            if (isset($_SESSION["cart"]) && (isset($_GET["submit"]))) {
                //process the order using the data in the session variable
                $link = createConnection();
                $totalPrice = 0.0;
                // We get the price from the database info and not the form, for security
                foreach ($_SESSION["cart"] as $index => $article) {
                    // Step 1: Calculate price
                    $custom_product_id = mysqli_insert_id($link);
                    foreach ($article as $id => $component) {
                        // We get the price from the database info and not the form, for security
                        $sql = "SELECT * FROM products WHERE product_id='" . $id . "'";
                        $query = mysqli_query($link, $sql);
                        if (!$query) {
                            mysqli_close($link);
                            die("ERROR IN SELECT PRODUCTS QUERY: PLEASE CONTACT SITE ADMIN");
                        } else {
                            $item = mysqli_fetch_array($query);
                            $totalPrice += $item["price"];
                        }
                    }
                }

                //Step 3: Add the prebuilt article to the database
                $sql = "INSERT INTO orders (total, assembly_time, delivery_date, user_id) VALUES ('" . $totalPrice . "', '1', '1', '1')";
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    mysqli_close($link);
                    die("ERROR IN INSERT ORDERS QUERY: PLEASE CONTACT SITE ADMIN");
                } else {
                    $order_id = mysqli_insert_id($link);
                    foreach ($_SESSION["cart"] as $index => $article) {                        
                        $sql = "INSERT INTO custom_products (quantity) VALUES ('" . $order_id . "')";
                        $result = mysqli_query($link, $sql);
                        if (!$result) {
                            mysqli_close($link);
                            die("ERROR IN INSERT CUSTOM PRODUCT: PLEASE CONTACT SITE ADMIN");
                        } else {
                            $custom_product_id = mysqli_insert_id($link);
                            foreach ($article as $id => $component) {                                
                                $safeid = mysqli_real_escape_string($link, $id);
                                $sql = "INSERT INTO custom_products_components (custom_product_id, component_id) VALUES ('" . $custom_product_id . "', '" . $safeid . "')";
                                $result = mysqli_query($link, $sql);
                                if (!$result) {
                                    mysqli_close($link);
                                    die("INSERT CUSTOM PRODUCT COMPONENT QUERY FAILED. PLEASE CONTACT SITE ADMIN");
                                }
                            }
                        }
                    }
                }
                header ("Location: index.php");
            } else if (isset($_SESSION["cart"])) {
                // Print the form to confirm order
                $form = "<form method='get' action='order.php' id='confirm'>";
                $form .= "</form>";
                var_dump($_SESSION["cart"]);
                $result = "";
                // For each article in the cart
                foreach ($_SESSION["cart"] as $index => $article) {
                    $result .= "<li><table>";
                    foreach ($article as $id => $component) {
                        foreach ($component as $name => $price) {
                            $result .= "<tr><td>" . $name . "</td><td>" . $price . "</td></tr>";
                        }
                    }
                    $result .= "</table></li>";
                }
                // Print the cart content
                echo $result;

                $form .= "<input type='submit' name='submit' value='Confirm Order' form='confirm' />";
                echo $form;
            }
            ?>
        </ul>
    </body>
</html>
