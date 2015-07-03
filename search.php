<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
      #legend {
        background: #FFF;
        padding: 10px;
        margin: 5px;
        font-size: 12px;
        font-family: Arial, sans-serif;
		margin-top:3%;
		margin-right:-7%;
      }
	  #legend h3{
	  		font-size:20px;
	  }
	  ul{
	  display: table;
	  margin-left: 0;
	  padding-left: 0;
	  list-style: none;
	  }
	
	li{
	  	display: table-row;
	  	&:before;
		content: "•";
		display: table-cell;
		padding-right: 0.4em;
	}
    </style>
	
<?php
date_default_timezone_set('Africa/Lagos');
$type = $_POST["s_type"];
$lon = $_POST["s_longitude"];
$lat = $_POST["s_latitude"];
$gender = $_POST["s_gender"];
$value=json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&sensor=false"));
?>



<script
src="http://maps.googleapis.com/maps/api/js">
<link href="/apis/fusiontables/docs/samples/style/default.css"
        rel="stylesheet" type="text/css">
</script>
    <script type="text/javascript">

    var geocoder = null;
    var currentContent = null;
    var map = null;
	var ind = 0;
	var lat = <?php echo $lat ?>;
	var lon = <?php echo $lon ?>;
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();
	var HomeMarker = null;
	var myLatlng = null;
  	infowindow = new google.maps.InfoWindow();
	var Homeinfowindow = new google.maps.InfoWindow({
      content: "Your Location"
  	});
	var markerPts = [];
	var markerCont = [];
	var dist = [];
	var ind1 = 0;
	
	function initialize() {
	  myLatlng = new google.maps.LatLng(lat,lon);
	  var mapOptions = {
		zoom: 10,
		center: myLatlng
	  }
	  map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
	  directionsDisplay.setMap(map);
	   var layer = new google.maps.FusionTablesLayer({
          query: {
            select: 'Location',
            from: '1NIVOZxrr-uoXhpWSQH2YJzY5aWhkRZW0bWhfZw'
          },
          map: map
        });
		
        // Create the legend and display on the map
        var legend = document.createElement('div');
        legend.id = 'legend';
        var content = [];
        content.push('<h3>Marker Colors</h3>');
        content.push('<p><img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png" >Your Location</p>');
        content.push('<p><img src="http://maps.google.com/mapfiles/ms/icons/blue-dot.png" >Closest Doctor</p>');
        content.push('<p><img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" >Other Doctors</p>');
        
        legend.innerHTML = content.join('');
        legend.index = 1;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(legend);

	  //var image = 'beachflag.png';
	  HomeMarker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  title: 'Home position',
		  icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
	  });
	  
		document.getElementById("lat").value = <?=$lat ?>;
		document.getElementById("long").value = <?=$lon ?>;
		document.getElementById("address").value = <?= "'".$value->results[0]->formatted_address."'" ?>
	  
	  /*
  geocode = new google.maps.Geocoder();
  latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  geocode.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        
 	document.getElementById("address").value = results[1].formatted_address;


      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
  });
		
*/		
    	geocoder = new google.maps.Geocoder();
	  
	  google.maps.event.addListener(HomeMarker, 'click', function() {
			infowindow.setContent('Your Location');
			infowindow.open(map, this);
		  });
	  
	  /*google.maps.event.addListener(map, "click", function(event) {
		
		var lat = event.latLng.lat();
		var lng = event.latLng.lng();
		
		document.getElementById("lat").value = lat;
		document.getElementById("long").value = lng;
		
		myLatlng = new google.maps.LatLng(lat,lng);
	    HomeMarker.setOptions({
                position: myLatlng
          }); 
	  });*/
	  
	  
	}
	
	function addMarker(latt,long,place){
		var chk = 0;
		var index = -1;
		
		var str =  place.substr(place.indexOf(">")+1);
		for(i=0; i<markerCont.length; i++){
			var str1 = markerCont[i].substr(markerCont[i].indexOf(">")+1);
			if(str1  == str){
				chk =1;
				index = i;
				break;
			}
		}
		
		if(chk == 0){
			var Latlng = new google.maps.LatLng(latt,long);
			marker = new google.maps.Marker({
				  position: Latlng,
				  map: map,
				  title: place,
				  icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
			 });
			calcDistance(Latlng);
			 markerPts.push(marker);
			 markerCont.push(place); 
			 google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(place);
				infowindow.open(map, this);
			  });
		  }
		  else{
		  	var content =  markerCont[index].substr(0,markerCont[index].indexOf("<")) + ", " +  place.substr(0,place.indexOf("<")) + markerCont[i].substr(markerCont[i].indexOf("<"));
		  	google.maps.event.addListener(markerPts[i], 'click', function() {
				infowindow.setContent(content);
				infowindow.open(map, this);
			  });
			  
			  markerCont[index] = content;
			
		  }
	}
	
	function calcRoute(end) {
	
	  var request = {
		  origin:myLatlng,
		  destination:end,
		  travelMode: google.maps.TravelMode.DRIVING
	  };
	  directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			//alert('abcd');
		  directionsDisplay.setDirections(response);
		}
	  });
	}
	
	function calcDistance(end) {
	
	  var request = {
		  origin:myLatlng,
		  destination:end,
		  travelMode: google.maps.TravelMode.DRIVING
	  };
	  directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			var distanc = response.routes[0].legs[0].distance.value/1000;
		 	document.getElementById(('distance' + ind1)).innerHTML = distanc;	
			ind1++; //Counter for List IDs
			dist.push(distanc);		
		}
	  });
	}
	
	
	function doneAdding(){/*
		markerPts[0].setOptions({
			  icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
          }); 
		  calcRoute(markerPts[0].getPosition());*/
		  var ind = 0;
		  var minima = dist[0];
		  for(i=0; i<dist.length; i++){
			if(minima > dist[i]){
				ind = i;
				minima = dist[i]; }
		  }
		  
		  markerPts[ind].setOptions({
			  icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
          }); 
		  calcRoute(markerPts[ind].getPosition());
	}
	
   function showAddress(address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      	if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			HomeMarker.setOptions({
                position: results[0].geometry.location
          		}); 
			
			document.getElementById("lat").value = results[0].geometry.location.lat();
			document.getElementById("long").value = results[0].geometry.location.lng();
			document.getElementById("address").value = address;
			
			clearMarkers();
          	}
			else {
        		alert('Geocode was not successful for the following reason: ' + status);
      		}
	  	 });
    }
	
	function clearMarkers()
	{
		if(markerPts)
		{
			for(i in markerPts)
			{
				markerPts[i].setMap(null);
			}
			markerPts = [];
			markerCont = [];
		}
	}

//function writeText(){
//    form.points.value = clickPoint;
//    form.textarea.value = "hello world";
//}

</script>
	

<title>My Doctor Finder</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script src="js/jquery.min.js"></script>
<!-- Mega Menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>











<!-- Mega Menu -->
</head>
<body onUnload="GUnload()" >
<!-- banner -->
	<div class="header">
		<div class="container">
			<div class="logo" style="margin-top: -0.8%;">
				<p style="color: white; font-size: 1.9em; margin-left: -10px; margin-top: 10px;" > DocKnock </p>
			</div>
			
			<div class="header-left" style="margin-top: -0.8%; ">

								

								<li> <div class="search" style="height:20%;margin-right:10px;">
								<form action="#" onSubmit="showAddress(this.address.value); return false" name="mymap">
        							<input type="text" size="60" name="address" id="address"  placeholder="e.g 1600 Amphitheatre Pky, Mountain View, CA"/>
								<input type="submit" value=""/> 
								</form>
								</div>
								</li>
 
								
								<li ><div class="section_room" style="width: 100%;  ">
							
							<form  method="POST" action="search.php" autocomplete="on">
								<p style=" color: white;  ">Latitude </p><input type="text" name="s_latitude"   placeholder="Latitude" required autofocus id="lat" />
				
								</div></li>

								<li><div class="section_room" style="width:  100%; " >
				
								<p style=" color: white; ">Longitude </p> <input type="text" name="s_longitude"   placeholder="Longitude"  required autofocus  id = "long"/>
							
								</div></li>
								
								
								<li><div class="section_room" style="border-left:1px solid #000; border-color:#1568b1;">
								<p style=" color: white; ">Gender </p>
								<select name="s_gender" >
								<option value="Both" selected="selected">Both</option>
								<option value="M">Male</option>
								<option value="F">Female</option>
							
								</select>
								</div></li>

								<li><div class="section_room" style="">
								<p style=" color: white; ">Doctor Type </p>
								<select name="s_type" >
								<option value="All" selected="selected">All</option>
								<option value="Allergist">Allergist</option>
								<option value="Anesthesiologist">Anesthesiologist</option>
								<option value="Cardiologist">Cardiologist</option>
								<option value="Dentist">Dentist</option>
								<option value="Dermatologist">Dermatologist</option>
								<option value="ENT Specialist">ENT Specialist</option>
								<option value="Epidemiologist">Epidemiologist</option>
								<option value="Gynecologist">Gynecologist</option>
								<option value="Microbiologist">Microbiologist</option>
								<option value="Neurologist">Neurologist</option>
								<option value="Neurosurgeon">Neurosurgeon</option>
								<option value="Oncologist">Oncologist</option>
								<option value="Orthopedics">Orthopedics</option>
								<option value="Physiologist">Physiologist</option>
								<option value="Psychiatrist">Psychiatrist</option>
								<option value="Radiologist">Radiologist</option>
								<option value="Urologist">Urologist</option>
								</select>
								</div></li>


								<li><div class="date_btn" style="width: 100%;">
							
								<input type="submit" value="Search ">
								
								</div></li>
								



			</div>
			</form>
		<!--	<div class="header-left">
				<li a="" href="#"><div class="drop-down">
							<select class="d-arrow">
								<option value="Eng">Our Network</option>
								<option value="Fren">versions</option>
								<option value="Russ">variations</option>
								<option value="Chin">Internet</option>
							</select>
								</div></li>
			</div>
				<div class="clearfix"></div> -->
		</div>
	</div>
	<!-- <div class="header-bottom">
		<div class="container">
			<div class="top-nav">
				<span class="menu"> </span>
					<ul class="navig megamenu skyblue">
						<li><a href="location.html" class="scroll"><span> </span> Find Locations</a>
							<div class="megapanel">
								<div class="na-left">
									<ul class="grid-img-list">
										<li><a href="location.html">Find a Location  </a></li> |
										<li><a href="addlocation.html">Add a location </a></li> |
										<li><a href="location.html"> Review a location  </a></li> |
										<li><a href="location.html">Review a location</a></li>
										<div class="clearfix"> </div>	
									</ul>
								</div>
								<div class="na-right">
									<ul class="grid-img-list">
										<li><a href="login.html">Login Here or</a></li>
										<li class="reg">
											<form action="register.html">
												<input type="submit" value="Register">
											</form>
										</li>
										<div class="clearfix"> </div>	
									</ul>
								</div>
								<div class="clearfix"> </div>	
		    				</div>
						</li>
						<li><a href="404.html" class="scroll"> <span class="service"> </span>Our Species</a></li>						
						<li>
					
						
					
						</li>
						
						<li> <span class="service"> </span><div class="search" >
						<form action="#" onSubmit="showAddress(this.address.value); return false" name="mymap" >
        					<input type="text"  style=" margin-top: -1%;" size="60" name="address" id="address"  placeholder="e.g 1600 Amphitheatre Pky, Mountain View, CA"/>
							<input type="submit" value=""/> 
						</form>
						</div>
						</li>

						<div class="clearfix"></div>
					</ul>
					<script>
					$("span.menu").click(function(){
						$(".top-nav ul").slideToggle(300, function(){
						});
					});
				</script>
			</div>
			<div class="head-right">
				<ul class="number">
					<li><a href="login.html"><i class="roc"> </i>My Account</a></li>
					<li><a href="register.html"><i class="phone"> </i>Sign Up</a></li>
					<li><a href="contact.html"><i class="mail"> </i>Contact</a></li>	
						<div class="clearfix"> </div>						
				</ul>
			</div>
			<div class="clearfix"> </div>	
		</div>
	</div>
	!-->
	<div class="banner" >
	<div id='googleMap'  align="center" style="
        height: 600px;
        width: 100%; margin-left:0%; border:thick; border-bottom-color:#000000; margin-bottom:2%; "></div>
	</div>
		
	
		
	<div class="loc-lov">
		<div class="container">
			
			<div class="loc-right">
			
				<div class="loc-bottom" style="margin-top:00px;">
					<h3>List of Doctors</h3>
					<p>Sorted by Distance</p>
					<div class="air">
						<li class="mullet"><b></b></li>
						<li class="wicked"><b>Name</b></li>
						<li class="iew"><b>Type</b></li>
						<li class="st" ><b>Location</b></li>
						<li class="iew"><b>Distance(KM)</b></li>
						<li class="iew"><b>Contact</b></li>
						</div>
				<?php
				
				
				$servername = "localhost";
				$username = "root";
				$password = "1234";$connection = mysql_connect("localhost","root","4321");
					if(!$connection){
						die("Cannot Connect to DB". mysql_error());
					}
				
				
							
				mysql_select_db("test");
				$result = 0;
				
				if(($type == 'All')&&($gender == 'Both')){
					
					$result = mysql_query("SELECT ( 6371 * acos( cos( radians($lat) ) * cos( radians( l.Longitude ) ) * cos( radians( l.Latitude ) - 	radians($lon) ) + sin( radians($lat) ) * sin( radians( l.Longitude ) ) ) ) AS res, d.Name,d.Gender,d.Type,d.Contact,l.PlaceName,l.City,l.Latitude,l.Longitude FROM doctor d,Location l where d.LocationId = l.Id order by res,d.Type,d.Name")
					or die(mysql_error()); 
				}
				else if($type == 'All'){
					$result = mysql_query("SELECT ( 6371 * acos( cos( radians($lat) ) * cos( radians( l.Longitude ) ) * cos( radians( l.Latitude ) - 	radians($lon) ) + sin( radians($lat) ) * sin( radians( l.Longitude ) ) ) ) AS res, d.Name,d.Gender,d.Type,d.Contact,l.PlaceName,l.City,l.Latitude,l.Longitude FROM doctor d,Location l where d.LocationId = l.Id and d.Gender = '$gender'  order by res,d.Type,d.Name")
					or die(mysql_error());  
				}
				else if($gender == 'Both'){
					$result = mysql_query("SELECT ( 6371 * acos( cos( radians($lat) ) * cos( radians( l.Longitude ) ) * cos( radians( l.Latitude ) - 	radians($lon) ) + sin( radians($lat) ) * sin( radians( l.Longitude ) ) ) ) AS res, d.Name,d.Gender,d.Type,d.Contact,l.PlaceName,l.City,l.Latitude,l.Longitude FROM doctor d,Location l where d.LocationId = l.Id and  d.Type = '$type' order by res,d.Type,d.Name")
					or die(mysql_error());  
				}
				else{
					$result = mysql_query("SELECT ( 6371 * acos( cos( radians($lat) ) * cos( radians( l.Longitude ) ) * cos( radians( l.Latitude ) - 	radians($lon) ) + sin( radians($lat) ) * sin( radians( l.Longitude ) ) ) ) AS res, d.Name,d.Gender,d.Type,d.Contact,l.PlaceName,l.City,l.Latitude,l.Longitude FROM doctor d,Location l where d.LocationId = l.Id and d.Gender = '$gender' and d.Type = '$type' order by res,d.Type,d.Name")
					or die(mysql_error());  
				}
				
				
				if(is_null($result)){
				
					echo "No Results Found";
				}
				else{
				
						?>
						
						<?php
						echo  "<script>initialize()</script>";
						$idArr = [];
						$len = mysql_num_rows($result);
						
						if($len == 0)
							echo "No Results Found";
						
						for($i =0; $i < $len; $i++){
							$idArr[$i] = 'distance'.$i;
						}

						$place = "";
						$ind = 0;
						while($row = mysql_fetch_array( $result ))
						{
							echo "<div class='ball'>";
							
							echo "<li class='mullet'>";
							if($row['Gender'] == 'M'){
								?><img src="images/male.png" width="10px" height="15px" align="middle" >
								<?php echo "</li>";
							}
							else
							{
								?><img src="images/female.png" width="15px" height="15px" align="middle">
								<?php echo "</li>";
							}
							echo "<li class='wicked'> Dr. ".$row['Name']."</li>" ;
							
							//echo "<li class='mullet'>".$row['Gender']."</li>";
							echo "<li class='iew' style='text-align: left; margin-left: 20px;' >".$row['Type']."</li>";
							echo "<li class='st' style='text-align: left;'>".$row['PlaceName']. ", ". $row['City']."</li>";
							echo "<li class='iew'  id=".$idArr[$ind].">".round($row['res'],2)."</li>";
							echo "<li class='iew'>".$row['Contact']."</li>";
							$place = "Dr. ".$row['Name'] ."<br>".$row['PlaceName']. ", ". $row['City'];
							
							$ind = $ind + 1;
							echo "</div>";
							?>
							<script>
							 addMarker(<?php echo $row['Longitude']  ?>,<?php echo $row['Latitude']  ?>, <?= "'".$place."'" ?>);
							</script>
							
							<?php
						}
							?>
							<script>
								doneAdding();
							</script>
							<?php
					}
						
					mysql_free_result($result);
				echo"</div>";
				
				?>
					
				</div>
			</div>
				<div class="clearfix"></div>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<div class="col-md-2 abo-foo1">
				<h5>About Us</h5>
					<ul>
						<li><a href="about.html">About us</a></li>
						<li><a href="#">Who started it</a></li>
						<li><a href="#">how to help</a></li>
					</ul>
			</div>
			<div class="col-md-3 abo-foo">
				<h5>Account Information</h5>
					<ul>
						<li><a href="login.html">How to login</a></li>
						<li><a href="register.html">Create an account</a></li>
						<li><a href="login.html">Logout</a></li>
						<li><a href="register.html">Join us</a></li>
					</ul>
			</div>
			<div class="col-md-2 abo-foo1">
				<h5>Location</h5>
				<p>LMK Resources Pakistan(Pvt) Ltd </p>
				<p>	9th Floor, Ufone Tower, Jinnah Avenue,</p>
				<p>	Islamabad</p>
			</div>
			<div class="col-md-2 abo-foo1">
			<h5>Agreements</h5>
			<ul>
				<li><a href="#">Legal agreement</a></li>
				<li><a href="#">Model release (adult)</a></li>
				<li><a href="#">Model release (Minor)</a></li>
				<li><a href="#">Property Release</a></li>
			</ul>
		</div>
			<div class="col-md-3 abo-foo">
				<li a="" href="#">
					<div class="drop-down1">
						<select class="d-arrow">
							<option value="Eng">Our Network</option>
								<option value="Fren">versions</option>
								<option value="Russ">variations</option>
								<option value="Chin">Internet</option>
						</select>
					</div>
				</li>
			</div>
				<div class="clearfix"></div>
			<div class="footer-bottom">
				
			</div>
		</div>
	</div>
	

</body>
</html>