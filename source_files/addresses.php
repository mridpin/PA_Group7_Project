<?php
session_start();
include 'functions.php';
require_once 'functions.php';

checkSession();
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Account Information</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/jquery-validation/jquery.validate.js"></script>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>
    <body>
        <?php include("header.php"); ?>
        <?php
        printWelcome();

        if (isset($_POST['submit_address']) || isset($_POST['submit_new_address'])) {
            $error = [];
            // Check fields for errors:
            if (!preg_match("/^[[:alnum:]]+$/", $_POST["zipCode"])) {
                $error[] = "Zip Code not valid";
            }
            if (!isset($_POST["street"]) || $_POST["street"] == "") {
                $error[] = "Street can't be empty";
            }
            if (!filter_var($_POST["number"], FILTER_VALIDATE_INT)) {
                $error[] = "Number not valid";
            }
            if (!isset($_POST["country"]) || $_POST["country"] == "" || !doesCountryExist($_POST["country"])) {
                $error[] = "Country " . $_POST["country"] . " not valid";
            }


            if (empty($error)) {
                $link = createConnection();
                // Sanitize all inputs
                $zip = mysqli_real_escape_string($link, $_POST['zipCode']);
                $street = mysqli_real_escape_string($link, $_POST['street']);
                $number = mysqli_real_escape_string($link, $_POST['number']);
                $country = mysqli_real_escape_string($link, $_POST['country']);
                if (isset($_POST['submit_address'])) {
                    $sql = "UPDATE address set zip_code='" . $zip . "', country='" . $country . "', street='" . $street . "', number='" . $number . "' WHERE address_id='" . $_SESSION["address"]["address_id"] . "'";
                    $result = mysqli_query($link, $sql);
                    if (!$result) {
                        mysqli_close($link);
                        die("UPDATE ADDRESS QUERY ERROR: PLEASE CONTACT SITE ADMIN");
                    } else {
                        mysqli_close($link);
                        header("Location: account.php");
                    }
                } else if (isset($_POST['submit_new_address'])) {
                    // If the create new address was clicked, insert a new address an a new user_address connection
                    $sql = "INSERT INTO address (zip_code, country, street, number) values ('" . $zip . "', '" . $country . "', '" . $street . "', '" . $number . "')";
                    $result = mysqli_query($link, $sql);
                    if (!$result) {
                        mysqli_close($link);
                        die("INSERT ADDRESS QUERY ERROR: PLEASE CONTACT SITE ADMIN");
                    } else {
                        $address_id = mysqli_insert_id($link);
                        $sql2 = "INSERT INTO user_address (user_id, address_id) values ('" . $_SESSION["user_id"] . "', '" . $address_id . "')";
                        $result2 = mysqli_query($link, $sql2);
                        if (!$result2) {
                            mysqli_close($link);
                            die("INSERT USER_ADDRESS QUERY ERROR: PLEASE CONTACT SITE ADMIN");
                        } else {
                            mysqli_close($link);
                            header("Location: account.php");
                        }
                    }
                }
            }
        } else if (isset($_POST['delete_address'])) {
            // Get the address to delete from this user's addresses. Cascade FK will delete it from user_address too
            $addressIndex = $_POST["address_number"];
            $_SESSION["address"] = $_SESSION["address_to_modify"][$addressIndex];

            $link = createConnection();
            $sql = "DELETE FROM address WHERE address_id='" . $_SESSION["address"]["address_id"] . "'";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                mysqli_close($link);
                die("DELETE ADDRESS QUERY ERROR: PLEASE CONTACT SITE ADMIN");
            } else {
                mysqli_close($link);
                header("Location: account.php");
            }
        }

        if (!isset($_POST['submit_address']) || !empty($error)) {
            if (isset($error)) {
                echo printErrorMessage($error);
            }
            // Prepare the variables
            $zip = "";
            $street = "";
            $number = "";

            // Get the address that we are going to modify from the $_POST. The extra level of complexity $_POST<->$_SESSION is for security reasons
            if (isset($_POST["address_number"])) {
                $addressIndex = $_POST["address_number"];
                $_SESSION["address"] = $_SESSION["address_to_modify"][$addressIndex];

                $zip = $_SESSION["address"]["zip_code"];
                $street = $_SESSION["address"]["street"];
                $number = $_SESSION["address"]["number"];
            }
            ?>

            <article class="w3-card w3-mobile" style="width:50%;margin:auto;">
                <div class="w3-grey">
                    <div class="w3-grey w3-text-black w3-container w3-center">
                        <h2><strong>Account Information</strong></h2>
                    </div>
                    <figure class="w3-container w3-center">
                        <a href="account.php" ><img src="img/logo3.png"></a>
                    </figure>
                </div>

                <section>
                    <div class="w3-teal w3-text-white w3-container">
                        <h2>My address</h2>
                    </div>
                    <form class="w3-container w3-padding-16 w3-white" id="register_account_form" action="addresses.php" method="POST">
                        <label>ZIP Code: </label><input class="w3-input w3-hover-grey" name="zipCode" type="number" required='required' value="<?php echo $zip; ?>"/>
                        <label>Country: </label><select class="w3-select" name="country" required='required'>
                            <option value="" selected="selected" disabled="disabled" hidden="hidden">CHOOSE A COUNTRY</option>
                            <option value="AFG">Afghanistan</option>
                            <option value="ALA">Åland Islands</option>
                            <option value="ALB">Albania</option>
                            <option value="DZA">Algeria</option>
                            <option value="ASM">American Samoa</option>
                            <option value="AND">Andorra</option>
                            <option value="AGO">Angola</option>
                            <option value="AIA">Anguilla</option>
                            <option value="ATA">Antarctica</option>
                            <option value="ATG">Antigua and Barbuda</option>
                            <option value="ARG">Argentina</option>
                            <option value="ARM">Armenia</option>
                            <option value="ABW">Aruba</option>
                            <option value="AUS">Australia</option>
                            <option value="AUT">Austria</option>
                            <option value="AZE">Azerbaijan</option>
                            <option value="BHS">Bahamas</option>
                            <option value="BHR">Bahrain</option>
                            <option value="BGD">Bangladesh</option>
                            <option value="BRB">Barbados</option>
                            <option value="BLR">Belarus</option>
                            <option value="BEL">Belgium</option>
                            <option value="BLZ">Belize</option>
                            <option value="BEN">Benin</option>
                            <option value="BMU">Bermuda</option>
                            <option value="BTN">Bhutan</option>
                            <option value="BOL">Bolivia, Plurinational State of</option>
                            <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                            <option value="BIH">Bosnia and Herzegovina</option>
                            <option value="BWA">Botswana</option>
                            <option value="BVT">Bouvet Island</option>
                            <option value="BRA">Brazil</option>
                            <option value="IOT">British Indian Ocean Territory</option>
                            <option value="BRN">Brunei Darussalam</option>
                            <option value="BGR">Bulgaria</option>
                            <option value="BFA">Burkina Faso</option>
                            <option value="BDI">Burundi</option>
                            <option value="KHM">Cambodia</option>
                            <option value="CMR">Cameroon</option>
                            <option value="CAN">Canada</option>
                            <option value="CPV">Cape Verde</option>
                            <option value="CYM">Cayman Islands</option>
                            <option value="CAF">Central African Republic</option>
                            <option value="TCD">Chad</option>
                            <option value="CHL">Chile</option>
                            <option value="CHN">China</option>
                            <option value="CXR">Christmas Island</option>
                            <option value="CCK">Cocos (Keeling) Islands</option>
                            <option value="COL">Colombia</option>
                            <option value="COM">Comoros</option>
                            <option value="COG">Congo</option>
                            <option value="COD">Congo, the Democratic Republic of the</option>
                            <option value="COK">Cook Islands</option>
                            <option value="CRI">Costa Rica</option>
                            <option value="CIV">Côte d'Ivoire</option>
                            <option value="HRV">Croatia</option>
                            <option value="CUB">Cuba</option>
                            <option value="CUW">Curaçao</option>
                            <option value="CYP">Cyprus</option>
                            <option value="CZE">Czech Republic</option>
                            <option value="DNK">Denmark</option>
                            <option value="DJI">Djibouti</option>
                            <option value="DMA">Dominica</option>
                            <option value="DOM">Dominican Republic</option>
                            <option value="ECU">Ecuador</option>
                            <option value="EGY">Egypt</option>
                            <option value="SLV">El Salvador</option>
                            <option value="GNQ">Equatorial Guinea</option>
                            <option value="ERI">Eritrea</option>
                            <option value="EST">Estonia</option>
                            <option value="ETH">Ethiopia</option>
                            <option value="FLK">Falkland Islands (Malvinas)</option>
                            <option value="FRO">Faroe Islands</option>
                            <option value="FJI">Fiji</option>
                            <option value="FIN">Finland</option>
                            <option value="FRA">France</option>
                            <option value="GUF">French Guiana</option>
                            <option value="PYF">French Polynesia</option>
                            <option value="ATF">French Southern Territories</option>
                            <option value="GAB">Gabon</option>
                            <option value="GMB">Gambia</option>
                            <option value="GEO">Georgia</option>
                            <option value="DEU">Germany</option>
                            <option value="GHA">Ghana</option>
                            <option value="GIB">Gibraltar</option>
                            <option value="GRC">Greece</option>
                            <option value="GRL">Greenland</option>
                            <option value="GRD">Grenada</option>
                            <option value="GLP">Guadeloupe</option>
                            <option value="GUM">Guam</option>
                            <option value="GTM">Guatemala</option>
                            <option value="GGY">Guernsey</option>
                            <option value="GIN">Guinea</option>
                            <option value="GNB">Guinea-Bissau</option>
                            <option value="GUY">Guyana</option>
                            <option value="HTI">Haiti</option>
                            <option value="HMD">Heard Island and McDonald Islands</option>
                            <option value="VAT">Holy See (Vatican City State)</option>
                            <option value="HND">Honduras</option>
                            <option value="HKG">Hong Kong</option>
                            <option value="HUN">Hungary</option>
                            <option value="ISL">Iceland</option>
                            <option value="IND">India</option>
                            <option value="IDN">Indonesia</option>
                            <option value="IRN">Iran, Islamic Republic of</option>
                            <option value="IRQ">Iraq</option>
                            <option value="IRL">Ireland</option>
                            <option value="IMN">Isle of Man</option>
                            <option value="ISR">Israel</option>
                            <option value="ITA">Italy</option>
                            <option value="JAM">Jamaica</option>
                            <option value="JPN">Japan</option>
                            <option value="JEY">Jersey</option>
                            <option value="JOR">Jordan</option>
                            <option value="KAZ">Kazakhstan</option>
                            <option value="KEN">Kenya</option>
                            <option value="KIR">Kiribati</option>
                            <option value="PRK">Korea, Democratic People's Republic of</option>
                            <option value="KOR">Korea, Republic of</option>
                            <option value="KWT">Kuwait</option>
                            <option value="KGZ">Kyrgyzstan</option>
                            <option value="LAO">Lao People's Democratic Republic</option>
                            <option value="LVA">Latvia</option>
                            <option value="LBN">Lebanon</option>
                            <option value="LSO">Lesotho</option>
                            <option value="LBR">Liberia</option>
                            <option value="LBY">Libya</option>
                            <option value="LIE">Liechtenstein</option>
                            <option value="LTU">Lithuania</option>
                            <option value="LUX">Luxembourg</option>
                            <option value="MAC">Macao</option>
                            <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
                            <option value="MDG">Madagascar</option>
                            <option value="MWI">Malawi</option>
                            <option value="MYS">Malaysia</option>
                            <option value="MDV">Maldives</option>
                            <option value="MLI">Mali</option>
                            <option value="MLT">Malta</option>
                            <option value="MHL">Marshall Islands</option>
                            <option value="MTQ">Martinique</option>
                            <option value="MRT">Mauritania</option>
                            <option value="MUS">Mauritius</option>
                            <option value="MYT">Mayotte</option>
                            <option value="MEX">Mexico</option>
                            <option value="FSM">Micronesia, Federated States of</option>
                            <option value="MDA">Moldova, Republic of</option>
                            <option value="MCO">Monaco</option>
                            <option value="MNG">Mongolia</option>
                            <option value="MNE">Montenegro</option>
                            <option value="MSR">Montserrat</option>
                            <option value="MAR">Morocco</option>
                            <option value="MOZ">Mozambique</option>
                            <option value="MMR">Myanmar</option>
                            <option value="NAM">Namibia</option>
                            <option value="NRU">Nauru</option>
                            <option value="NPL">Nepal</option>
                            <option value="NLD">Netherlands</option>
                            <option value="NCL">New Caledonia</option>
                            <option value="NZL">New Zealand</option>
                            <option value="NIC">Nicaragua</option>
                            <option value="NER">Niger</option>
                            <option value="NGA">Nigeria</option>
                            <option value="NIU">Niue</option>
                            <option value="NFK">Norfolk Island</option>
                            <option value="MNP">Northern Mariana Islands</option>
                            <option value="NOR">Norway</option>
                            <option value="OMN">Oman</option>
                            <option value="PAK">Pakistan</option>
                            <option value="PLW">Palau</option>
                            <option value="PSE">Palestinian Territory, Occupied</option>
                            <option value="PAN">Panama</option>
                            <option value="PNG">Papua New Guinea</option>
                            <option value="PRY">Paraguay</option>
                            <option value="PER">Peru</option>
                            <option value="PHL">Philippines</option>
                            <option value="PCN">Pitcairn</option>
                            <option value="POL">Poland</option>
                            <option value="PRT">Portugal</option>
                            <option value="PRI">Puerto Rico</option>
                            <option value="QAT">Qatar</option>
                            <option value="REU">Réunion</option>
                            <option value="ROU">Romania</option>
                            <option value="RUS">Russian Federation</option>
                            <option value="RWA">Rwanda</option>
                            <option value="BLM">Saint Barthélemy</option>
                            <option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option value="KNA">Saint Kitts and Nevis</option>
                            <option value="LCA">Saint Lucia</option>
                            <option value="MAF">Saint Martin (French part)</option>
                            <option value="SPM">Saint Pierre and Miquelon</option>
                            <option value="VCT">Saint Vincent and the Grenadines</option>
                            <option value="WSM">Samoa</option>
                            <option value="SMR">San Marino</option>
                            <option value="STP">Sao Tome and Principe</option>
                            <option value="SAU">Saudi Arabia</option>
                            <option value="SEN">Senegal</option>
                            <option value="SRB">Serbia</option>
                            <option value="SYC">Seychelles</option>
                            <option value="SLE">Sierra Leone</option>
                            <option value="SGP">Singapore</option>
                            <option value="SXM">Sint Maarten (Dutch part)</option>
                            <option value="SVK">Slovakia</option>
                            <option value="SVN">Slovenia</option>
                            <option value="SLB">Solomon Islands</option>
                            <option value="SOM">Somalia</option>
                            <option value="ZAF">South Africa</option>
                            <option value="SGS">South Georgia and the South Sandwich Islands</option>
                            <option value="SSD">South Sudan</option>
                            <option value="ESP">Spain</option>
                            <option value="LKA">Sri Lanka</option>
                            <option value="SDN">Sudan</option>
                            <option value="SUR">Suriname</option>
                            <option value="SJM">Svalbard and Jan Mayen</option>
                            <option value="SWZ">Swaziland</option>
                            <option value="SWE">Sweden</option>
                            <option value="CHE">Switzerland</option>
                            <option value="SYR">Syrian Arab Republic</option>
                            <option value="TWN">Taiwan, Province of China</option>
                            <option value="TJK">Tajikistan</option>
                            <option value="TZA">Tanzania, United Republic of</option>
                            <option value="THA">Thailand</option>
                            <option value="TLS">Timor-Leste</option>
                            <option value="TGO">Togo</option>
                            <option value="TKL">Tokelau</option>
                            <option value="TON">Tonga</option>
                            <option value="TTO">Trinidad and Tobago</option>
                            <option value="TUN">Tunisia</option>
                            <option value="TUR">Turkey</option>
                            <option value="TKM">Turkmenistan</option>
                            <option value="TCA">Turks and Caicos Islands</option>
                            <option value="TUV">Tuvalu</option>
                            <option value="UGA">Uganda</option>
                            <option value="UKR">Ukraine</option>
                            <option value="ARE">United Arab Emirates</option>
                            <option value="GBR">United Kingdom</option>
                            <option value="USA">United States</option>
                            <option value="UMI">United States Minor Outlying Islands</option>
                            <option value="URY">Uruguay</option>
                            <option value="UZB">Uzbekistan</option>
                            <option value="VUT">Vanuatu</option>
                            <option value="VEN">Venezuela, Bolivarian Republic of</option>
                            <option value="VNM">Viet Nam</option>
                            <option value="VGB">Virgin Islands, British</option>
                            <option value="VIR">Virgin Islands, U.S.</option>
                            <option value="WLF">Wallis and Futuna</option>
                            <option value="ESH">Western Sahara</option>
                            <option value="YEM">Yemen</option>
                            <option value="ZMB">Zambia</option>
                            <option value="ZWE">Zimbabwe</option>
                        </select>
                        <label>Street: </label><input class="w3-input w3-hover-grey" name="street" type="text" required='required' value="<?php echo $zip; ?>"/>
                        <label>Number: </label><input class="w3-input w3-hover-grey" name="number" type="number" required='required' value="<?php echo $zip; ?>"/>
                        <?php
                        // Only display the update address button if the user hasnt clicked "add address" buttonbefore
                        if (isset($_POST["add_address"])) {
                            echo "";
                        } else {
                            echo "<input class='w3-hover-teal w3-hover-text-white w3-button w3-block w3-white w3-border-teal w3-bottombar w3-text-teal w3-cell' style='width:49%' input name='submit_address' type='submit' value='Update Address' />";
                        }
                        ?>
                        <input class="w3-hover-teal w3-hover-text-white w3-button w3-block w3-white w3-border-teal w3-bottombar w3-text-teal w3-cell" style="width:50%" name="submit_new_address" type="submit" value="Add as new" />
                    </form>
                    <script src="js/form_manager.js"></script>
                </section>
            </article>

            <?php
        }
        ?>
        <?php include("footer.php"); ?>
    </body>
</html>