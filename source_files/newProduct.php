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
        

        function firstForm() {

            $hdCode = "CP_HD";
            $ramCode = "CP_RAM";
            $mbCode = "CP_MB";
            $cpuCode = "CP_CPU";
            $gpuCode="CP_GPU";
            $osCode="CP_OS";
            $csCode="CP_CS";
            $msCode="PB_MS";
            $mnCode="PB_MN";
            $kbCode="PB_KB";
            
            //Hardrive Segment
            $result = "<form action='newProduct.php' method='POST'>"
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
                    . "GPU: <select name='cgpu'>";
            
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
            
            //TODO: Add OS Option
            
            $result .="</select>" 
                    ."<br/>"
                    . "<input type='submit' name='firstForm' value='Next'>"
                    . "</form>";

            //TODO: Add total amount of selected components
            
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
                      $result[$j][0]=substr($components[$i][0],3);
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

            <!--
                TODO: This might change depending on the product that we chose previously
            -->
            <h2>Select your products</h2>

            <section>
                
                <?php
                
                if (!isset($_POST['firstForm'])) {
                      firstForm();
              }
        
                
                ?>
                
                
            </section>


        </div>
        
        <br/>

        <footer>Legal stuff goes here</footer>

    </body>
</html>
