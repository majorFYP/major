<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Secure Login : Registration Form</title>
		<script type="text/JavaScript" src="js/sha512.js"></script>
		<script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/style.css" />
	</head>
	<body>
		<div class="container">
			<section class="register">
		<!-- Registration form to be output when POST variables not set yet-->
		<h1>Registration</h1>
		<?php
		if(!empty($error_msg)){
			echo $error_msg;
		}
		?>
		
		<form method = "post" name = "registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']);?>">
			<div class="reg_section personal_info">
				<h3>Your Personal Information</h3>
			<h3>Username:</h3><input type ='text' name = 'username' id = 'username' placeholder="Your Desired Username" /><br>
			<h3>Email:</h3><input type = "text" name = "email" id = "email" placeholder = "Your E-mail Address" /><br>
			<h3>Password:</h3> <input type = "password" name = "password" id = "password" placeholder = "Password" /><br>
			<h3>Confirm password:</h3> <input type = "password" name = "confirmpass" id = "confirmpass" placeholder = "Confirmed Password"/><br>
			<h3>Location:</h3> <input type = "text" name = "location" id = "location" placeholder = "Location" /><br>
			<input type = "button"
				value = "Register"
				onclick = "return regformhash(this.form,
											this.form.username,
											this.form.email,
											this.form.password,
											this.form.confirmpass,
											this.form.location);" />
		</form>
		</div>
		<p class="terms">
			<label>
			Passwords at least 6 CHARACTER<br>
			At least one UPPER CASE letter<br>
			At least one LOWER CASE letter
			At least one NUMBER
			</label>
		</p>
		<section class = "back"> Return to the <a href="index.php">login page</a>.</section>
		
	</body>

</html>