<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
include 'functions.php';
require_once 'functions.php';

$iso_array = array(
    'ABW' => 'Aruba',
    'AFG' => 'Afghanistan',
    'AGO' => 'Angola',
    'AIA' => 'Anguilla',
    'ALA' => 'Åland Islands',
    'ALB' => 'Albania',
    'AND' => 'Andorra',
    'ARE' => 'United Arab Emirates',
    'ARG' => 'Argentina',
    'ARM' => 'Armenia',
    'ASM' => 'American Samoa',
    'ATA' => 'Antarctica',
    'ATF' => 'French Southern Territories',
    'ATG' => 'Antigua and Barbuda',
    'AUS' => 'Australia',
    'AUT' => 'Austria',
    'AZE' => 'Azerbaijan',
    'BDI' => 'Burundi',
    'BEL' => 'Belgium',
    'BEN' => 'Benin',
    'BES' => 'Bonaire, Sint Eustatius and Saba',
    'BFA' => 'Burkina Faso',
    'BGD' => 'Bangladesh',
    'BGR' => 'Bulgaria',
    'BHR' => 'Bahrain',
    'BHS' => 'Bahamas',
    'BIH' => 'Bosnia and Herzegovina',
    'BLM' => 'Saint Barthélemy',
    'BLR' => 'Belarus',
    'BLZ' => 'Belize',
    'BMU' => 'Bermuda',
    'BOL' => 'Bolivia, Plurinational State of',
    'BRA' => 'Brazil',
    'BRB' => 'Barbados',
    'BRN' => 'Brunei Darussalam',
    'BTN' => 'Bhutan',
    'BVT' => 'Bouvet Island',
    'BWA' => 'Botswana',
    'CAF' => 'Central African Republic',
    'CAN' => 'Canada',
    'CCK' => 'Cocos (Keeling) Islands',
    'CHE' => 'Switzerland',
    'CHL' => 'Chile',
    'CHN' => 'China',
    'CIV' => 'Côte d\'Ivoire',
    'CMR' => 'Cameroon',
    'COD' => 'Congo, the Democratic Republic of the',
    'COG' => 'Congo',
    'COK' => 'Cook Islands',
    'COL' => 'Colombia',
    'COM' => 'Comoros',
    'CPV' => 'Cape Verde',
    'CRI' => 'Costa Rica',
    'CUB' => 'Cuba',
    'CUW' => 'Curaçao',
    'CXR' => 'Christmas Island',
    'CYM' => 'Cayman Islands',
    'CYP' => 'Cyprus',
    'CZE' => 'Czech Republic',
    'DEU' => 'Germany',
    'DJI' => 'Djibouti',
    'DMA' => 'Dominica',
    'DNK' => 'Denmark',
    'DOM' => 'Dominican Republic',
    'DZA' => 'Algeria',
    'ECU' => 'Ecuador',
    'EGY' => 'Egypt',
    'ERI' => 'Eritrea',
    'ESH' => 'Western Sahara',
    'ESP' => 'Spain',
    'EST' => 'Estonia',
    'ETH' => 'Ethiopia',
    'FIN' => 'Finland',
    'FJI' => 'Fiji',
    'FLK' => 'Falkland Islands (Malvinas)',
    'FRA' => 'France',
    'FRO' => 'Faroe Islands',
    'FSM' => 'Micronesia, Federated States of',
    'GAB' => 'Gabon',
    'GBR' => 'United Kingdom',
    'GEO' => 'Georgia',
    'GGY' => 'Guernsey',
    'GHA' => 'Ghana',
    'GIB' => 'Gibraltar',
    'GIN' => 'Guinea',
    'GLP' => 'Guadeloupe',
    'GMB' => 'Gambia',
    'GNB' => 'Guinea-Bissau',
    'GNQ' => 'Equatorial Guinea',
    'GRC' => 'Greece',
    'GRD' => 'Grenada',
    'GRL' => 'Greenland',
    'GTM' => 'Guatemala',
    'GUF' => 'French Guiana',
    'GUM' => 'Guam',
    'GUY' => 'Guyana',
    'HKG' => 'Hong Kong',
    'HMD' => 'Heard Island and McDonald Islands',
    'HND' => 'Honduras',
    'HRV' => 'Croatia',
    'HTI' => 'Haiti',
    'HUN' => 'Hungary',
    'IDN' => 'Indonesia',
    'IMN' => 'Isle of Man',
    'IND' => 'India',
    'IOT' => 'British Indian Ocean Territory',
    'IRL' => 'Ireland',
    'IRN' => 'Iran, Islamic Republic of',
    'IRQ' => 'Iraq',
    'ISL' => 'Iceland',
    'ISR' => 'Israel',
    'ITA' => 'Italy',
    'JAM' => 'Jamaica',
    'JEY' => 'Jersey',
    'JOR' => 'Jordan',
    'JPN' => 'Japan',
    'KAZ' => 'Kazakhstan',
    'KEN' => 'Kenya',
    'KGZ' => 'Kyrgyzstan',
    'KHM' => 'Cambodia',
    'KIR' => 'Kiribati',
    'KNA' => 'Saint Kitts and Nevis',
    'KOR' => 'Korea, Republic of',
    'KWT' => 'Kuwait',
    'LAO' => 'Lao People\'s Democratic Republic',
    'LBN' => 'Lebanon',
    'LBR' => 'Liberia',
    'LBY' => 'Libya',
    'LCA' => 'Saint Lucia',
    'LIE' => 'Liechtenstein',
    'LKA' => 'Sri Lanka',
    'LSO' => 'Lesotho',
    'LTU' => 'Lithuania',
    'LUX' => 'Luxembourg',
    'LVA' => 'Latvia',
    'MAC' => 'Macao',
    'MAF' => 'Saint Martin (French part)',
    'MAR' => 'Morocco',
    'MCO' => 'Monaco',
    'MDA' => 'Moldova, Republic of',
    'MDG' => 'Madagascar',
    'MDV' => 'Maldives',
    'MEX' => 'Mexico',
    'MHL' => 'Marshall Islands',
    'MKD' => 'Macedonia, the former Yugoslav Republic of',
    'MLI' => 'Mali',
    'MLT' => 'Malta',
    'MMR' => 'Myanmar',
    'MNE' => 'Montenegro',
    'MNG' => 'Mongolia',
    'MNP' => 'Northern Mariana Islands',
    'MOZ' => 'Mozambique',
    'MRT' => 'Mauritania',
    'MSR' => 'Montserrat',
    'MTQ' => 'Martinique',
    'MUS' => 'Mauritius',
    'MWI' => 'Malawi',
    'MYS' => 'Malaysia',
    'MYT' => 'Mayotte',
    'NAM' => 'Namibia',
    'NCL' => 'New Caledonia',
    'NER' => 'Niger',
    'NFK' => 'Norfolk Island',
    'NGA' => 'Nigeria',
    'NIC' => 'Nicaragua',
    'NIU' => 'Niue',
    'NLD' => 'Netherlands',
    'NOR' => 'Norway',
    'NPL' => 'Nepal',
    'NRU' => 'Nauru',
    'NZL' => 'New Zealand',
    'OMN' => 'Oman',
    'PAK' => 'Pakistan',
    'PAN' => 'Panama',
    'PCN' => 'Pitcairn',
    'PER' => 'Peru',
    'PHL' => 'Philippines',
    'PLW' => 'Palau',
    'PNG' => 'Papua New Guinea',
    'POL' => 'Poland',
    'PRI' => 'Puerto Rico',
    'PRK' => 'Korea, Democratic People\'s Republic of',
    'PRT' => 'Portugal',
    'PRY' => 'Paraguay',
    'PSE' => 'Palestinian Territory, Occupied',
    'PYF' => 'French Polynesia',
    'QAT' => 'Qatar',
    'REU' => 'Réunion',
    'ROU' => 'Romania',
    'RUS' => 'Russian Federation',
    'RWA' => 'Rwanda',
    'SAU' => 'Saudi Arabia',
    'SDN' => 'Sudan',
    'SEN' => 'Senegal',
    'SGP' => 'Singapore',
    'SGS' => 'South Georgia and the South Sandwich Islands',
    'SHN' => 'Saint Helena, Ascension and Tristan da Cunha',
    'SJM' => 'Svalbard and Jan Mayen',
    'SLB' => 'Solomon Islands',
    'SLE' => 'Sierra Leone',
    'SLV' => 'El Salvador',
    'SMR' => 'San Marino',
    'SOM' => 'Somalia',
    'SPM' => 'Saint Pierre and Miquelon',
    'SRB' => 'Serbia',
    'SSD' => 'South Sudan',
    'STP' => 'Sao Tome and Principe',
    'SUR' => 'Suriname',
    'SVK' => 'Slovakia',
    'SVN' => 'Slovenia',
    'SWE' => 'Sweden',
    'SWZ' => 'Swaziland',
    'SXM' => 'Sint Maarten (Dutch part)',
    'SYC' => 'Seychelles',
    'SYR' => 'Syrian Arab Republic',
    'TCA' => 'Turks and Caicos Islands',
    'TCD' => 'Chad',
    'TGO' => 'Togo',
    'THA' => 'Thailand',
    'TJK' => 'Tajikistan',
    'TKL' => 'Tokelau',
    'TKM' => 'Turkmenistan',
    'TLS' => 'Timor-Leste',
    'TON' => 'Tonga',
    'TTO' => 'Trinidad and Tobago',
    'TUN' => 'Tunisia',
    'TUR' => 'Turkey',
    'TUV' => 'Tuvalu',
    'TWN' => 'Taiwan, Province of China',
    'TZA' => 'Tanzania, United Republic of',
    'UGA' => 'Uganda',
    'UKR' => 'Ukraine',
    'UMI' => 'United States Minor Outlying Islands',
    'URY' => 'Uruguay',
    'USA' => 'United States',
    'UZB' => 'Uzbekistan',
    'VAT' => 'Holy See (Vatican City State)',
    'VCT' => 'Saint Vincent and the Grenadines',
    'VEN' => 'Venezuela, Bolivarian Republic of',
    'VGB' => 'Virgin Islands, British',
    'VIR' => 'Virgin Islands, U.S.',
    'VNM' => 'Viet Nam',
    'VUT' => 'Vanuatu',
    'WLF' => 'Wallis and Futuna',
    'WSM' => 'Samoa',
    'YEM' => 'Yemen',
    'ZAF' => 'South Africa',
    'ZMB' => 'Zambia',
    'ZWE' => 'Zimbabwe'
);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <header>
            <div>

                <a href="index.php"><p>Insert Logo Here</p></a>

            </div>
        </header>

        <div>
            <h2>Enter the information below to create a new account</h2>
        </div>
        <?php
        if (isset($_POST['submit'])) {

            $error = [];
            // Check fields for errors:
            if (!isset($_POST["username"]) || $_POST["username"] == "") {
                $error[] = "Name can't be empty";
            }
            if (!isset($_POST["lastName"]) || $_POST["lastName"] == "") {
                $error[] = "Last name can't be empty";
            }
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Email not valid";
            }
            if (strlen($_POST["password"]) < 8) {
                $error[] = "Password must contain at least 8 characters";
            }
            if (!preg_match("/^[[:alnum:]]+$/", $_POST["zipCode"])) {
                $error[] = "Zip Code not valid";
            }
            if (!isset($_POST["street"]) || $_POST["street"] == "") {
                $error[] = "Street can't be empty";
            }
            if (!filter_var($_POST["number"], FILTER_VALIDATE_INT)) {
                $error[] = "Number not valid";
            }
            if (!isset($_POST["country"]) || $_POST["country"] == "" || !array_key_exists($_POST["country"], $iso_array)) {
                $error[] = "Country " . $_POST["country"] . " not valid";
            }

            if (empty($error)) {
                $link = createConnection();
                // Sanitize all inputs
                $name = mysqli_real_escape_string($link, $_POST['username']);
                $lastName = mysqli_real_escape_string($link, $_POST['lastName']);
                $pwd = mysqli_real_escape_string($link, $_POST['password']);
                $email = mysqli_real_escape_string($link, $_POST['email']);
                $hash = password_hash($pwd, PASSWORD_DEFAULT);
                $zip = mysqli_real_escape_string($link, $_POST['zipCode']);
                $street = mysqli_real_escape_string($link, $_POST['street']);
                $number = mysqli_real_escape_string($link, $_POST['number']);
                $country = mysqli_real_escape_string($link, $_POST['country']);
                $sql1 = "INSERT INTO users (type, name, password, last_name, email) VALUES ('user', '" . $name . "', '" . $hash . "', '" . $lastName . "', '" . $email . "')";
                $result1 = mysqli_query($link, $sql1);

                // If query 1 fails, query 2 won't be executed, and the user will be redirected to the form
                if (!$result1) {
                    $error[] = "Email already registered";
                    mysqli_close($link);
                }
                if (empty($error)) {
                    $user_id = mysqli_insert_id($link);
                    $sql2 = "INSERT INTO address (zip_code, country, street, number) VALUES ('" . $zip . "', '" . $country . "', '" . $street . "', '" . $number . "')";
                    $result2 = mysqli_query($link, $sql2);
                    if (!$result2) {
                        var_dump($result2);
                        mysqli_close($link);
                        die("CREATE ADDRESS QUERY ERROR: PLEASE CONTACT SITE ADMIN");
                    } else {
                        // If register successful, add user and address to relational table
                        $address_id = mysqli_insert_id($link);
                        $sql3 = "INSERT INTO user_address (user_id, address_id) VALUES ('" . $user_id . "', '" . $address_id . "')";
                        $result3 = mysqli_query($link, $sql3);
                        if (!$result3) {
                            var_dump($result3);
                            mysqli_close($link);
                            die("USER_ADDRESS QUERY ERROR: PLEASE CONTACT SITE ADMIN");
                        } else {
                            $_SESSION["user"] = $name;
                            mysqli_close($link);
                            header("Location: " . $_SESSION["origin"]);
                        }
                    }
                }
            }
        }
        if (!isset($_POST['submit']) || !empty($error)) {
            if (isset($error)) {
                echo printErrorMessage($error);
            }
            ?>
            <form action="register.php" method="POST">

                Username: <input name="username" type="text" required/>
                Password: <input name="password" type="password" required/>
                <br/>
                <br/>
                Last Name: <input name="lastName" type="text" required/>
                Email: <input name="email" type="email" required/>
                <br/>
                <br/>
                <br/>
                ZIP Code: <input name="zipCode" type="number" required/>
                <!-- Instead select field with countries from a DB table?-->
                Country: <select name="country" required>
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
                <br/>
                <br/>
                Street: <input name="street" type="text" required/>
                Number: <input name="number" type="number" required/>
                <br/>
                <br/>
                <input name="submit" type="submit" value="Register" required/>

            </form>
            <?php
        }
        ?>
        <br>

        <footer>Legal stuff goes here</footer>
    </body>
</html>
