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
    </head>
    <body>
        <div>
            <?php include("header.php"); ?>
        </div>
        
        <?php
        
        printWelcome();
        
        
        
        
        function addPaymentForm()
        {
            
            ?>
        <div class="creditCardForm">
            <div class="heading">
                <h1>Enter your Credit card Information</h1>
            </div>
            <div class="payment">
                <form method="POST" action="paymentMethods.php">
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" id="owner">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select>
                            <option value="01">January</option>
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
                        <select>
                            <option value="16"> 2016</option>
                            <option value="17"> 2017</option>
                            <option value="18"> 2018</option>
                            <option value="19"> 2019</option>
                            <option value="20"> 2020</option>
                            <option value="21"> 2021</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="img/visa.jpg" id="visa">
                        <img src="img/mastercard.jpg" id="mastercard">
                        <img src="img/amex.jpg" id="amex">
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" name="newPayment" class="btn btn-default" id="confirm-purchase">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="js/script.js"></script>
        
        
            <?php
        }
        if (isset($_POST['newPayment'])) {

            
        }
        if (isset($_POST['add_paymentMethod'])) {
                addPaymentForm();
            }
        
        ?>
        
        
        <?php include("footer.php"); ?>
        
        
    </body>
</html>
