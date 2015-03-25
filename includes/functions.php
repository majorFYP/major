<?php

include_once 'psl-config.php';


function sec_session_start(){
	$session_name = 'sec_session_id';
	$secure = SECURE;
	$httponly = true;

	if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }

   $cookieParams = session_get_cookie_params();
   session_set_cookie_params($cookieParams["lifetime"],
   		$cookieParams["path"],
   		$cookieParams["domain"],
   		$secure,
   		$httponly);
   session_name($session_name);
   session_start();
   session_regenerate_id();
   
}

function login($username, $password,$mysqli){
	$prep_stmt = "SELECT user_id, password, salt FROM User_info WHERE username = ? LIMIT 1";
	$stmt = $mysqli -> prepare ($prep_stmt);
	if($stmt){
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($user_id, $db_password , $salt );
		$stmt->fetch();
		//hash the password
		$password = hash('sha512', $password . $salt);
		// see if the user acct existed
		if($stmt->num_rows == 1 ){
			//check user acct is locked
					
			if (checkbrute($username ,$mysqli) == true){
				return false;
			}
			else {
				//problem
				if (strcmp($db_password,$password) == 0 ){
					$user_browser = $_SERVER['HTTP_USER_AGENT'];
					//XSS protection
					$user_id = preg_replace("/[^0-9]+/","",$user_id);
					$_SESSION['user_id']= $user_id ;
					//XSS protection
					$user = $username;
					$username = preg_replace ("/[^0-9]+/","",$username);
					$_SESSION['username']= $user;
					$login_string= hash('sha512', $password . $user_browser);
					$_SESSION['login_string']= $login_string;
					if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string']))
						return true;
				}
				else{
				//wrong password
				$now = time();
				$mysqli->query("INSERT INTO login_attempts(user_name, time) values ('$username', '$now')");
				return false;
				}
			}
		}
		else{
			//wrong username
			return false;

		}
	}
}

function checkbrute($username, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_name = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('s', $username);
 	
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli){
	if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])){
		$user_id = $_SESSION['user_id'];
		$login_string = $_SESSION['login_string'];
		$username = $_SESSION['username'];
		$user_browser = $_SERVER['HTTP_USER_AGENT'];

		if($stmt = $mysqli->prepare("SELECT password FROM User_info WHERE username = ? LIMIT 1")){
			$stmt-> bind_param('s', $username);
			$stmt-> execute();
			$stmt-> store_result();
			if ($stmt -> num_rows == 1){
				//username exists
				$stmt-> bind_result($password);
				$stmt-> fetch();
				$login_check = hash ('sha512', $password . $user_browser);
				if (strcmp( $login_check , $login_string ) == 0){
					return true;
				}else{
					return false;
				}
				
			}else{
			//not correct username	
				return false;
			}	
		}
		else{
			return false;
		}
	}
	else{	
		//not set all the session
		return false;
	}	
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

?>