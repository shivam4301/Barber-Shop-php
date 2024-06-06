<?php  
session_start();
session_destroy();
echo "Logging out...";
header("refresh:1; url=../index.php");
?>