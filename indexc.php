<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Zero Hour Service</title>
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









<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAA_YWMaF4ZxRzCSaQUcRmdRxTd8Ha8_oCv-7Sib4zQXVdy3eGdMxQdLMhmPchY_fZO1KJIrc9pJkiXdA" type="text/javascript"></script>
    <script type="text/javascript">

   var map = null;
    var geocoder = null;
    var currentContent = null;


    function initialize() {
      if (GBrowserIsCompatible()) {


        map = new GMap2(document.getElementById("googleMap"));
		navigator.geolocation.getCurrentPosition(function (position) {
		initialLocation = new GLatLng(position.coords.latitude, position.coords.longitude);
		map.setCenter(initialLocation,13);
		
		/*var blueIcon = new GIcon(G_DEFAULT_ICON);
		blueIcon.image = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
		markerOptions = { icon:blueIcon };*/
		
		map.clearOverlays();
		map.addOverlay(new GMarker(initialLocation));
		
		 document.getElementById("lat").value = position.coords.latitude;
		 document.getElementById("long").value = position.coords.longitude;


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
		
		 });
		 
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        geocoder = new GClientGeocoder();
		
		
            // add an event listener
        GEvent.addListener(map, "click", function(marker, point) {
          if (marker) {
	    	 marker.setMap(null) ;
          } else {
            map.clearOverlays();
            map.addOverlay(new GMarker(point));
			document.getElementById("lat").value = point.lat();
			document.getElementById("long").value = point.lng();
			
          }

          document.getElementById("message").innerHTML = point.toString();
          // get and append the values inthe text box
          currentContent = document.mymap.points.value;
          document.mymap.points.value = currentContent + "new GLatLng" + point.toString() + "," + "\n";
        });
      }
    }

    function showAddress(address) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
              map.setCenter(point, 13);
              var marker = new GMarker(point);
              map.addOverlay(marker);
              marker.openInfoWindowHtml(address);
			  document.getElementById("lat").value = point.lat();
			  document.getElementById("long").value = point.lng();
			  
            }
          }
        );
      }
    }


    </script>










<!-- Mega Menu -->
</head>
<body   onload="initialize()" onUnload="GUnload()" >
<!-- banner -->
	<div class="header" >
		<div class="container" >
			<div class="logo" style="margin-top: -0.8%;">
				<p style="color: white; font-size: 1.9em; margin-left: -10px; margin-top: 10px;" > DocKnock </p>
			</div>
			<form  method="POST" action="search.php" autocomplete="on">
			<div class="header-left" style="margin-top: -0.8%; ">

								

								<li> <div class="search" style="height:20%;margin-right:10px;">
								<form action="#" onSubmit="showAddress(this.address.value); return false" name="mymap">
        							<input type="text" size="60" name="address" id="address"  placeholder="e.g 1600 Amphitheatre Pky, Mountain View, CA"/>
								<input type="submit" value=""/> 
								</form>
								</div>
								</li>
 
								
								<li ><div class="section_room" style="width: 100%;  ">
							
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
				<div class="clearfix"></div>
		</div>
	</div>

<!--
	<div class="header-bottom"  >
		<div class="container" >
			<div class="top-nav" >
				<span class="menu" > </span>
					<ul class="navig megamenu skyblue" >
						<li><a href="location.html" class="scroll"><span> </span> Find Locations</a>
							<div class="megapanel" >
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
						
						<li> <span class="service"> </span><div class="search">
						<form action="#" onSubmit="showAddress(this.address.value); return false" name="mymap">
        					<input type="text" size="60" name="address"  placeholder="e.g 1600 Amphitheatre Pky, Mountain View, CA"/>
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
-->
	
	<div class="banner" >
	<div id='googleMap'  align="center" style="
        height: 600px;
        width: 100%; margin-left:0%; border:thick; border-bottom-color:#000000; margin-bottom:2%; "></div>
</div>
	
		</div>

<!-- 
		<div class="banner-info">
		<div class="container">
			<div class="reservation">
				<form  method="POST" action="search.php" autocomplete="on">
				<ul>	
					<li class="boo">
						
					<label><b></b></label><input type="text" name="s_latitude"   placeholder="Latitude" style="width:100px;" required autofocus id="lat" />

					<label><b></b></label> <input type="text" name="s_longitude"   placeholder="Longitude" style="width:100px;" required autofocus  id = "long"/>



						<div class="clearfix"></div>						
					</li>					  
					<li class="boo">
						<div class="section_room">
								<select name="s_gender">
								<option value="Both" selected="selected">Both</option>
								<option value="M">Male</option>
								<option value="F">Female</option>
							
								</select>
							</div>	
						<div class="clearfix"></div>
					</li>
					<li class="span1_of_1">
						
							<div class="section_room">
								<select name="s_type">
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
							</div>	
					</li>
					<li class="span1_of_3">
						<div class="date_btn">
							
								<input type="submit" value="Search ">
							</form>
						</div>
					</li>
						<div class="clearfix"></div>
				</ul>
			</div>
		</div>
		</div>
-->
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
				<p>123, street name</p>
				<p>	landmark,</p>
				<p>	California 123</p>
				<p>	Tel: 123-456-7890</p>
				<p>	Fax. +123-456-7890</p>
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