<?php
//contact -> Number
//location -> Hospital
//Qualification
//Images type=File

date_default_timezone_set('Africa/Lagos');

$app_id="bWBg10fbvRRs1E6DLjSTQNVoctDfp5UU7oZXNaNx";


$rest_key="Q5v87W4z4C0j6yO7tzrPoAuaWQt3GYWuoYxn2Mox";
$master_key="9i46pyKHaPkRiN0LFFerOjbczve7tnZjIt4ISn6K";

require 'autoload.php';
Parse\ParseClient::initialize( $app_id, $rest_key, $master_key );


use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;


class Doctor {
       public $name = "";
       public $type  = "";
       public $gender = "";
       public $location = "";
	   public $schedule = "";
	   public $qualifications = "";
   }
   
   // $datetime= '2015-07-20T00:00';

    $datetime= $_POST["datetime"];
	$pieces = explode("T", $datetime );
	$date = $pieces[0];
	$time = ((float)($pieces[1][0].$pieces[1][1])*100) + (float)($pieces[1][3].$pieces[1][4]);
	
	$form = 1;
//	$formNum = $_POST["formNum"];
	$type = $_POST["docType"]; 
	$gender = "Both";
	$results = "";
	//$type= "a";
	if($form == 1){
	
		//$gender = "Both";
		//$type = "Urology";  //Not Needed for Now
		//$type ="Eye Specialist / Ophthalmologist";
		if ($type == "Plastic ") $type = "Plastic & Burn Surgeon";
		else	if ($type == "General ") $type = "General & Laparoscopic Surgeons";
        else	if ($type == "Anesthesia ") $type = "Anesthesia & Intensive Care";
	
		//echo $type;
		//$type = Eye Specialist / Ophthalmology;
		//$type  = "Plastic & Burn Surgeon";
		$query = new ParseQuery("DoctorsTable");
		
		if($gender != "Both")	$query->equalTo("Gender", $gender);
		
		if($type != "All")	$query->equalTo("Job", $type);

		$results = $query->find();
	}
	else{
		$gender = 'Both';
		$type = "Radiologist";
		
		$query = new ParseQuery("Doctor");

		if($type != "All")	$query->equalTo("Job", $type);

		$results = $query->find();
	}
//	$day = "Mon";
//	$time = 0;
	echo recordSetToJson($results,$date,$time);


				
function recordSetToJson($results,$date,$time) { //Converts the result set into JSON row by row - return type: Array
	$resultsArr = array();
	//$date = '2015-07-20';
	//$date = str_replace('/', '-', $date);
	$dt = strtotime($date);
	$day = date("D", $dt);
	//echo "Dayyyyyyyyyyy".$day;
	//echo "ewdde Date".date('d-m-Y', strtotime($date));
	for ($i = 0; $i < count($results); $i++) {

	  $object = $results[$i];

	  
		  $d = new Doctor();
		  $d->name = $object->get('Name');
		  $d->type = $object->get('Job');
		  $d->gender = $object->get('Gender');
		  $d->location = $object->get('Hospital');
		  $d->schedule = $object->get('Scehdule');
		  $d->qualifications = $object->get('Qualifications');
		  $profilePhoto = $object->get("Images");
		  $d->photoUrl = $profilePhoto->getUrl();
		    $pieces = explode("/", $d->schedule );
			$isValid = 0;
			for ($j = 0; $j < sizeof($pieces )-1; $j++){
				
				if  ( $pieces[$j][0] == $day[0] &&  $pieces[$j][1] == $day[1]){
					$snum = (float)$pieces[$j][4];
					if($pieces[$j][9] == 'P'){
						$snum = 12 + (float)$pieces[$j][4];
					}
					$snum = ($snum*100) + (float)($pieces[$j][6].$pieces[$j][7]) ;
					
					$fnum = (float)$pieces[$j][12];
					if($pieces[$j][17] == 'P'){
						$fnum = 12 + (float)$pieces[$j][12];
					}
					$fnum = ($fnum*100) + (float)($pieces[$j][14].$pieces[$j][15]) ;
					
					
					//echo $snum."  ".$fnum;
					if($fnum < $snum){
						if(($time < $fnum && $time <= $snum) || ($time > $fnum && $time >= $snum)) $isValid = 1;
					}
					else {
						if($time < $fnum && $time >= $snum)  $isValid = 1;
						
					}
					
					
				}
			}
			
			if($isValid ==1)
		  $resultsArr[] = $d;

	//	  echo $d->photoUrl;
	//	 echo $profilePhoto->getUrl();		  
	//	echo "<img src=$d->photoUrl style='width:7%;height:10%;border-radius: 40%' />";
		  
		
	}
	return json_encode($resultsArr,JSON_UNESCAPED_SLASHES);
 
} 


?>