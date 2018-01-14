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
        
        function firstForm()
        {
        	
        
        	$result="<form action='newProduct.php' method='POST'>"
                     ."<select name='hd'>";
             
             for($j=0;$j< sizeof($components);$j++)
                 {
                     $result.="<option value='".$components[$j]."'>".$components[$j]."</option>";
                 }
            $result.="<br>"
                     . "<input type='submit' name='firstForm' value='Enviar'>"
                     ."</form>";
           
           echo $result;
        
        }
        
        
        //Gets all of the components in the DB
        function getAllComponents()
        {
        
        	$con = createConnection();
        	$sentencia = "SELECT * FROM products";
                $query = mysqli_query($con, $sentencia);
        
        	if($query)
            {

                $i=0;
                
                while($raw_Components = mysqli_fetch_array($query))
                {
                    $result[$i] = $raw_Components["name"];
                    $i++;
                }
                
                mysqli_free_result($query);
                mysqli_close($con);
                
            }
            else
            {
                mysqli_close($con);
                die("ERROR: No se ha podido ejecutar la sentencia");
            }
            
            
            return $result;

        }
        
        //Only gets the HDs in the components vector (components have the code CP and the HDs HD example: CP_HDxxxx)
        
        function getHDs()
        {
        
        
        
        
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
            
            <section></section>

            
        </div>
        
        <footer>Legal stuff goes here</footer>
        
    </body>
</html>
