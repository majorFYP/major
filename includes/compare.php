<?php

include_once 'db_connect.php';
include_once 'functions.php';
if(!isset($_SESSION))
	sec_session_start();

$stmt = $mysqli->prepare("SELECT A.username, B.username ,A.amount, B.amount, A.location, B.location, A.curneed, B.curneed, A.minrate, B.rmaxrate, B.rminrate From `Request` as A, `Request` as B Where A.curown = B.curneed and A.curneed = B.curown and A.status = 'waiting' and B.status = 'waiting' and A.maxrate>= B.rminrate and B.maxrate>= A.rminrate");
if($stmt){
	$stmt->execute(); 
	$stmt->store_result();
	$stmt->bind_result($userA, $userB, $amountA, $amountB, $locationA, $locationB, $curneedB, $curneedA, $minrateA, $rmaxrateB, $rminrateB);
	while($stmt->fetch()){
	echo" $userA, $userB, $amountA, $amountB, $locationA, $locationB, $curneedB, $curneedA, $minrateA, $rmaxrateB, $rminrateB ";
	$mysqli->query("INSERT INTO Record(userA, userB, locationA, locationB, curneedB, curneedA, minA, maxB, minB, amountA, amountB) values ('$userA','$userB', '$locationA','$locationB','$curneedB','$curneedA','$minrateA','$rmaxrateB','$rminrateB','$amountA','$amountB')");
	
	$mysqli->query("UPDATE Request SET status ='processing'  Where username ='$userA' and amount = 
	'$amountA' and curneed = '$curneedA' and curown ='$curneedB'");
	}
}else {
	echo"SORRY!";
}