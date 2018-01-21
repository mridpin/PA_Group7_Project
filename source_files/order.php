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
        <?php include("header.php"); ?>
        <article class="w3-card w3-mobile w3-margin-bottom" style="width:50%;margin:auto;">
            <section>
                <?php
                
                //For some reason, if there are two types of products in the cart the second quantity is not right
                $total = 0.0;
                $auxTotal=0.0;
                $i=0;
                foreach ($_SESSION["cart"] as $index => $article) {
                    // Calculate price                    
                    foreach ($article as $id => $component) {
                        foreach ($component as $name => $price) {
                            $auxTotal += $price;                        }
                    }
                    //After calculating the product cost, then we multiply it by the quantity
                    $auxTotal*=$_SESSION["quantity"][$i];
                    $total+=$auxTotal;
                    $i++;
                    $auxTotal=0.0;
                }
                
                ?>
                <div class="w3-teal w3-text-white w3-container">
                    <h2>Your order: $<?php echo $total?></h2>
                </div>
                <ul class="w3-ul">
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
                        $sql = "INSERT INTO orders (total, assembly_time, delivery_date, user_id) VALUES ('" . $totalPrice . "', '1', '" . $date . "', '" . $_SESSION["user_id"] . "')";
                        $result = mysqli_query($link, $sql);
                        if (!$result) {
                            mysqli_close($link);
                            die("ERROR IN INSERT ORDERS QUERY: PLEASE CONTACT SITE ADMIN");
                        } else {
                            // Step2: Insert the new custom product
                            $order_id = mysqli_insert_id($link);
                            foreach ($_SESSION["cart"] as $index => $article) {
                                // "quantity" is being used as "order id" for this component
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
                        // For each article in the cart
                        
                        $i=0;
                        
                        foreach ($_SESSION["cart"] as $index => $article) {
                            $result .= "<li><table class='w3-table-all'>";
                            $result .= "<tr><th>Product name</th><th>Price ($)</th>";
                            foreach ($article as $id => $component) {
                                foreach ($component as $name => $price) {
                                    $result .= "<tr><td>" . $name . "</td><td>" . $price . "</td>";
                                }
                            }
                            
                            echo "i: ".$i;
                            
                            print_r($_SESSION["quantity"][$i]);
                            
                            $result.="<tr><td>QUANTITY</td><td>" .$_SESSION["quantity"][$i] . "</td>";
                            $i++;
                            $result .= "</table>";
                            $result .= "<input class='w3-hover-red w3-hover-text-white w3-button w3-block w3-white w3-border-red w3-text-red w3-bottombar' type='submit' name='delete_submit' value='Delete Item' form='confirm' />";
                            $result .= "<input type='hidden' name='delete_item' value='" . $index . "' form='confirm' /></li>";
                        }
                        $result .= "<p class='w3-panel' >Total price: <strong>$" . $total . "</strong></p>";
                        
                        //Cant continue with order if there isnt a payment method or a address
                        if(empty(paymentMethodDetails()) || empty(addressDetails()))
                        {
                            $result.="<div class='w3-hover-teal w3-hover-text-white w3-button w3-block w3-white w3-border-teal w3-bottombar w3-text-teal w3-cell' style='width:50%'>Please go to your account information and provide a valid adress and payment Method before confirming the order</div>";
                        }
                        else{
                        $result .= "<input class='w3-hover-teal w3-hover-text-white w3-button w3-block w3-white w3-border-teal w3-bottombar w3-text-teal w3-cell' style='width:50%' type='submit' name='submit' value='Confirm Order' form='confirm' />";
                        }
                        $result .= "<input class='w3-hover-red w3-hover-text-white w3-button w3-block w3-white w3-border-red w3-bottombar w3-text-red w3-cell' style='width:50%' type='submit' name='submit_cancel' value='Cancel Order' form='confirm' />";
                        echo $result;
                    }
                    ?>
                </ul>
            </section>
        </article>
        <?php include("footer.php") ?>
    </body>
</html>
