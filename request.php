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
        <script language="JavaScript">
        function preset(){
            var curown = document.converter.curown.value;
            var curneed = document.converter.curneed.value;
            var cur1 = 0;
            var cur2 = 0;
            switch (curown){
                case "USD" :
                    cur1 = 0;
                    break;
                case "EUR" :
                    cur1 = 1;
                    break;
                case "CAD" :
                    cur1 = 2;
                    break;
                case "GBP" :
                    cur1 = 3;
                    break;
                case "HKD" :
                    cur1 = 4;
                    break;
                case "TWD" :
                    cur1 = 5;
                    break;
                case "MYR" :
                    cur1 = 6;
                    break;
                case "CNY" :
                    cur1 = 7;
                    break;
                case "PHP" :
                    cur1 = 8;
                    break;
                case "THB" :
                    cur1 = 9;
                    break;
                default : 
                    cur1 = 0;
                    break; 
            }

            switch (curneed){
                case "USD" :
                    cur2 = 0;
                    break;
                case "EUR" :
                    cur2 = 1;
                    break;
                case "CAD" :
                    cur2 = 2;
                    break;
                case "GBP" :
                    cur2 = 3;
                    break;
                case "HKD" :
                    cur2 = 4;
                    break;
                case "TWD" :
                    cur2 = 5;
                    break;
                case "MYR" :
                    cur2 = 6;
                    break;
                case "CNY" :
                    cur2 = 7;
                    break;
                case "PHP" :
                    cur2 = 8;
                    break;
                case "THB" :
                    cur2 = 9;
                    break;
                default : 
                    cur2 = 0;
                    break; 
            }

            var USDarray = [1,0.8, 1.13 ,0.64 ,7.76, 30.85 ,3.35 ,6.14 ,44.97 ,32.82];
            document.converter.maxrate.value = USDarray[cur2] / USDarray[cur1];
            document.converter.minrate.value = USDarray[cur2] / USDarray[cur1];
            
        }
        
        function dollarConverter(){
        document.converter.maxresult.value = document.converter.amount.value * document.converter.maxrate.value;
        document.converter.minresult.value = document.converter.amount.value * document.converter.minrate.value;        
        }
        </script>
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            
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
                <div class="intro-lead-in">Welcome To Our Website!</div>
                <div class="intro-heading">It's Nice To Meet You</div>
                <a href="#services" class="page-scroll btn btn-xl">Tell Me More</a>
            </div>
        </div>
    </header>

    <!-- Services Section --><!-- Portfolio Grid Section --><!-- About Section --><!-- Team Section --><!-- Clients Aside -->

        

    <form name="converter" action = "includes/exchange.php" method="post" >
        <div class="converter">
    <!--<form name="form1" method="post" >-->
<fieldset>
<legend>

<table width = "900" >
<tr>
<td width = "300" valign = top>
<label>Currency I have :<br> 
<select name="curown" onchange="preset()">
  <option value="USD" selected>USD美元</option>
  <option value="EUR">EUR歐元</option>
  <option value="CAD">CAD加拿大元</option>
  <option value="GBP">GBP英鎊</option>
  <option value="HKD">HKD港元</option>
  <option value="TWD">TWD台灣幣</option>
  <option value="MYR">MYR馬來西亞幣</option>
  <option value="CNY">CNY人民幣</option>
  <option value="PHP">PHP英律賓披索</option>
  <option value="THP">THB泰國銖</option>
  
</select>
</label>

  <label>Amount : <br>
  <input type="text" name="amount" id="amount">
  </label>
  <label>Currency I want :<br> 
    <select name="curneed" onchange="preset()">
        <option value="USD">USD美元</option>
        <option value="EUR">EUR歐元</option>
        <option value="CAD">CAD加拿大元</option>
        <option value="GBP">GBP英鎊</option>
        <option value="HKD" selected>HKD港元</option>
        <option value="TWD">TWD台灣幣</option>
        <option value="MYR">MYR馬來西亞幣</option>
        <option value="CNY">CNY人民幣</option>
        <option value="PHP">PHP英律賓披索</option>
        <option value="THP">THB泰國銖</option>
    </select>
    </label>
</td>

<td width = "300" valign = top>
  

    <label>Expected Rate (max) : (1 : ?)<br></label>
    <input type="text" name="maxrate" id="maxrate" />

    <label>Expected Rate (min) : (1 : ?)<br></label>
    <input type="text" name="minrate" id="minrate" />
</td>

<td width = "300" valign = top>
    <label>Expected Amount (max) : </label>
<input type="text" name="maxresult" />
<label>Expected Amount (min) : </label>
<input type="text" name="minresult" />
<p></p>
<input type="button" value="Convert!" onclick="dollarConverter()"/>
</td>
</tr>
</table>


<table width ="500">
    <tr>
        <td width="500" align = right>
    <label>
    <input type="submit" name="Submit" value="Submit">
    </label>
  </td>
</tr>
</div>
</table>
</form>
</fieldset>

    
<!--    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>-->

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
            <p><h2>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </h2></p>
        <?php endif; ?>
    </body>
</html>