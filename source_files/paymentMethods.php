<?php
session_start();
include 'functions.php';
require_once 'functions.php';

checkSession();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Payment Methods</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>
    <body class="w3-light-grey">
        <div>
            <?php include("header.php"); ?>
        </div>

        <?php

        function addPaymentMethod() {
            $link = createConnection();

            $number = $_POST['cardNumber'];

            $security_code = password_hash($_POST['cvv'], PASSWORD_DEFAULT);

            $type = $_POST['type'];

            $year = $_POST['year'];

            $id = $_SESSION["user_id"];

            $month = $_POST['month'];

            $finalDate = date('Y-m-d', strtotime($year . "-" . $month . "-00"));

            $sql1 = "INSERT INTO payment_method (number,expiry_date,security_code,type,user_id) VALUES ('" . $number . "', '" . $finalDate . "', '" . $security_code . "', '" . $type . "', '" . $id . "')";
            $result1 = mysqli_query($link, $sql1);

            //Payment method already exists
            if (!$result1) {
                $error[] = "Payment Method already registered";
                mysqli_close($link);
            } else {
                // If insert successful, close connection and go to account page                   
                mysqli_close($link);
                header("Location: account.php");
            }

            if (isset($error)) {
                echo printErrorMessage($error);
            }
        }

        function deletePaymentMethod() {
            // Get the address to delete from this user's addresses. Cascade FK will delete it from user_address too
            $id = $_SESSION["user_id"];

            $link = createConnection();
            $sql = "DELETE FROM payment_method WHERE user_id='" . $id . "'";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                mysqli_close($link);
                die("DELETE PAYMENT METHOD QUERY ERROR: PLEASE CONTACT SITE ADMIN");
            } else {
                mysqli_close($link);
                header("Location: account.php");
            }
        }

        function addPaymentForm() {
            ?>
            <article class="creditCardForm w3-card w3-mobile" style="width:50%;margin:auto;" >            
                <section class="payment">
                    <div class="heading w3-teal w3-text-white w3-container w3-center">
                        <h2>Enter your Credit card Information</h2>
                    </div>
                    <form class="w3-container w3-padding-16 w3-white" method="post" action="paymentMethods.php">
                        <div class="form-group owner">
                            <label for="owner">Owner</label>
                            <input type="text" class="w3-input w3-hover-grey" name ="owner" id="owner">
                        </div>
                        <div class="form-group CVV">
                            <label for="cvv">CVV</label>
                            <input type="text" class="w3-input w3-hover-grey" name="cvv" id="cvv">
                        </div>
                        <div class="form-group" id="card-number-field">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" class="w3-input w3-hover-grey" name="cardNumber" id="cardNumber">
                        </div>
                        <div>
                            <label>Type of card</label>
                            <select name="type" id="type" class="w3-select">
                                <option value="Credit">Credit </option>
                                <option value="Debit">Debit</option>
                                <option value="Prepaid">Prepaid</option>
                            </select>
                        </div>
                        <div class="form-group" name="expiration-date" id="expiration-date">
                            <label>Expiration Date</label>
                            <select name="month" id="month" class="w3-select">
                                <option value="02">February </option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select name="year" id="year" class="w3-select">
                                <option value="2018"> 2018</option>
                                <option value="2019"> 2019</option>
                                <option value="2020"> 2020</option>
                                <option value="2021"> 2021</option>
                            </select>
                        </div>
                        <div class="form-group" id="credit_cards">
                            <img src="img/visa.jpg" id="visa">
                            <img src="img/mastercard.jpg" id="mastercard">
                            <img src="img/amex.jpg" id="amex">
                        </div>
                        <div class="form-group" id="pay-now">
                            <button type="submit" name="newPayment" class="w3-block w3-button w3-teal" id="confirm-purchase">Confirm</button>
                        </div>
                    </form>
                </section>
            </article>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="js/jquery.payform.min.js" charset="utf-8"></script>
            <script src="js/script.js"></script>


    <?php
}

print_r($_POST);

if (isset($_POST['newPayment'])) {
    addPaymentMethod();
} else if (isset($_POST['add_paymentMethod'])) {
    addPaymentForm();
} else if (isset($_POST['delete_paymentMethod'])) {
    deletePaymentMethod();
}
?>


        <?php include("footer.php"); ?>


    </body>
</html>
