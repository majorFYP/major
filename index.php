<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <?php if (login_check($mysqli) == false) : { ?>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="styles/style.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
         <div class="container">
        <section class="login">
        <?php if (isset($_GET['error'])): ?>
            <h2>Please check if you enter correct username and password</h2>
        
        <?php endif; ?>   
        <form action="includes/process_login.php" method="post" name="login_form"> 			
            <h3>Login Page</h3>
            <h1>Username: <input type="text" name="username" placeholder="Username" /></h1>
            <br>
            <h1>Password: <input type="password" 
                             name="password" 
                             id="password"
                             placeholder="password"/></h1>
                             <h1><br></h1>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
        <h1><br></h1>
        <h1>If you don't have account, please <a href="register.php">register</a></h1>
    </body>
    <?php }else: {?>
    <?php
    header('Location: request.php');
    }
    ?>

    <?php endif; ?>
</html>
