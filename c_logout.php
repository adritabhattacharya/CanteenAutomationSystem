<?php
session_start();
unset($_SESSION['customer']);
header('location:cus_login.php');
?>