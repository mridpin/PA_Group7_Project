<?php

/* Returns true or false if a country code exists in the ISO list of country codes */

function doesCountryExist($countryCode) {
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
    return array_key_exists($countryCode, $iso_array);
}

/* Returns a country's full name from the ISO country code */

function getCountryName($countryCode) {
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
    $res = (isset($iso_array[$countryCode])) ? $iso_array[$countryCode] : "";
    return $res;
}

function printErrorMessage($errors) {
    $res = "<p class='w3-panel w3-red'>";
    if (isset($errors) && !empty($errors)) {
        foreach ($errors as $error) {
            $res = $res . $error . "<br />";
        }
    }
    $res = $res . "</p>";
    return $res;
}

/* Creates a connection with the dabase and returns it */

function createConnection() {
    $con = mysqli_connect("localhost", "root", "");
    //Lo que yo quiero hacer:
    //$con = mysqli_connect("198.91.81.7", "grupoa0_admin", "admin");
    if (!$con) {
        die("ERROR: Can't connect to host");
    }
    $db = mysqli_select_db($con, "grupopa0_db");

    if (!$db) {
        die("ERROR: Can't connect to DB ");
    }
    return $con;
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

//Checks if we have any valid credit cards
function validPaymentMethods($paymentMethod)
{
 
    $result=[];
    
    for($i=0;$i<sizeof($paymentMethod);$i++)
    {
        if($paymentMethod[$i]["expiry_date"]>date("Y-m-d"))
        {
            $result["number"] =  $paymentMethod["number"];
            $result["type"] =  $paymentMethod["type"];
            $result["expiry_date"] =  $paymentMethod["expiry_date"];
        }
    }
    
    return $result;
    
}




// Check if session is up. If not, send user to login or to specified site
function checkSession($location = "login") {
    if (!isset($_SESSION["user"])) {
        header("Location: $location.php");
    }
}

// Print a welcome message and buttons to see account and logout. This function is called inside the <header> tag
function printWelcome() {
    if (isset($_SESSION["user"])) {
        echo "Welcome back, " . $_SESSION["user"] . "!";
        echo "<div><a href='account.php' class='w3-button w3-block'>My Account</a>" .
        "<a class='w3-button w3-block'  href='logout.php'>Logout</a></div>";
    } else {
        echo "<a class='w3-button' href='login.php'><p>Login/Register</p></a>";
    }
    if (isset($_SESSION["cart"])) {
       echo "<div><a href='order.php' class='w3-button w3-block'>Cart: " . count($_SESSION["cart"])."</a>";
    }
}

//Gets all of the components in the DB
function getAllComponents() {

    $con = createConnection();
    $sentencia = "SELECT * FROM products";
    $query = mysqli_query($con, $sentencia);

    if ($query) {

        $i = 0;
        while ($raw_Components = mysqli_fetch_array($query)) {
            $result[$i][0] = $raw_Components["name"];
            $result[$i][1] = $raw_Components["price"];
            $result[$i][2] = $raw_Components["stock"];
            $result[$i][3] = $raw_Components["product_id"];
            $i++;
        }

        mysqli_free_result($query);
        mysqli_close($con);
    } else {
        mysqli_close($con);
        die("ERROR: No se ha podido ejecutar la sentencia");
    }


    return $result;
}

// Returns the name of a component from the database
function getComponentName($component) {
    $result = explode("_", $component);
    return $result[2];
}

?>