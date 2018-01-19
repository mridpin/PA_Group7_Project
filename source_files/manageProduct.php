<!DOCTYPE html>
<?php
include 'functions.php';
require_once 'functions.php';
session_start();
checkSession();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Product</title>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>
    <body class="w3-light-grey">

        <!--
        We filter the shown products 
        -->
        <script>
            function searchFunction(searchBox) {
                // Declare variables 
                var input, filter, table, tr, td, i;

                var searchClass = searchBox.getAttribute("id");

                input = document.getElementById(searchClass);
                filter = input.value.toUpperCase();
                table = document.getElementById("productTable");
                tr = table.getElementsByTagName("tr");

                //We choose what filter we are going to use depending on what searchbox was used
                var aux;
                switch (searchClass)
                {
                    case "searchType":
                    {
                        aux = 1;
                        break;
                    }
                    case "searchCategory":
                    {
                        aux = 2;
                        break;
                    }
                }

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {

                    td = tr[i].getElementsByTagName("td")[aux];
                    if (td) {
                        if (td.textContent.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
        <?php include("header.php"); ?>
        <article class="w3-container w3-mobile" style="width:90%;margin:auto;">
            <div class="w3-teal w3-text-white w3-container w3-center">
                <h2>Product Management</h2>
            </div>            
            <section id="search_box" class="w3-card-4 w3-section">
                <?php

                //TODO: First number input to know how many products we are going to add, for now only 1 at a time 
                function newProduct() {
                    ?>
                    <h3>Complete the following form to add a new product:</h3>
                    <form method="POST" action="manageProduct.php">
                        <table border="1">
                            <tr>
                                <th><b>Type of product</b></th>
                                <th><b>Product Category</b></th>
                                <th><b>Name</b></th>
                                <th><b>Stock</b></th>
                                <th><b>Price per unit</b></th>
                            </tr>
                            <tr>
                                <td><select name="type">
                                        <option value="CP_">Component</option>
                                        <option value="PB_">Product</option>
                                    </select>
                                </td>
                                <td><select name="category">
                                        <option value="X_">-</option>
                                        <option value="PC_">PC</option>
                                        <option value="PH_">Phone</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="name" placeholder="Enter the Product name"/>
                                </td>
                                <td>
                                    <input type="number" name="stock" value="1" min="1"/>
                                </td>
                                <td>
                                    <input type="text" name="pru" placeholder="Enter the product's price "/>
                                </td>

                            </tr>
                        </table>

                        <input type="submit" name="submitNewProduct" value="Submit">
                    </form>


                    <?php
                }

                function addNewProduct() {
                    $error = validateProduct();

                    //No errors were found
                    if (empty($error)) {

                        $link = createConnection();
                        // Sanitize all inputs
                        $name = mysqli_real_escape_string($link, $_POST['name']);
                        $stock = mysqli_real_escape_string($link, $_POST['stock']);
                        $pru = mysqli_real_escape_string($link, $_POST['pru']);
                        $type = $_POST['type'];
                        $category = $_POST['category'];

                        //Different code name depending on what we want to insert
                        $finalName = $type . $category . $name;
                        ;

                        $sql1 = "INSERT INTO products (name,stock,price) VALUES ('" . $finalName . "', '" . $stock . "', '" . $pru . "')";
                        $result1 = mysqli_query($link, $sql1);

                        //Product already exists
                        if (!$result1) {
                            $error[] = "Product already registered";
                            mysqli_close($link);
                        } else {
                            // If insert successful, close connection and go to account page                   
                            mysqli_close($link);
                            header("Location: account.php");
                        }
                    }
                    if (isset($error)) {
                        echo printErrorMessage($error);
                    }
                }

                //Used to validate product for edit and add Product
                function validateProduct() {
                    $error = [];

                    if (!isset($_POST["name"]) || $_POST["name"] == "") {
                        $error[] = "Name can't be empty";
                    }
                    if (!isset($_POST["stock"]) || $_POST["stock"] <= 0 || !filter_var($_POST["stock"], FILTER_VALIDATE_INT)) {
                        $error[] = "Stock can't be empty or less than 0 and can't contain letters";
                    }
                    if (!isset($_POST["pru"]) || $_POST["pru"] <= 0 || !filter_var($_POST["pru"], FILTER_VALIDATE_FLOAT)) {
                        $error[] = "Price per unit can't be empty or less than 0 and can't contain letters";
                    }

                    return $error;
                }

                function editProduct() {
                    $error = validateProduct();

                    if (empty($error)) {

                        $link = createConnection();
                        // Sanitize all inputs
                        $name = mysqli_real_escape_string($link, $_POST['name']);
                        $stock = mysqli_real_escape_string($link, $_POST['stock']);
                        $pru = mysqli_real_escape_string($link, $_POST['pru']);
                        $type = $_POST['type'];
                        $category = $_POST['category'];
                        $id = $_POST['id'];

                        //Different code name depending on what we want to insert
                        $finalName = $type . $category . $name;

                        $sql1 = "UPDATE products SET name='" . $finalName . "',stock=" . $stock . ",price=" . $pru . " WHERE product_id=" . $id;
                        $result1 = mysqli_query($link, $sql1);

                        //Can't update product
                        if (!$result1) {
                            $error[] = "CAN'T UPDATE PRODUCT";
                            mysqli_close($link);
                        } else {
                            // If edit, close connection and go to account page                   
                            mysqli_close($link);
                            header("Location: account.php");
                        }
                    }
                    if (isset($error)) {
                        echo printErrorMessage($error);
                    }
                }

                function deleteProduct() {

                    $link = createConnection();
                    // Sanitize all inputs
                    $id = $_POST['id'];


                    $sql1 = "DELETE FROM products WHERE product_id=" . $id;
                    $result1 = mysqli_query($link, $sql1);

                    //Can't update product
                    if (!$result1) {
                        $error[] = "CAN'T DELETE PRODUCT";
                        mysqli_close($link);
                    } else {
                        // If edit, close connection and go to account page                   
                        mysqli_close($link);
                        header("Location: account.php");
                    }
                    if (isset($error)) {
                        echo printErrorMessage($error);
                    }
                }

                function searchProduct() {
                    $result = "<div class='w3-teal w3-text-white w3-container w3-center'>
                Search the products you wish to perfom the action on:</h3></div>
                <input class='w3-input' type='text' id='searchType' onkeyup='searchFunction(this)' placeholder='Search by Type'>
                <input class='w3-input' type='text' id='searchCategory' onkeyup='searchFunction(this)' placeholder='Search by Category'></section>
                <section class='w3-section'><table id='productTable' class='w3-table-all w3-centered'>
                    <tr>
                        <th><strong>Product ID</strong></th>
                        <th><strong>Type of product</strong></th>
                        <th><strong>Product Category</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Stock</strong></th>
                        <th><strong>Price per unit</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>";


                    $button = "submitDeleteProduct";
                    $buttonText = "Delete Product";

                    if (isset($_POST['editProduct'])) {
                        $button = "submitEditProduct";
                        $buttonText = "Edit Product";
                    }

                    $components = getAllComponents();

                    for ($i = 0; $i < sizeof($components); $i++) {
                        $product = $components[$i];

                        $id = $product[3];

                        $result .= "<tr>"
                                . "<td>" . $id . "<form method='POST' action='manageProduct.php' id='form_".$id."'>"
                                . "<input type='hidden' value='" . $id . "' name='id'></form></td>" //We use this to know what product is selected
                                . "<td><select name='type' class='w3-select w3-hover-light-grey' form='form_".$id."'>";

                        $name = explode("_", $product[0]);


                        //Component or normal product
                        if ($name[0] == "CP") {
                            $result .= "<option value='CP_'>Component</option>";
                        } else {
                            $result .= "<option value='PB_'>Product</option>";
                        }

                        $result .= "</select></td>";

                        //Category

                        $result .= "<td><select name='category' class='w3-select w3-hover-light-grey' form='form_".$id."'>";

                        if ($name[1] == "PC") {
                            $result .= "<option value='PC_'>PC</option>";
                        } else if ($name[1] == "PH") {
                            $result .= "<option value='PH_'>Phone</option>";
                        } else {
                            $result .= "<option value='X_'>-</option>";
                        }

                        $result .= "</select></td>";
                        //Name

                        $result .= "<td>"
                                . "<input class='w3-input w3-hover-light-grey' type='text' name='name' value='" . $name[2] . "' form='form_".$id."'/>"
                                . "</td>";

                        //Stock
                        $result .= "<td>"
                                . "<input class='w3-input' type='text' name='stock' value='" . $product[2] . "' form='form_".$id."'/>"
                                . "</td>";

                        //Price per unit
                        $result .= "<td>"
                                . "<input class='w3-input' type='text' name='pru' value='" . $product[1] . "' form='form_".$id."'/>"
                                . "</td>";

                        //Last option
                        //TODO: When clicked, Update DB



                        $result .= "<td>"
                                . " <input class='w3-button w3-teal w3-text-white' type='submit' name='" . $button . "' value='" . $buttonText . "' form='form_".$id."'>"
                                . "</td>";
                                //. "</form>";
                    }
                    $result .= "</table>";

                    echo $result;
                }
                ?>

                <!--
                
                Depending on what we chose, we are shown a different form
                
                -->
                <div>
                    <?php
                    if (isset($_POST['newProduct'])) {
                        newProduct();
                    } else if (isset($_POST['submitNewProduct'])) {
                        addNewProduct();
                    } else if (isset($_POST['submitEditProduct'])) {
                        editProduct();
                    } else if (isset($_POST['submitDeleteProduct'])) {
                        deleteProduct();
                    } else if (isset($_POST['editProduct']) || isset($_POST['deleteProduct'])) {
                        searchProduct();
                    }
                    ?>
                </div>

                <?php include("footer.php"); ?>
            </section>
        </article>

    </body>
</html>
