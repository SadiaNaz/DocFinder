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
	   public $qualifications = "";
	   public $schedule = "";
   }


	$form = 1;
//	$formNum = $_POST["formNum"];
	$results = "";
	
	if($form == 1){
		$type = "All";
		$gender = 'Both';

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

	echo recordSetToJson($results);


				
function recordSetToJson($results) { //Converts the result set into JSON row by row - return type: Array
	$resultsArr = array();
	for ($i = 0; $i < count($results); $i++) {

	  $object = $results[$i];

	  
		  $d = new Doctor();
		  $d->name = $object->get('Name');
		  $d->type = $object->get('Job');
		  $d->gender = $object->get('Gender');
		  $d->location = $object->get('Hospital');
		  $d->qualifications = $object->get('Qualifications');
		  if($object->get('Scehdule') == null)
			$d->schedule = "abcd";
		  $profilePhoto = $object->get("Images");
		  $d->photoUrl = $profilePhoto->getUrl();
		  
		  $resultsArr[] = $d;

	//	  echo $d->photoUrl;
	//	 echo $profilePhoto->getUrl();		  
	//	echo "<img src=$d->photoUrl style='width:7%;height:10%;border-radius: 40%' />";
		  
		
	}
	return json_encode($resultsArr,JSON_UNESCAPED_SLASHES);
 
} 


?>