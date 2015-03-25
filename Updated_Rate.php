<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
if(!isset($_SESSION))
    sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap Core CSS -->
        <link href="styles/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="styles/agency.css" rel="stylesheet">
         <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
       
            
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
                
                <div class="intro-heading">Today Rate!</div>
                <div class="intro-lead-in">Rates are for reference only!</div>
                
            </div>
        </div>
    </header>

    <body>
    <div class ="table1" align = center>
    	<table >
    		<tr>
    			<td>Currency<br /></td>
    			<td>Rate<br>1USD:?CUR</td>
    		</tr>
    		<tr>
    			<td>EUR歐元</td>
    			<td> 0.8 </td>
    		</tr>
    		<tr>
    			<td>CAD加拿大元</td>
    			<td> 1.13 </td>
    		</tr>
    		<tr>
    			<td>GBP英鎊</td>
    			<td> 0.64 </td>
    		</tr>
    		<tr>
    			<td>HKD港元</td>
    			<td>7.76</td>
    		</tr>
    		<tr>
    			<td>TWD台灣幣</td>
    			<td> 31.05 </td>
    		</tr>
    		<tr>
    			<td>MYR馬來西亞幣</td>
    			<td> 3.43 </td>
    		</tr>
    		<tr>
    			<td>CNY人民幣</td>
    			<td> 6.15 </td>
    		</tr>
    		<tr>
    			<td>PHP英律賓披索</td>
    			<td> 44.82 </td>
    		</tr>
    		<tr>
    			<td>THB泰國銖</td>
    			<td> 32.78 </td>
    		</tr>
    	</table>
    </div>
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


     