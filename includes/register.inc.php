<?php
include_once 'db_connect.php' ;
include_once 'psl-config.php' ;

$error_msg = "";



if(isset($_POST['username'], $_POST['email'], $_POST['p'], $_POST['location'])){
	//validation
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
	//check password
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		$error_msg .= '<p class= "error">The email address entered is not valid</p>';
	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	//check password configuration
	if(strlen($password) != 128)
		$error_msg .= '<p class="error">Invalid password configuration. Please try it again.</p>';
	//check existing email
	$prep_stmt = "SELECT user_id FROM User_info WHERE email = ? LIMIT 1";
	$stmt = $mysqli -> prepare ($prep_stmt);
	if ($stmt){
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows == 1){
			$error_msg .= '<p class="error"> The email address already exists.</p>';
			//$stmt->close();
		}
		//$stmt->close();
	}else{
		$error_msg .= '<p class= "error"> Database error Line 36 </p>';
	}
	$prep_stmt = "SELECT user_id FROM User_info WHERE username = ? LIMIT 1";
	$stmt = $mysqli->prepare($prep_stmt);

	if($stmt){
		$stmt -> bind_param('s', $username);
		$stmt -> execute();
		$stmt -> store_result();
		if ($stmt->num_rows == 1 ){
			$error_msg .= '<p class="error">The username has already existed</p>';
			//$stmt->close();	
		}
		//$stmt->close();
	} else{
		$error_msg .= '<p class="error">Database error line 51</p>';
	}
	if(empty($error_msg)){
		// create a salt
		$random_salt = hash('sha512', uniqid(mt_rand(1,mt_getrandmax()),true));

		$password = hash('sha512', $password . $random_salt);

		if($insert_stmt = $mysqli->prepare("INSERT INTO User_info (username, password, email, location, salt) VALUES (?,?,?,?,?)")){
			$insert_stmt->bind_param('sssss', $username, $password, $email, $location, $random_salt );
			if(! $insert_stmt->execute()){
				header('Location: ../error.php?err=Registration failure: INSERT');

			}
		}
		header('Location: ./register_success.php');
	}
	
}