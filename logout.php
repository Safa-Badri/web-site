<?php session_start();
session_destroy();
session_start();
$_SESSION['success']="vous etes deconnectes.A bientot";
header('location:index.php');
?>