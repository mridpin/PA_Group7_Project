<?php
// Destroys the session of the user and seamlessly returns to index
session_start();
session_unset($_SESSION["user"]);
session_destroy();
header("Location: index.php");
?>