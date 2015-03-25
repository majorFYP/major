<?php

include_once 'db_connect.php';
include_once 'functions.php';

//to secure by PHP session
if(!isset($_SESSION))
	sec_session_start();

if (isset($_POST['username'],$_POST['p'])){
	$username = $_POST['username'];
	$password = $_POST['p'];
	if(login($username, $password, $mysqli )){
		header('Location: ../request.php');
	} else{
		if(checkbrute($username,$mysqli) == true)
			header('Location: ../index.php?error=2');
		header('Location: ../index.php?error=1');
	}
}else{
	echo 'Invalid Request';
}
