<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
if(!isset($_SESSION))
    sec_session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Portfolio</title>
        <!-- Bootstrap Core CSS -->
        <link href="styles/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="styles/agency.css" rel="stylesheet">
         <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    </head>
    <body>
    <?php if (login_check($mysqli) == true) : {?>
            
            <body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Start Currency Exchange</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="portfolio.php">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="request.php">Request</a>

                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="Updated_Rate.php">Rate</a>
                    </li>
                    <li>
                        <a href="includes/process_logout.php">Logout</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                
                <div class="intro-heading">Your Portfolio</div>
                
            </div>
        </div>
    </header>

<aside class="clients">
        <div class="container">
          <div class="row"></div>
        </div>
    </aside>
 
<fieldset>
<legend><div class = "table1">
	<table width = 10 height = 400 border = 1 align= center >
		<tr><td>your name</td>
			<td>target name</td>
			<td>your location</td>
			<td>target location</td>
			<td>currency you own</td>
			<td>currency you want</td>
			<td>minimal rate</td>
			<td>target max rate</td>
			<td>target min rate</td>
			<td>currency you own</td>
			<td>currency target own</td>
		</tr>
	<?php
	$username = $_SESSION['username'];
	$prep_stmt = "SELECT userA, userB, locationA, locationB, curneedB, curneedA, minA, maxB, minB, amountA, amountB FROM Record WHERE userA = ?";
	$stmt = $mysqli -> prepare($prep_stmt);
	if($stmt){
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$result = $stmt->bind_result($userA, $userB, $locationA, $locationB, $curneedB, $curneedA, $minA, $maxB, $minB, $amountA, $amountB);
		while($stmt->fetch()){
	?>
		<tr>
			<td><?php echo $userA?></td>
			<td><?php echo $userB?></td>
			<td><?php echo $locationA?></td>
			<td><?php echo $locationB?></td>
			<td><?php echo $curneedB?></td>
			<td><?php echo $curneedA?></td>
			<td><?php echo $minA?></td>
			<td><?php echo $maxB?></td>
			<td><?php echo $minB?></td>
			<td><?php echo $amountA?></td>
			<td><?php echo $amountB?></td>
		</tr>


		<?php
            }
        }
    }
        ?>
    </table>
</div>
<br><br>
    <table align = center>
    <tr>
        <td>
    <input type = "button" value = "confirm" />
        </td>
    </tr>
    </table>
	<!--footer-->
   	<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Currency Exchange Platform 2014</span>
                </div>
                
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                        <li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>