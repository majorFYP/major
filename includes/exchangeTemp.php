<?php
include_once 'db_connect.php';
include_once 'functions.php';
if(!isset($_SESSION))
    sec_session_start();


if(isset($_POST['name'], $_POST['Lat'], $_POST['curown'], $_POST['amount'], $_POST['curneed'], $_POST['maxrate'],$_POST['minrate'],$_POST['maxresult'],$_POST['minresult'])){
    $username = $_POST['name'];
    $lat = $_POST['Lat'];
    $lon = $_POST['Lon'];
    $curown = $_POST['curown'];
    $curneed = $_POST['curneed'];
    $amount = $_POST['amount'];
    $maxrate = $_POST['maxrate'];
    $minrate = $_POST['minrate'];
    $maxresult = $_POST['maxresult'];
    $minresult = $_POST['minresult'];
    if($insert_stmt = $mysqli->prepare("INSERT INTO RequestWithLocation (name, lat, lon, curown, curneed, amount, maxrate, minrate, maxresult, minresult ) VALUES (?,?,?,?,?,?,?,?,?,?)")){
            $insert_stmt->bind_param('sddssiddii', $username, $lat, $lon, $curown, $curneed, $amount, $maxrate, $minrate, $maxresult, $minresult);
            if(! $insert_stmt->execute()){
                header('Location: ../error.php?err=Request Failure: INSERT');

            }
        
         header('Location: ../geolocation2.php');}
}else{
    header('Location: ../error.php?err=Session fault: INSERT');
}
    
?>