<!DOCTYPE html>
<!--
This structure is a WIP, so you can edit it as much as your want.
-->
<?php
include 'functions.php';
require_once 'functions.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Order</title>
        <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    </head>

    <body class="w3-light-grey">
        <?php include("header.php"); ?>

        <?php
        define("COMPUTER_BUILD_LENGTH", 16);
        //We first get all the components and depending on the form we are on we filter it
        //OPTION 1 : Website will change form with the button to go to different selec windows (Maybe save the current build in session variable to always have it)
        //OPTION 2: We list all of the components directly instead of having to navigate through windows
        $components = getAllComponents();

        function computerForm() {

            $hdCode = "CP_PC_HD";
            $ramCode = "CP_PC_RAM";
            $mbCode = "CP_PC_MB";
            $cpuCode = "CP_PC_CPU";
            $gpuCode = "CP_PC_GPU";
            $osCode = "CP_PC_OS";
            $csCode = "CP_PC_CS";
            $msCode = "PB_PC_MS";
            $mnCode = "PB_PC_MN";
            $kbCode = "PB_PC_KB";
            $dsCode = "CP_PC_DS";
            $ddCode = "CP_PC_DD";
            $usbCode = "CP_PC_USB";

            //Hardrive Segment
            $result = "<div class='w3-teal w3-text-white w3-container'><h2>Select your Computer Components</h2></div>"
                    . "<form class='w3-container w3-padding-16 w3-white' action='newProduct.php' method='POST'>"
                    . "Main Hard Drive: <select class='w3-select' name='hd'>";



            $singleComponent = getSingleComponents($hdCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Second Hardrive Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Second Hard Drive: <select class='w3-select' name='shd'>"
                    . "<option value='-' name='-'>-</option>";

            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //CPU Hardrive Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "CPU: <select class='w3-select' name='cpu'>";

            $singleComponent = getSingleComponents($cpuCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }


            //RAM Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "RAM: <select class='w3-select' name='ram'>";


            $singleComponent = getSingleComponents($ramCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //GPU Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "GPU: <select class='w3-select' name='gpu'>";

            $singleComponent = getSingleComponents($gpuCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //MotherBoard Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "MotherBoard: <select class='w3-select' name='motherBoard'>";


            $singleComponent = getSingleComponents($mbCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Display port Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Main Display Port: <select class='w3-select' name='mDS'>";


            $singleComponent = getSingleComponents($dsCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Second Display Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Second Display port: <select class='w3-select' name='sDS'>"
                    . "<option value='-' name='-'>-</option>";

            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //USB Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "USB Port: <select class='w3-select' name='usb'>"
                    . "<option value='-' name='-'>-</option>";


            $singleComponent = getSingleComponents($usbCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Disk Drive Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Disk Drive: <select class='w3-select' name='diskDrive'>";

            $singleComponent = getSingleComponents($ddCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }


            //OS Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Operating System: <select class='w3-select' name='os'>"
                    . "<option value='-' name='-'>-</option>";


            $singleComponent = getSingleComponents($osCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Case Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Case: <select class='w3-select' name='case'>";


            $singleComponent = getSingleComponents($csCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Extra elements

            $result .= "</select>"
                    . "<h4>Additional Components</h4>";

            //Keyboard Segment
            $result .= "<br/>"
                    . "Keyboard: <select class='w3-select' name='keyboard'>"
                    . "<option value='-' name='-'>-</option>";


            $singleComponent = getSingleComponents($kbCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Mouse Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Mouse: <select class='w3-select' name='mouse'>"
                    . "<option value='-' name='-'>-</option>";


            $singleComponent = getSingleComponents($msCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Monitor Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Monitor: <select class='w3-select' name='monitor'>"
                    . "<option value='-' name='-'>-</option>";


            $singleComponent = getSingleComponents($mnCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Product Quantity: <input class ='w3-input w3-hover-grey' type='number' name='quantity' min='1' value='1'/> <br/>";

            $result .="<br/>"
                    . "<input type='hidden' name='computer' value='computer'>"
                    . "<input class='w3-block w3-button w3-teal' type='submit' name='firstForm' value='Make order'>"
                    . "</form>";
            
            

            echo $result;
        }

        function phoneForm() {

            $scCode = "CP_PH_SC";
            $cpuCode = "CP_PH_CPU";
            $ramCode = "CP_PH_RAM";
            $hdCode = "CP_PH_HD";
            $gpuCode = "CP_PH_GPU";
            $bdCode = "CP_PH_BD";
            $osCode = "CP_PH_OS";
            $fcCode = "CP_PH_FASTCHARGING";
            $hpCode = "CP_PH_JACK";
            $nfcCode = "CP_PH_NFC";
            $cmCode = "CP_PH_CM";
            $usbCode = "CP_PH_USB";
            $wrCode = "CP_PH_WIRELESS";
            $frCode = "CP_PH_FINGER";
            $btCode = "CP_PH_BT";

            //Screen Segment
            $result = "<div class='w3-teal w3-text-white w3-container'><h2>Select your Phone Components</h2></div>"
                    . "<form class='w3-container w3-padding-16 w3-white' action='newProduct.php' method='POST'>"
                    . "Screen: <select class='w3-select' name='screen'>";



            $singleComponent = getSingleComponents($scCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //CPU Hardrive Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "CPU: <select class='w3-select' name='cpu'>";

            $singleComponent = getSingleComponents($cpuCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //RAM Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "RAM: <select class='w3-select' name='ram'>";


            $singleComponent = getSingleComponents($ramCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //HD Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Storage: <select class='w3-select' name='hd'>";


            $singleComponent = getSingleComponents($hdCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //GPU Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "GPU: <select class='w3-select' name='gpu'>";

            $singleComponent = getSingleComponents($gpuCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Camera Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Camera: <select class='w3-select' name='camera'>";

            $singleComponent = getSingleComponents($cmCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Baterry Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Battery: <select class='w3-select' name='battery'>";

            $singleComponent = getSingleComponents($btCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //USB Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "USB: <select class='w3-select' name='usb'>";

            $singleComponent = getSingleComponents($usbCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Body Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Body: <select class='w3-select' name='body'>";

            $singleComponent = getSingleComponents($bdCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //OS Segment
            $result .= "</select>"
                    . "<br/>"
                    . "<br/>"
                    . "Operating System: <select class='w3-select' name='os'>";

            $singleComponent = getSingleComponents($osCode);
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "_" . $singleComponent[$i][3] . "_" . $singleComponent[$i][1] . "'>" . $singleComponent[$i][0] . " - $" . $singleComponent[$i][1] . "</option>";
            }

            //Extra Components
            $result .= "</select>"
                    . "<h4>Additional Components</h4>";
            
            //Fast Charging
            
            $singleComponent = getSingleComponents($fcCode);
            
                   $result .= "<br/>"
                                . "Fast Charging? ($" . $singleComponent[0][1] . ")<input type='checkbox' name='fastCharging' value='".$singleComponent[0][0] . "_" . $singleComponent[0][3] . "_" . $singleComponent[0][1]."'><br/><br/>";
                   
            //Jack
                   
            $singleComponent = getSingleComponents($hpCode);       
                   
                    $result .= "<br/>"
                            . "Headphone Jack? ($" . $singleComponent[0][1] . ")<input type='checkbox' name='headphoneJack' value='".$singleComponent[0][0] . "_" . $singleComponent[0][3] . "_" . $singleComponent[0][1]."'><br/><br/>";
                    
            //NFC
              
            $singleComponent = getSingleComponents($nfcCode); 
            
                    $result.= "<br/>"
                            . "NFC? ($" . $singleComponent[0][1] . ")<input type='checkbox' name='nfc' value='".$singleComponent[0][0] . "_" . $singleComponent[0][3] . "_" . $singleComponent[0][1]."'><br/><br/>";
            
            //Wireless Charging        
            
            $singleComponent = getSingleComponents($wrCode); 
                    
                    $result.="<br/>"
                            . "Wireless Charging? ($" . $singleComponent[0][1] . ")<input type='checkbox' name='wirelessCharging' value='".$singleComponent[0][0] . "_" . $singleComponent[0][3] . "_" . $singleComponent[0][1]."'><br/><br/>";
                    
            //Fingerprint
                    
             $singleComponent = getSingleComponents($frCode);         
             
                    $result.="<br/>"
                            ."Fingerprint Reader? ($" . $singleComponent[0][1] . ")<input type='checkbox' name='fingerprintReader' value='".$singleComponent[0][0] . "_" . $singleComponent[0][3] . "_" . $singleComponent[0][1]."'><br/><br/>";

            $result .= "<input type='hidden' name='phone' value='phone'>"
                    . "<input class='w3-block w3-button w3-teal' type='submit' name='firstForm' value='Make order'>"
                    . "</form>";



            echo $result;
        }

        function productForm() {
            $pbCode = "PB";

            $products = getSingleComponents($pbCode);

            $result = "<h2>Select your Products</h2>";

            echo $result;
        }

        //Gets a particular component depending on the code given as parameter variable
        function getSingleComponents($code) {
            $result = [];
            global $components;
            $j = 0;
            for ($i = 0; $i < sizeof($components); $i++) {
                if (strpos($components[$i][0], $code) !== false) {
                    $result[$j][0] = substr($components[$i][0], 6); // component name
                    $result[$j][1] = $components[$i][1]; // component price
                    $result[$j][2] = $components[$i][2]; // component stock
                    $result[$j][3] = $components[$i][3]; // product_id
                    $j++;
                }
            }

            return $result;
        }

        // Prints a summary of the selected elements and saves it as a session variable
        function notinuse() {
            $result = "";
            // Count the items in the cart
            if (isset($_SESSION["cart"])) {
                $n = count($_SESSION["cart"]) + 1;
            } else {
                $n = 0;
            }
            var_dump($n);

            if (isset($_POST["computer"])) {
                // Separate each item into name and id
                if ($_POST["hd"] !== "-") {
                    $hdd = explode("_", $_POST["hd"]);
                    $result .= "<tr><td>HDD 1</td><td>" . $hdd[0] . "</td></tr>";
                    $_SESSION["cart"][$n][$hdd[1]] = $hdd[0];
                } else {
                    $result .= "<tr><td>HDD 1</td><td>" . $_POST["hd"] . "</td></tr>";
                }

                if ($_POST["shd"] !== "-") {
                    $hdd2 = explode("_", $_POST["shd"]);
                    $result .= "<tr><td>HDD 2</td><td>" . $hdd2[0] . "</td></tr>";
                    $_SESSION["cart"][$n][$hdd2[1]] = $hdd2[0];
                } else {
                    $result .= "<tr><td>HDD 2</td><td>" . $_POST["shd"] . "</td></tr>";
                }
                if ($_POST["cpu"] !== "-") {
                    $item = explode("_", $_POST["cpu"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>CPU</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>CPU</td><td>" . $_POST["cpu"] . "</td></tr>";
                }
                if ($_POST["ram"] !== "-") {
                    $item = explode("_", $_POST["ram"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>RAM</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>RAM</td><td>" . $_POST["ram"] . "</td></tr>";
                }
                if ($_POST["gpu"] !== "-") {
                    $item = explode("_", $_POST["gpu"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>GPU</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>GPU</td><td>" . $_POST["gpu"] . "</td></tr>";
                }
                if ($_POST["motherBoard"] !== "-") {
                    $item = explode("_", $_POST["motherBoard"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>Motherboard</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>Motherboard</td><td>" . $_POST["motherBoard"] . "</td></tr>";
                }
//                if ($_POST["mDS"] !== "-") {
//                    $item = explode("_", $_POST["mDS"]);
//                    $_SESSION["cart"][$item[1]] = $item[0];
//                    $result .= "<tr><td>Main Display Port</td><td>" . $_SESSION["cart"][$item[1]] . "</td></tr>";
//                } else {
//                    $result .= "<tr><td>Main Display Port</td><td>" . $_POST["mDS"] . "</td></tr>";
//                }
//                if ($_POST["sDS"] !== "-") {
//                    $item = explode("_", $_POST["sDS"]);
//                    $_SESSION["cart"][$item[1]] = $item[0];
//                    $result .= "<tr><td>Secondary Display Port</td><td>" . $_SESSION["cart"][$item[1]] . "</td></tr>";
//                } else {
//                    $result .= "<tr><td>Secondary Display Port</td><td>" . $_POST["sDS"] . "</td></tr>";
//                }
//                if ($_POST["usb"] !== "-") {
//                    $item = explode("_", $_POST["usb"]);
//                    $_SESSION["cart"][$item[1]] = $item[0];
//                    $result .= "<tr><td>USB</td><td>" . $_SESSION["cart"][$item[1]] . "</td></tr>";                    
//                } else {
//                    $result .= "<tr><td>USB</td><td>" . $_POST["usb"] . "</td></tr>";
//                }
//                if ($_POST["nusb"] !== "-") {
//                    $item = explode("_", $_POST["nusb"]);
//                    $_SESSION["cart"][$item[1]] = $item[0];
//                    $result .= "<tr><td>Number of USBs</td><td>" . $_SESSION["cart"][$item[1]] . "</td></tr>";
//                    
//                } else {
//                    $result .= "<tr><td>Number of USBs</td><td>" . $_POST["nusb"] . "</td></tr>";
//                }
//
//                if ($_POST["diskDrive"] !== "-") {
//                    $item = explode("_", $_POST["diskDrive"]);
//                    $_SESSION["cart"][$item[1]] = $item[0];
//                    $result .= "<tr><td>Disk drive</td><td>" . $_SESSION["cart"][$item[1]] . "</td></tr>";
//                } else {
//                    $result .= "<tr><td>Disk drive</td><td>" . $_POST["diskDrive"] . "</td></tr>";
//                }
                if ($_POST["os"] !== "-") {
                    $item = explode("_", $_POST["os"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>Operating System</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>Operating System</td><td>" . $_POST["os"] . "</td></tr>";
                }
                if ($_POST["case"] !== "-") {
                    $item = explode("_", $_POST["case"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>Case</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>Case</td><td>" . $_POST["case"] . "</td></tr>";
                }


                if ($_POST["keyboard"] !== "-") {
                    $item = explode("_", $_POST["keyboard"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>Keyboard</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>Keyboard</td><td>" . $_POST["keyboard"] . "</td></tr>";
                }
                if ($_POST["mouse"] !== "-") {
                    $item = explode("_", $_POST["mouse"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>Mouse</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>Mouse</td><td>" . $_POST["mouse"] . "</td></tr>";
                }
                if ($_POST["monitor"] !== "-") {
                    $item = explode("_", $_POST["monitor"]);
                    $_SESSION["cart"][$n][$item[1]] = $item[0];
                    $result .= "<tr><td>Monitor</td><td>" . $_SESSION["cart"][$n][$item[1]] . "</td></tr>";
                } else {
                    $result .= "<tr><td>Monitor</td><td>" . $_POST["monitor"] . "</td></tr>";
                }
            }

            return $result;
        }

        function saveToCart() {
            $result = "";
// Count the items in the cart
            if (isset($_SESSION["cart"])) {
                $n = count($_SESSION["cart"]) + 1;
            } else {
                $n = 0;
            }
            if (isset($_POST["computer"])) {
// Separate each item into id, name and price
                if ($_POST["hd"] !== "-") {
                    $item = explode("_", $_POST["hd"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }

                if ($_POST["shd"] !== "-") {
                    $item = explode("_", $_POST["shd"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["cpu"] !== "-") {
                    $item = explode("_", $_POST["cpu"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["ram"] !== "-") {
                    $item = explode("_", $_POST["ram"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["gpu"] !== "-") {
                    $item = explode("_", $_POST["gpu"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["motherBoard"] !== "-") {
                    $item = explode("_", $_POST["motherBoard"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["mDS"] !== "-") {
                    $item = explode("_", $_POST["mDS"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
     
                if ($_POST["sDS"] !== "-") {
                    $item = explode("_", $_POST["sDS"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["usb"] !== "-") {
                    $item = explode("_", $_POST["usb"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                

                if ($_POST["diskDrive"] !== "-") {
                    $item = explode("_", $_POST["diskDrive"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["os"] !== "-") {
                    $item = explode("_", $_POST["os"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["case"] !== "-") {
                    $item = explode("_", $_POST["case"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }

                if ($_POST["keyboard"] !== "-") {
                    $item = explode("_", $_POST["keyboard"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["mouse"] !== "-") {
                    $item = explode("_", $_POST["mouse"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["monitor"] !== "-") {
                    $item = explode("_", $_POST["monitor"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
            } else if (isset($_POST["phone"])) {
// Separate each item into id, name and price
                if ($_POST["screen"] !== "-") {
                    $item = explode("_", $_POST["screen"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                
                if (!empty($_POST["nfc"])) {
                    $item = explode("_", $_POST["nfc"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                
                if (!empty($_POST["wirelessCharging"])) {
                    $item = explode("_", $_POST["wirelessCharging"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                
                if (!empty($_POST["fingerprintReader"])) {
                    $item = explode("_", $_POST["fingerprintReader"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                
                if (!empty($_POST["headphoneJack"])) {
                    $item = explode("_", $_POST["headphoneJack"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                
                if (!empty($_POST["fastCharging"])) {
                    $item = explode("_", $_POST["fastCharging"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }

                if ($_POST["cpu"] !== "-") {
                    $item = explode("_", $_POST["cpu"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["ram"] !== "-") {
                    $item = explode("_", $_POST["ram"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["hd"] !== "-") {
                    $item = explode("_", $_POST["hd"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["gpu"] !== "-") {
                    $item = explode("_", $_POST["gpu"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
//                if ($_POST["camera"] !== "-") {
//                    $item = explode("_", $_POST["camera"]);
//                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
//                }
                if ($_POST["body"] !== "-") {
                    $item = explode("_", $_POST["body"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
                if ($_POST["os"] !== "-") {
                    $item = explode("_", $_POST["os"]);
                    $_SESSION["cart"][$n][$item[1]][$item[0]] = $item[2];
                }
              /*  if ($_POST["quantity"] !== "-") {
                    $_SESSION["cart"][$n]["quantity"] = $_POST["quantity"];
                }*/
            }

            return $result;
        }
        ?>
        <!--
        This div is to select the components of the product (see document Vision de la apliacion)
        for reference.
        -->
        <article class="w3-card w3-mobile" style="width:50%;margin:auto;"">
            <section >
                <?php
                if (isset($_POST["firstForm"])) {
                    saveToCart();
                    header("Location: index.php");
                }

                if (!isset($_POST["firstForm"])) {
                    if (isset($_POST['computer'])) {
                        computerForm();
                    } else if (isset($_POST['phone'])) {
                        phoneForm();
                    } else {
                        productForm();
                    }
                }
                ?>
            </section>
        </article>

        <br/>

        <?php include("footer.php"); ?>

    </body>
</html>
