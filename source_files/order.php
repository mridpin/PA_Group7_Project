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
            if (isset($_GET["submit_cancel"])) {
                unset($_SESSION["cart"]);
                header("Location: index.php");
            } else if (isset($_GET["delete_submit"])) {
                $index = $_GET["delete_item"];
                unset($_SESSION["cart"][$index]);
                header("Location: order.php");
            } else if (isset($_SESSION["cart"]) && (isset($_GET["submit"]))) {
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

                //Step 1: Add the order to the database
                $date = date('jS \of F Y H:i:s');
                $sql = "INSERT INTO orders (total, assembly_time, delivery_date, user_id) VALUES ('" . $totalPrice . "', '1', '".$date."', '".$_SESSION["user_id"]."')";
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    mysqli_close($link);
                    die("ERROR IN INSERT ORDERS QUERY: PLEASE CONTACT SITE ADMIN");
                } else {
                    // Step2: Insert the new custom product
                    $order_id = mysqli_insert_id($link);
                    foreach ($_SESSION["cart"] as $index => $article) {
                        $sql = "INSERT INTO custom_products (quantity) VALUES ('" . $order_id . "')";
                        $result = mysqli_query($link, $sql);
                        if (!$result) {
                            mysqli_close($link);
                            die("ERROR IN INSERT CUSTOM PRODUCT: PLEASE CONTACT SITE ADMIN");
                        } else {
                            // Step 3: insert the relation between custom product and componen
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
                mysqli_close($link);
                unset($_SESSION["cart"]);
                header("Location: index.php");
            } else if (isset($_SESSION["cart"])) {
                $_SESSION["origin"] = $_SERVER['PHP_SELF'];
                checkSession();
                // Print the form to confirm order
                $result = "<form method='get' action='order.php' id='confirm'>";
                $result .= "</form>";
                var_dump($_SESSION["cart"]);
                // For each article in the cart
                foreach ($_SESSION["cart"] as $index => $article) {
                    $result .= "<li><table>";
                    foreach ($article as $id => $component) {
                        foreach ($component as $name => $price) {
                            $result .= "<tr><td>" . $name . "</td><td>" . $price . "</td>";
                        }
                    }                    
                    $result .= "</table>";
                    $result .= "<input type='submit' name='delete_submit' value='Delete' form='confirm' />";
                    $result .= "<input type='hidden' name='delete_item' value='" . $index . "' form='confirm' /></li>";
                }

                $result .= "<input type='submit' name='submit' value='Confirm Order' form='confirm' />";
                $result .= "<input type='submit' name='submit_cancel' value='Cancel Order' form='confirm' />";
                echo $result;
            }
            ?>
        </ul>
    </body>
</html>
