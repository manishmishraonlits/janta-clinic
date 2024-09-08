<?php
session_start();
unset($_SESSION['loggedinadmin']);  
header("Location: dashboard.php"); 
exit;