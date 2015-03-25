<?php
include_once 'functions.php';
if(!isset($_SESSION))
sec_session_start();

$_SESSION = array();
//get session parameters
$params = session_get_cookie_params();

setcookie(session_name(),
		'', time() - 42000,
		$params["path"],
		$params["domain"],
		$params["secure"],
		$params["httponly"]);

// destroy session
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
header('Location: ../index.php');



