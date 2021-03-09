<?php
session_start();
unset($_SESSION['admin']);
header('location:admin_login.php');
?>