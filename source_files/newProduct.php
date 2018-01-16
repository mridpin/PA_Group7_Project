<!DOCTYPE html>
<!--
This structure is a WIP, so you can edit it as much as your want.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Order</title>
    </head>
    <body>
        <?php
        include 'functions.php';
        require_once 'functions.php';

        //We first get all the components and depending on the form we are on we filter it
        //OPTION 1 : Website will change form with the button to go to different selec windows (Maybe save the current build in session variable to always have it)
        //OPTION 2: We list all of the components directly instead of having to navigate through windows
        $components = getAllComponents();
        

        function computerForm() {
            
            //TODO: Add a CD option and a Display port option
            
            
            $hdCode = "CP_PC_HD";
            $ramCode = "CP_PC_RAM";
            $mbCode = "CP_PC_MB";
            $cpuCode = "CP_PC_CPU";
            $gpuCode="CP_PC_GPU";
            $osCode="CP_PC_OS";
            $csCode="CP_PC_CS";
            $msCode="PB_PC_MS";
            $mnCode="PB_PC_MN";
            $kbCode="PB_PC_KB";
            
            //Hardrive Segment
            $result = "<h2>Select your Computer Components</h2>"
                    ."<form action='newProduct.php' method='POST'>"
                    . "Main Hard Drive: <select name='hd'>";

            
            
            $singleComponent = getSingleComponents($hdCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Second Hardrive Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Second Hard Drive: <select name='shd'>"
                    ."<option value='-' name='-'>-</option>"; 
   
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //CPU Hardrive Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "CPU: <select name='cpu'>";
            
            $singleComponent = getSingleComponents($cpuCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            
             //RAM Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "RAM: <select name='ram'>"; 
            
           
            $singleComponent = getSingleComponents($ramCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //GPU Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "GPU: <select name='gpu'>";
            
            $singleComponent = getSingleComponents($gpuCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //MotherBoard Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "MotherBoard: <select name='motherBoard'>"; 
            
            
            $singleComponent = getSingleComponents($mbCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //OS Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Operating System: <select name='os'>"
                    ."<option value='-' name='-'>-</option>"; 
            
            
            $singleComponent = getSingleComponents($osCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Case Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Case: <select name='case'>"; 
            
            
            $singleComponent = getSingleComponents($csCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Extra elements
            
            $result.="</select>"
                    . "<h4>Additional Components</h4>";
            
            //Keyboard Segment
            $result .="<br/>"
                    . "Keyboard: <select name='keyboard'>"
                    ."<option value='-' name='-'>-</option>" ; 
            
            
            $singleComponent = getSingleComponents($kbCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Mouse Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Mouse: <select name='mouse'>"
                    ."<option value='-' name='-'>-</option>" ; 
            
            
            $singleComponent = getSingleComponents($msCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Monitor Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Monitor: <select name='monitor'>"
                    ."<option value='-' name='-'>-</option>" ; 
            
            
            $singleComponent = getSingleComponents($mnCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            
            $result .="</select>" 
                    ."<br/>"
                    . "<input type='submit' name='firstForm' value='Make order'>"
                    . "</form>";

            //TODO: Add total amount of selected components
            
            echo $result;
        }
        
        function phoneForm()
        {
            
            $scCode = "CP_PH_SC";
            $cpuCode = "CP_PH_CPU";
            $ramCode = "CP_PH_RAM";
            $hdCode = "CP_PH_HD";
            $gpuCode="CP_PH_GPU";
            $bdCode="CP_PH_BD";
            $osCode="CP_PH_OS";
            $fcCode="CP_PH_FASTCHARGING";
            $hpCode="CP_PH_JACK";
            $nfcCode="CP_PH_NFC";
            $cmCode="CP_PH_CM";
            $usbCode="CP_PH_USB";
            $wrCode="CP_PH_WIRELESS";
            $frCode="CP_PH_FINGER";
            $btCode="CP_PH_BT";
            
            //Screen Segment
            $result = "<h2>Select your Phone Components</h2>"
                    ."<form action='newProduct.php' method='POST'>"
                    . "Screen: <select name='screen'>";

            
            
            $singleComponent = getSingleComponents($scCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //CPU Hardrive Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "CPU: <select name='cpu'>";
            
            $singleComponent = getSingleComponents($cpuCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
             //RAM Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "RAM: <select name='ram'>"; 
            
           
            $singleComponent = getSingleComponents($ramCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
             //HD Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Storage: <select name='hd'>"; 
            
           
            $singleComponent = getSingleComponents($hdCode);     
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //GPU Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "GPU: <select name='gpu'>";
            
            $singleComponent = getSingleComponents($gpuCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Camera Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Camera: <select name='camera'>";
            
            $singleComponent = getSingleComponents($cmCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Baterry Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Battery: <select name='battery'>";
            
            $singleComponent = getSingleComponents($btCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //USB Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "USB: <select name='usb'>";
            
            $singleComponent = getSingleComponents($usbCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Body Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Body: <select name='body'>";
            
            $singleComponent = getSingleComponents($bdCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //OS Segment
            $result .="</select>"
                    ."<br/>"
                    ."<br/>"
                    . "Operating System: <select name='os'>";
            
            $singleComponent = getSingleComponents($osCode); 
            for ($i = 0; $i < sizeof($singleComponent); $i++) {
                $result .= "<option value='" . $singleComponent[$i][0] . "'>" . $singleComponent[$i][0] . " - $". $singleComponent[$i][1]."</option>";
            }
            
            //Extra Components
            $result.="</select>"
                    . "<h4>Additional Components</h4>";
            
            $result .="<br/>" 
                    ."Fast Charging? ($". getSingleComponents($fcCode)[0][1].")<input type='checkbox' name='fcharging' value='fchargin'><br/><br/>"
                    ."Headphone Jack? ($". getSingleComponents($hpCode)[0][1].")<input type='checkbox' name='headphone' value='headphone'><br/><br/>"
                    ."NFC? ($". getSingleComponents($nfcCode)[0][1].")<input type='checkbox' name='nfc' value='nfc'><br/><br/>"
                    ."Wireless Charging? ($". getSingleComponents($wrCode)[0][1].")<input type='checkbox' name='wireless' value='wireless'><br/><br/>"
                    ."Fingerprint Reader? ($". getSingleComponents($frCode)[0][1].")<input type='checkbox' name='finger' value='finger'><br/><br/>";
            
            $result .="<input type='submit' name='firstForm' value='Make order'>"
                    . "</form>";
            
            
            
            echo $result;
            
            
        }
        
        //TODO: Figure out a way to display all Prebuilt product effectively (not with a select, maybe like on php test)
        function productForm()
        {
            $pbCode="PB";
            
            $products = getSingleComponents($pbCode);
            
            $result = "<h2>Select your Products</h2>";
            
            echo $result;
        }

        //Gets all of the components in the DB
        function getAllComponents() {

            $con = createConnection();
            $sentencia = "SELECT * FROM products";
            $query = mysqli_query($con, $sentencia);

            if ($query) {

                $i = 0;
                /*
                 * We only get the name and the price, if we also get the stock
                 * there may be another order currenty in progress.
                 */
                while ($raw_Components = mysqli_fetch_array($query)) {
                    $result[$i][0] = $raw_Components["name"];
                    $result[$i][1] = $raw_Components["price"];
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

        //Gets a particular component depending on the code given as parameter variable

        function getSingleComponents($code) {
            $result = [];
            global $components;
            $j=0;
            for($i=0;$i<sizeof($components);$i++)
            {
                  if(strpos($components[$i][0],$code)!==false)
                  {
                      $result[$j][0]=substr($components[$i][0],6);
                      $result[$j][1]=$components[$i][1];
                      $j++;
                  }
            }
            
            return $result;
        }
        
        
        
        ?>

        <div>

            <a href="index.php"><p>Insert Logo Here</p></a>

        </div>

        <div>

            <a href="login.php"><p>Login/Register</p></a>

        </div>

        <!--
        This div is to select the components of the product (see document Vision de la apliacion)
        for reference.
        -->
        <div>

            <section>
                
                <?php
                
                if (isset($_POST['computer'])) {
                      computerForm();
                }
                else if (isset($_POST['phone']))
                {
                      phoneForm();
                }
                else
                {
                    productForm();
                }
        
                
                ?>
                
                
            </section>


        </div>
        
        <br/>

        <footer>Legal stuff goes here</footer>

    </body>
</html>
