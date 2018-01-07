<?php

	function createConnection()
        {
            $con = mysqli_connect("localhost","grupopa0_admin","admin");
            if(!$con)
            {
                die("ERROR: Can't connect to host");
            }
            $db = mysqli_select_db($con,"grupopa0_db");
            
            if(!$db)
            {
                die("ERROR: Can't connect to DB ");
            }
            return $con;
        }



?>