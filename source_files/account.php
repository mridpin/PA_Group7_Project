<!DOCTYPE html>

<?php
session_start();
include 'functions.php';
require_once 'functions.php';

checkSession();

//Function that uses a SQL query to get the current account information
function accountDetails() {
    $link = createConnection();
    $sql = "SELECT * FROM users WHERE email='" . $_SESSION["user"] . "'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        mysqli_close($link);
        die("ERROR: There is an error in SELECT ACCOUNT query");
    } else {
        $line = mysqli_fetch_array($result);
        // Store the user_id in a session so as not to repeat the query
        $_SESSION["user_id"] = $line["user_id"];
        return $line;
    }
}

//Function that shows the current account information using the function accountDetails
function showAccountDetails() {
    $info = accountDetails();
    $result = "";
    $result .= "Name: <input class='w3-input w3-hover-grey' type='text' name='username' value='" . $info["name"] . "' required='required' /><br />";
    $result .= "Last Name: <input class='w3-input w3-hover-grey' type='text' name='last_name' value='" . $info["last_name"] . "' required='required' /><br />";
    $result .= "Email: <input class='w3-input w3-hover-grey' type='email' name='email' value='" . $info["email"] . "' required='required' /><br />";

    return $result;
}

//Function that uses a SQL query to get the current account addresses. Returns an array of associative arrays: one for each address
function addressDetails() {
    $addesses = [];
    $link = createConnection();
    $sql = "SELECT * FROM user_address WHERE user_id='" . $_SESSION["user_id"] . "'";
    $result1 = mysqli_query($link, $sql);
    if (!$result1) {
        mysqli_close($link);
        die("ERROR: There is an error in SELECT USER ADDRESS query");
    } else {
        while ($row = mysqli_fetch_array($result1)) {
            $sql = "SELECT * FROM address WHERE address_id='" . $row["address_id"] . "'";
            $result2 = mysqli_query($link, $sql);
            if (!$result2) {
                mysqli_close($link);
                die("ERROR: There is an error in SELECT ADDRESS query");
            } else {
                while ($row = mysqli_fetch_array($result2)) {
                    $addesses[] = $row;
                }
            }
        }
    }
    return $addesses;
}

//Function that uses a SQL query to get the current account payment methods. Returns an array of associative arrays: one for each payment method
function paymentMethodDetails() {
    $paymentMethod = [];
    $link = createConnection();
    $sql = "SELECT * FROM payment_method WHERE user_id='" . $_SESSION["user_id"] . "'";
    $result1 = mysqli_query($link, $sql);
    if (!$result1) {
        mysqli_close($link);
        die("ERROR: There is an error in SELECT USER PAYMENT METHOD query");
    } else {
        while ($row = mysqli_fetch_array($result1)) {

            $paymentMethod[] = $row;
        }
    }

    return $paymentMethod;
}

//Function that shows the current account information using the function accountDetails
function printAddressDetails() {
    $info = addressDetails();
    $result = "";
    $i = 0;
    foreach ($info as $address) {
        $result .= "<li><ul class='w3-ul'>";
        $result .= "<li class='details_li'>Zipcode: " . $address["zip_code"] . "</li>";
        $result .= "<li class='details_li'>Street: " . $address["street"] . "</li>";
        $result .= "<li class='details_li'>Number: " . $address["number"] . "</li>";
        $result .= "<li class='details_li'>Country: " . getCountryName($address["country"]) . "</li>";
        // We cannot sent the address_id as a form submission, because it will be visible by the users. 
        // Instead, we sent the index of the address from the user's own addresses
        // This prevents malicious users from trampling with the other user's addresses by F12 and modifiying the value of the form submissions.
        // Now they can only screw with their own addresses
        $result .= "</ul><form method='post' action='addresses.php'><input type='hidden' name='address_number' value='" . $i . "' />" .
                "<input class='w3-hover-teal w3-hover-text-white w3-button w3-block w3-white w3-border-teal w3-bottombar w3-text-teal w3-cell' style='width:50%' type='submit' value='Update Address' name='update_address'/>" .
                "<input class='w3-hover-red w3-hover-text-white w3-button w3-block w3-white w3-border-red w3-text-red w3-bottombar w3-cell' style='width:50%' type='submit' value='Delete Address' name='delete_address'/></form>";
        $result .= "</li>";
        $_SESSION["address_to_modify"][$i] = $address;
        $i++;
    }
    return $result;
}

function printPaymentMethodDetails() {
    $info = paymentMethodDetails();
    $result = "";
    $i = 0;
    foreach ($info as $paymentMethod) {
        $result .= "<li><ul class='w3-ul'>";
        $result .= "<li class='details_li'>Number: " . $paymentMethod["number"] . "</li>";
        $result .= "<li class='details_li'>Type: " . $paymentMethod["type"] . "</li>";
        $result .= "<li class='details_li'>Expiry Date: " . $paymentMethod["expiry_date"] . "</li>";

        $result .= "<form method='post' action='paymentMethods.php'><input type='hidden' name='paymentMethod_number' value='" . $i . "' />" .
                "<input class='w3-hover-teal w3-hover-text-white w3-button w3-block w3-white w3-border-teal w3-bottombar w3-text-teal w3-cell' style='width:50%' type='submit' value='Update Payment Method' name='update_paymentMethod'/>" .
                "<input class='w3-hover-red w3-hover-text-white w3-button w3-block w3-white w3-border-red w3-text-red w3-bottombar w3-cell' style='width:50%' type='submit' value='Delete Payment Method' name='delete_paymentMethod'/></form><br />";
        $result .= "</ul></li>";
        $_SESSION["paymentMethod_to_modify"][$i] = $paymentMethod;
        $i++;
    }
    return $result;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Account Information</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/jquery-validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>

    <body class="w3-light-grey">
        <?php
        include("header.php");

        if (isset($_POST['submitAccountDetails'])) {
            $error = [];
            // Check fields for errors:
            if (!isset($_POST["username"]) || $_POST["username"] == "") {
                $error[] = "Name can't be empty";
            }
            if (!isset($_POST["last_name"]) || $_POST["last_name"] == "") {
                $error[] = "Last name can't be empty";
            }
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Email not valid";
            }

            if (empty($error)) {
                $link = createConnection();
                // Sanitize all inputs
                $name = mysqli_real_escape_string($link, $_POST['username']);
                $lastName = mysqli_real_escape_string($link, $_POST['last_name']);
                $email = mysqli_real_escape_string($link, $_POST['email']);
                $sql1 = "UPDATE users SET name='" . $name . "', last_name='" . $lastName . "', email='" . $email . "' WHERE user_id='" . $_SESSION["user_id"] . "'";
                $result1 = mysqli_query($link, $sql1);

                // Update query
                if (!$result1) {
                    $error[] = "Email already registered";
                    mysqli_close($link);
                } else {
                    // If update successful, close connection and reload the page                    
                    mysqli_close($link);
                    header("Location: logout.php");
                }
            }
        } else if (isset($_POST["delete_account_submit"])) {
            $error = [];
            $link = createConnection();
            // Sanitize all inputs
            $password = mysqli_real_escape_string($link, $_POST['delete_account_password']);
            $sql = "SELECT * FROM users WHERE user_id='" . $_SESSION["user_id"] . "'";
            $result = mysqli_query($link, $sql);

            if (!$result) {
                mysqli_close($link);
                die("ERROR: There is an error in the PASSWORD SQL query. Please contact site admin");
            } else {
                $row = mysqli_fetch_array($result);
                // If passwords match, delete the user
                if (password_verify($password, $row["password"])) {
                    $sql = "DELETE FROM users WHERE user_id='" . $_SESSION["user_id"] . "'";
                    $result = mysqli_query($link, $sql);

                    if (!$result) {
                        mysqli_close($link);
                        die("ERROR: There is an error in the DELETE USER SQL query. Please contact site admin");
                    } else {
                        header("Location: logout.php");
                    }
                } else {
                    $error[] = "Delete failed: Wrong Password";
                }
            }
        }

        if (!isset($_POST['submit']) || !empty($error)) {
            if (isset($error)) {
                echo printErrorMessage($error);
            }
            ?>
            <nav class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left w3-quarter w3-cent" id="account_nav">
                <div class="w3-teal w3-text-white w3-container">
                    <h4><strong>Details</strong></h4>
                </div>
                <div>
                    <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
                    <a class="w3-hover-teal w3-hover-text-white w3-bar-item w3-button" href="#personal_details_section">Personal details</a>
                    <a class="w3-hover-teal w3-hover-text-white w3-bar-item w3-button" href="#addresses_section">My addresses</a>
                    <a class="w3-hover-teal w3-hover-text-white w3-bar-item w3-button" href="#payment_methods_section">Payment methods</a>
                    <a class="w3-hover-teal w3-hover-text-white w3-bar-item w3-button" href="#order_history_section">Personal details</a>
                    <?php echo ($_SESSION["type"] == "admin") ? "<a class='w3-hover-teal w3-hover-text-white w3-bar-item w3-button' href='#admin_actions_section'>Admin Menu</a>" : "" ?>
                </div>
            </nav>

            <article class="w3-container w3-threequarter w3-right w3-mobile" id="accountInfoArticle">
                <div class="w3-grey">
                    <div class="w3-grey w3-text-black w3-container w3-center">
                        <button class="w3-button w3-teal w3-xlarge w3-hide-large w3-left" onclick="w3_open()">&#9776;</button>
                        <h2><strong>Account Information</strong></h2>
                    </div>
                    <figure class="w3-container w3-center">
                        <img src="img/logo3.png" alt="logo">
                    </figure>
                </div>

                <section class="w3-card" id="personal_details_section">
                    <div class="w3-teal w3-text-white w3-container w3-center">
                        <h3>My personal information</h3>
                    </div>
                    <form id="personal_details_form" class="w3-container w3-padding-16 w3-white" method="post" action="account.php">
                        <?php
                        echo showAccountDetails();
                        ?>
                        <input class="w3-block w3-button w3-teal" type="submit" name="submitAccountDetails" value="Update Account" />
                    </form>
                    <script src="js/form_manager.js"></script>
                </section>

                <section class="w3-card" id="addresses_section">
                    <div class="w3-teal w3-text-white w3-container w3-center">
                        <h3>My addresses</h3>
                    </div>
                    <ol class="w3-ul">
                        <?php
                        echo printAddressDetails();
                        ?>  
                    </ol>
                    <form class="w3-container w3-padding-16 w3-white" method="post" action="addresses.php" >
                        <input class="w3-block w3-button w3-teal" type="submit" name="add_address" value="Add addreess" class="details_button" id="add_address_button" />
                    </form>
                </section>

                <section>
                    <div class="w3-teal w3-text-white w3-container w3-center">
                        <h3>My Payment Methods</h3>
                    </div>
                    <ol class="w3-ul">
                        <?php
                        echo printPaymentMethodDetails();
                        ?>  
                    </ol>

                    <form class="w3-container w3-padding-16 w3-white" method="POST" action="paymentMethods.php" >
                        <input class="w3-block w3-button w3-teal" type="submit" name="add_paymentMethod" value="Add Payment Method" class="details_button" id="add_paymethod_button" />
                    </form>
                </section>


                <section id="order_history_section">
                    <h3>Payment Methods</h3>
                </section>
                <?php
                //If we are admin, we are shown admin options

                if ($_SESSION["type"] == "admin") {
                    ?>
                    <section id="admin_actions_section">
                        <h3>Admin Actions</h3>

                        <form action="manageProduct.php" method="POST">

                            <br/>
                            <input name="newProduct" type="submit" value="New Product"/>

                        </form>

                        <form action="manageProduct.php" method="POST">

                            <br/>
                            <input name="editProduct" type="submit" value="Edit Product"/>

                        </form>

                        <form action="manageProduct.php" method="POST">

                            <br/>
                            <input name="deleteProduct" type="submit" value="Delete Product"/>

                        </form>
                    </section>

                    <?php
                }
                ?>

                <section>
                    <h3>Delete Account</h3>
                    <?php
                    if (isset($error)) {
                        printErrorMessage($error);
                    }
                    ?> 
                    <form id="delete_account_form" class="account_form" method="post" action="account.php">
                        <div class="account_instructions" id="delete_account_instructions">To delete your account, please confirm your password: </div>
                        <input type="password" name="delete_account_password" required="required"/>
                        <input type="submit" name="delete_account_submit" value="Delete Account" />
                    </form>
                </section>
            </article>
            <?php //include("footer.php"); ?>
            <script>
                            function w3_open() {
                                document.getElementById("account_nav").style.display = "block";
                            }
                            function w3_close() {
                                document.getElementById("account_nav").style.display = "none";
                            }
            </script>
            <?php
        }
        ?>
    </body>
</html>
