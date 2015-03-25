<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
?>

<!Doctype html>

Hello <?php $_SESSION['username'];?>