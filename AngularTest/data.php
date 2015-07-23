<?php

/*$str = ' {
	"hospitals":[
		{"name":"John", "age":5}, 
		{"name":"Anna", "age":55}, 
		{"name":"Peter","age":6}
	]
}';*/

//echo $str;

	$servername = "localhost";
	$username = "root";
	$password = "1234";$connection = mysql_connect("localhost","root","4321");
		if(!$connection){
			die("Cannot Connect to DB". mysql_error());
		}
	
	
				
	mysql_select_db("test");
	$result = 0;
	
	
	$form = $_POST["form"];
	$type = "";
	if($form == 1){
		$type = $_POST["docType"];
		$name = $_POST["name"];
		$gender = $_POST["gender"];
		$hospital = $_POST["hName"];
		
		if($gender == 'Both'){
			$result = mysql_query("SELECT d.Name,d.Gender,d.Type,d.Contact,l.PlaceName,l.City,l.Latitude,l.Longitude FROM doctor d,Location l where CONCAT_WS('l.PlaceName', ' ','l.City')  = '$hospital' order by l.PlaceName,d.Type,d.Name")
					or die(mysql_error()); 
		}
		else{
			$result = mysql_query("SELECT d.Name,d.Gender,d.Type,d.Contact,l.PlaceName,l.City,l.Latitude,l.Longitude FROM doctor d,Location l where d.Gender = '$gender' order by l.PlaceName,d.Type,d.Name")
					or die(mysql_error()); 
			
		}
		
	}
		
	else if($form == 2){
		
	}
	else if($form == 2){
		
	}
	

/* 	$lon = '73.057172';
	$lat = '33.7113772';
	$gender = 'Both';
	$type = 'All';
	
	
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
				
				 */
				if(is_null($result)){
				
					echo "No Results Found";
				}
				else{
					echo recordSetToJson($result);
				}
				
function recordSetToJson($mysql_result) {
 $rs = array();
 while($rs[] = mysql_fetch_assoc($mysql_result)) {
    // you don´t really need to do anything here.
  }
 return json_encode($rs);
}

?>