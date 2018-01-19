<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Product</title>
    </head>
    <body>

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
                    switch(searchClass)
                    {
                        case "searchType":
                        {
                            aux=1;
                            break;
                        }
                        case "searchCategory":
                        {
                            aux=2;
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
        
        <?php
        include 'functions.php';
        require_once 'functions.php';

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
        function validateProduct()
        {
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
        
        function editProduct()
        {
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

                $sql1 = "UPDATE products SET name='".$finalName."',stock=".$stock.",price=".$pru." WHERE product_id=".$id;
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
        
        function deleteProduct()
        {

                $link = createConnection();
                // Sanitize all inputs
                $id = $_POST['id'];


                $sql1 = "DELETE FROM products WHERE product_id=".$id;
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
            $result = "<h3>Search the products you wish to perfom the action on:</h3>
                <input type='text' id='searchType' onkeyup='searchFunction(this)' placeholder='Search by Type'>
                <input type='text' id='searchCategory' onkeyup='searchFunction(this)' placeholder='Search by Category'>
                <table id ='productTable' border='1'>
                    <tr>
                        <th><b>Product ID</b></th>
                        <th><b>Type of product</b></th>
                        <th><b>Product Category</b></th>
                        <th><b>Name</b></th>
                        <th><b>Stock</b></th>
                        <th><b>Price per unit</b></th>
                        <th><b>Action</b></th>
                    </tr>";
            
            
            $button="submitDeleteProduct";
            $buttonText="Delete Product";
            
            if (isset($_POST['editProduct']))
            {
                $button = "submitEditProduct";
                $buttonText="Edit Product";
            }
            

            $components = getAllComponents();


            for ($i = 0; $i < sizeof($components); $i++) {
                $product = $components[$i];
                
                $id = $product[3];
                
                $result .= "<form method='POST' action='manageProduct.php'><tr>"
                        ."<td>".$id."</td>"
                        ."<input type='hidden' value='".$id."' name='id'>" //We use this to know what product is selected
                        . "<td><select name='type'>";

                $name = explode("_", $product[0]);


                //Component or normal product
                if ($name[0] == "CP") {
                    $result .= "<option value='CP_'>Component</option>";
                } else {
                    $result .= "<option value='PB_'>Product</option>";
                }

                $result .= "</select></td>";

                //Category

                $result .= "<td><select name='category'>";

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
                        . "<input type='text' name='name' value='" . $name[2] . "'/>"
                        . "</td>";

                //Stock
                $result .= "<td>"
                        . "<input type='text' name='stock' value='" . $product[2] . "'/>"
                        . "</td>";

                //Price per unit
                $result .= "<td>"
                        . "<input type='text' name='pru' value='" . $product[1] . "'/>"
                        . "</td>";

                //Last option
                //TODO: When clicked, Update DB
                
                
                
                $result .= "<td>"
                        . " <input type='submit' name='".$button."' value='".$buttonText."'>"
                        . "</td>"
                        . "</form>";
            }
            $result .= "</table>";

            echo $result;
        }
        ?>

        <div>

            <?php include("header.php"); ?>

        </div>

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
            }else if (isset($_POST['submitDeleteProduct'])) {
                deleteProduct();
            }else if (isset($_POST['editProduct']) || isset($_POST['deleteProduct'])) {
                searchProduct();
            } 
            
            ?>


        </div>

        <?php include("footer.php"); ?>

    </body>
</html>
