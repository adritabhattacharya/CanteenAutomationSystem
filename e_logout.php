<?php
session_start();
unset($_SESSION['employee']);
header('location:emp_login.php');
?>