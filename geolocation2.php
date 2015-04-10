<?php
include_once 'includes/db_connect.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        #map-canvas {
        height: 50%;
        width: 75%;
        float: bottom;
        margin: 5% 10%;
        padding: 20% 20%;
      }
        body{
            height: 100%;
            width: 100%;
            float: bottom;
            padding : 1% 0% 5% 0%;
        background: url(img/cat.jpg) no-repeat;
        background-size: 100% 100%;
        }
    </style>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCSEALn-fY-UJY3LF6aHoTe3fogVYSoE2A&signed_in=true"></script>
    <script language="JavaScript">
<!--
//function euroConverter(){
//document.converter.dollar.value = document.converter.euro.value * 2.88;
//}
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




//-->
</script>

    <script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

var map;
var tempLa, tempLo;
function initialize() {
  var mapOptions = {
    zoom: 15
  };
  
  
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

 
  
  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);
      tempLa = position.coords.latitude;
      tempLo = position.coords.longitude;
      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'You are here.'
      });


      document.converter.Lat.value = tempLa;
      document.converter.Lon.value = tempLo;
      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
<?php
    $stmt = $mysqli->prepare("SELECT name,Lat,Lon,Curown,Curneed,amount,maxrate,minrate,maxresult,minresult FROM RequestWithLocation");
    if($stmt){
        $stmt->execute();
        $stmt->store_result();
        if($stmt -> num_rows > 0){
                $stmt->bind_result($name,$Lat,$Lon,$curown,$curneed,$amonut,$maxrate,$minrate,$maxresult,$minresult);
                while($stmt->fetch()){
?>


    var Lon = <?php echo json_encode($Lon) ; ?>;
    var latit = <?php echo json_encode($Lat) ; ?> ;
    var curown = "<?php echo $curown ; ?> ";
    var curneed = "<?php echo $curneed ; ?> ";
    var name = "<?php echo $name ; ?> ";
    var maxrate = <?php echo json_encode($maxrate) ; ?> ;
    var minrate = <?php echo json_encode($minrate) ; ?> ;

    
    window.alert(name);
    var count = 0;
    //while (count < 3){
    var marker = new google.maps.Marker({
    //var pos = new google.maps.LatLng(22,114);
    position: {lat: latit ,lng: Lon },
    map: map,
    });
    
    marker.setMap(map);
    var infowindow = new google.maps.InfoWindow({
        content: '<p>Name: ' + name + '</p> <p> Has ' + curown + '</p> <p> To ' + curneed + ' </p> <p>' + maxrate + ' > rate > ' + minrate + '</p>'
    });

    
        infowindow.open(map, marker);

    //}
<?php
                }
            }
            //echo "<script type='text/javascript'>alert('$name');</script>";
        }
?>


  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }

}



function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="styles/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="styles/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
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
    <div id = "image"></div>
     <div id="map-canvas"></div>

     <form name="converter" action = "includes/exchangeTemp.php" method="post" >
        <div class="converter">
    <fieldset>
<legend>

<table width = "80%" height = "50px" >
    <tr>
    <td width = "50%" height = "50px" >
    <label>Lat : </label>
<input type="text" name="Lat" />
</td>
<td width = "50%" height = "50px" >
<label>Lon : </label>
<input type="text" name="Lon" />
<p></p>
</td>
</tr>
</table>

<table width = "80%" >
<tr>
    

    <td width style="25%" valign = top>
    <label>Name : <br></label>
    <input type = "text" name ="name" placeholder = "yourname" />
</td>
<td width = "25%" valign = top>
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
  <input type="text" name="amount" id="amount" placeholder = "amount">
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

<td width = "25%" valign = top>
  

    <label>Expected Rate (max) : (1 : ?)<br></label>
    <input type="text" name="maxrate" id="maxrate" />

    <label>Expected Rate (min) : (1 : ?)<br></label>
    <input type="text" name="minrate" id="minrate" />
</td>

<td width = "25%" valign = top>
    <label>Expected Amount (max) : </label>
<input type="text" name="maxresult" />
<label>Expected Amount (min) : </label>
<input type="text" name="minresult" />
<p></p>
<input type="button" value="Convert!" onclick="dollarConverter()"/>
</td>


</tr>
</table>


<table width ="80%" height = "100">
    <tr>
        <td width="1000" align = center>
    <label>
    <input type="submit" name="Submit" value="Submit">
    </label>
  </td>
</tr>
</div>
</table>
</form>
</fieldset>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Currency Exchange Platform 2015</span>
                </div>
                
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
  </body>
</html>