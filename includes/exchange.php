<?php
include_once 'db_connect.php';
include_once 'functions.php';
if(!isset($_SESSION))
    sec_session_start();

if(isset($_POST['curown'], $_POST['amount'], $_POST['curneed'], $_POST['maxrate'],$_POST['minrate'],$_POST['maxresult'],$_POST['minresult'])){
    $username= $_SESSION['username'];
    $stmt = $mysqli->prepare("SELECT location FROM User_info WHERE username = ? LIMIT 1");
    if($stmt){
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $stmt->store_result();
        if($stmt -> num_rows == 1){
            $stmt->bind_result($location);
            $stmt->fetch();
        }
    }
    $curown = $_POST['curown'];
    $curneed = $_POST['curneed'];
    $amount = $_POST['amount'];
    $maxrate = $_POST['maxrate'];
    $minrate = $_POST['minrate'];
    $rmaxrate = 1.0 / $minrate;
    $rminrate = 1.0 / $maxrate;
    $maxresult = $_POST['maxresult'];
    $minresult = $_POST['minresult'];
    $status = "waiting";
    if($insert_stmt = $mysqli->prepare("INSERT INTO Request (username, location, curown, curneed, amount, maxrate, minrate, rmaxrate, rminrate, maxresult, minresult, status ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)")){
            $insert_stmt->bind_param('ssssiddddiis', $username, $location, $curown, $curneed, $amount,$maxrate, $minrate, $rmaxrate, $rminrate, $maxresult, $minresult, $status);
            if(! $insert_stmt->execute()){
                header('Location: ../error.php?err=Request Failure: INSERT');
            }
    }
    header('Location: ../request.php');
}else{
    header('Location: ../error.php?err=Session fault: INSERT');
}
