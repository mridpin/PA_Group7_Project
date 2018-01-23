<!DOCTYPE html>

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
               $('#confirm').submit(function{
                    var c = confirm("Please confirm Order:");
                    return c; 
               });
            });
        </script>
    </head>

    <body class="w3-light-grey">
        <?php include("header.php"); ?>
        <article class="w3-card w3-mobile w3-margin-bottom" style="width:50%;margin:auto;">
            <section>
                <?php
                $total = 0.0;
                $auxTotal = 0.0;
                $i = 0;

                //print_r($_SESSION["quantity"]);

                foreach ($_SESSION["cart"] as $index => $article) {
                    // Calculate price                    
                    foreach ($article as $id => $component) {
                        foreach ($component as $name => $price) {
                            $auxTotal += $price;
                        }
                    }
                    //After calculating the product cost, then we multiply it by the quantity
                    $auxTotal *= $_SESSION["quantity"][$i];
                    $total += $auxTotal;
                    $i++;
                    $auxTotal = 0.0;
                }
                ?>
                <div class="w3-teal w3-text-white w3-container">
                    <h2>Your order: $<?php echo $total ?></h2>
                </div>
                <form method='get' action='order.php' id='confirm'>
                </form>
                <ul class="w3-ul">
                    <?php
                    if (isset($_GET["submit_cancel"])) {
                        unset($_SESSION["cart"]);
                        unset($_SESSION["quantity"]);
                        header("Location: index.php");
                    } else if (isset($_GET["delete_submit"])) {
                        
                        if(count($_SESSION["cart"])!=1)
                        {
                            $index = $_GET["delete_item"];
                            unset($_SESSION["cart"][$index]);
                            unset($_SESSION["quantity"][$index]);
                            header("Location: order.php");
                        }
                        else
                        {
                            unset($_SESSION["cart"]);
                            unset($_SESSION["quantity"]);
                            header("Location: index.php");
                        }
                    } else if (isset($_SESSION["cart"]) && (isset($_GET["submit"]))) {
                        //process the order using the data in the session variable
                        $link = createConnection();
                        $totalPrice = 0.0;

                        $total = 0.0;
                        $auxTotal = 0.0;
                        $i = 0;

                        $componentsStocks = [];


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
                                    $auxTotal += $item["price"];
                                    $componentsStocks[] = $item["stock"] - (1 * $_SESSION["quantity"][$i]);
                                }
                            }

                            $auxTotal *= $_SESSION["quantity"][$i];
                            $total += $auxTotal;
                            $i++;
                            $auxTotal = 0.0;
                        }


                        //Step 1: Add the order to the database
                        $date = date("Y-m-d");
                        $deliveryDate = date("Y-m-d", strtotime("+7 day"));
                        $sql = "INSERT INTO orders (total,date, delivery_date, user_id,payment_method_id,address_id) VALUES ('" . $total . "','" . $date . "','" . $deliveryDate . "','" . $_SESSION["user_id"] . "','" . $_GET["paymentMethod"] . "','" . $_GET["address"] . "')";
                        $result = mysqli_query($link, $sql);
                        if (!$result) {
                            mysqli_close($link);
                            die("ERROR IN INSERT ORDERS QUERY: PLEASE CONTACT SITE ADMIN");
                        } else {
                            // Step2: Insert the new custom product
                            $order_id = mysqli_insert_id($link);
                            //Used for quantity
                            $i = 0;

                            foreach ($_SESSION["cart"] as $index => $article) {

                                $sql = "INSERT INTO custom_products (quantity,order_id) VALUES ('" . $_SESSION["quantity"][$i] . "','" . $order_id . "')";
                                $result = mysqli_query($link, $sql);
                                if (!$result) {
                                    mysqli_close($link);
                                    die("ERROR IN INSERT CUSTOM PRODUCT: PLEASE CONTACT SITE ADMIN");
                                } else {
                                    // Step 3: insert the relation between custom product and component
                                    $custom_product_id = mysqli_insert_id($link);

                                    $j = 0;
                                    foreach ($article as $id => $component) {
                                        $safeid = mysqli_real_escape_string($link, $id);
                                        $sql = "INSERT INTO custom_products_components (custom_product_id, component_id) VALUES ('" . $custom_product_id . "', '" . $safeid . "')";
                                        $result = mysqli_query($link, $sql);
                                        if (!$result) {
                                            mysqli_close($link);
                                            die("INSERT CUSTOM PRODUCT COMPONENT QUERY FAILED. PLEASE CONTACT SITE ADMIN");
                                        }

                                        //Step 4: Update the component stock
                                        $sql = "UPDATE products SET stock=" . $componentsStocks[$j] . " WHERE product_id=" . $safeid;
                                        $result = mysqli_query($link, $sql);
                                        if (!$result) {
                                            mysqli_close($link);
                                            die("UPDATE COMPONENT QUANTITY QUERY FAILED. PLEASE CONTACT SITE ADMIN");
                                        }

                                        $j++;
                                    }
                                }
                                $i++;
                            }
                        }
                        mysqli_close($link);
                        unset($_SESSION["cart"]);
                        header("Location: index.php");
                    } else if (isset($_SESSION["cart"])) {
                        $_SESSION["origin"] = $_SERVER['PHP_SELF'];
                        checkSession();
                        
                        // For each article in the cart
                        $i = 0;
                        $result = "";
                        foreach ($_SESSION["cart"] as $index => $article) {
                            $result .= "<li><table class='w3-table-all'>";
                            $result .= "<tr><th>Product name</th><th>Price ($)</th>";
                            foreach ($article as $id => $component) {
                                foreach ($component as $name => $price) {
                                    $result .= "<tr><td>" . $name . "</td><td>" . $price . "</td>";
                                }
                            }

                            $result .= "<tr><td>QUANTITY</td><td>" . $_SESSION["quantity"][$i] . "</td>";
                            $i++;
                            $result .= "</table>";
                            $result .= "<input class='w3-hover-red w3-hover-text-white w3-button w3-block w3-white w3-border-red w3-text-red w3-bottombar' type='submit' name='delete_submit' value='Delete Item' form='confirm' />";
                            $result .= "<input type='hidden' name='delete_item' value='" . $index . "' form='confirm' /></li>";
                        }
                        $result .= "<li><p class='w3-panel' >Total price: <strong>$" . $total . "</strong></p></li>";
                        $result .= "</ul>";
                        //Cant continue with order if there isnt a payment method or a address

                        $paymentMethods = paymentMethodDetails();
                        $addresses = addressDetails();

                        $notEnough = FALSE;

                        //We have to check if we have enough stock to complete the order

                        $i = 0;

                        $link = createConnection();
                        foreach ($_SESSION["cart"] as $index => $article) {
                            foreach ($article as $id => $component) {
                                // We get the stocl from the database info and not the form, for security
                                $sql = "SELECT * FROM products WHERE product_id='" . $id . "'";
                                $query = mysqli_query($link, $sql);
                                if (!$query) {
                                    mysqli_close($link);
                                    die("ERROR IN SELECT PRODUCTS QUERY: PLEASE CONTACT SITE ADMIN");
                                } else {
                                    $item = mysqli_fetch_array($query);
                                    if (($item["stock"] - (1 * $_SESSION["quantity"][$i])) < 0) {
                                        $notEnough = TRUE;
                                    }
                                }
                            }
                            $i++;
                        }
                        mysqli_close($link);

                        if ($notEnough == TRUE) {
                            $result .= "<div class='w3-padding-16 w3-panel w3-red w3-text-white'>Sorry, there isn't enough component stock to complete the order, please change the components of your order</div>";
                        } else if (empty($addresses) || empty($paymentMethods) || empty(validPaymentMethods($paymentMethods))) {
                            //We don't have a valid payment method or an address
                            $result .= "<div class='w3-padding-16 w3-panel w3-red w3-text-white'>Please go to your account information and provide a valid adress and payment Method before confirming the order</div>";
                        } else {
                            //Show all the available Payment Methods
                            $result .= "Payment Method: <select class='w3-select' name='paymentMethod' form='confirm'>";

                            for ($i = 0; $i < sizeof($paymentMethods); $i++) {
                                $result .= "<option value='" . $paymentMethods[$i]["number"] . "'>" . $paymentMethods[$i]["number"] . " - " . $paymentMethods[$i]["type"] . "</option>";
                            }

                            //Show all the available addresses
                            $result .= "</select>"
                                    . "Address: <select class='w3-select' name='address' form='confirm'>";

                            for ($i = 0; $i < sizeof($paymentMethods); $i++) {
                                $result .= "<option value='" . $addresses[$i]["address_id"] . "'>" . $addresses[$i]["street"] . "</option>";
                            }

                            $result .= "</select>"
                                    . "<input class='w3-hover-teal w3-hover-text-white w3-button w3-block w3-white w3-border-teal w3-bottombar w3-text-teal w3-cell' style='width:50%' type='submit' name='submit' value='Confirm Order' form='confirm' />";
                        }
                        $result .= "<input class='w3-hover-red w3-hover-text-white w3-button w3-block w3-white w3-border-red w3-bottombar w3-text-red w3-cell' style='width:50%' type='submit' name='submit_cancel' value='Cancel Order' form='confirm' />";
                        echo $result;
                    }
                    ?>
            </section>
        </article>
<?php include("footer.php") ?>
    </body>
</html>