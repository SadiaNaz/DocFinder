<?php
date_default_timezone_set('Africa/Lagos');

$app_id="0vowIPPDvIl9dRt8bp8aJdLRByU7C1HTebd8bGV8";
$rest_key="7oigdPK1ooyO7vkZWg5lqnLQgXmGJiD6OYOtlbEJ";
$master_key="As27lE5nPzgTMJrYA5Fpyc5T9duavmYT257Qz7z3";

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
   }


	//$form = $_POST["form"];
	$results = "";
		$name = "NA";
		$gender = "Male";
		//$hospital = $_POST["hospital"];  //Not Needed for Now
		
		
		$query = new ParseQuery("Doctor");
		
		if($name != "NA")	$query->equalTo("Name", $name);
		if($gender != "Both")	$query->equalTo("Gender", $gender);
		
		$results = $query->find();
	
	echo recordSetToJson($results);


				
function recordSetToJson($results) { //Converts the result set into JSON row by row - return type: Array
	$resultsArr = array();
	for ($i = 0; $i < count($results); $i++) {

	  $object = $results[$i];

	  $queryLoc = new ParseQuery("Location");

	  $queryLoc->equalTo("Id", $object->LocationId);  

	  $resultsLoc = $queryLoc->find();

		for ($j = 0; $j < count($resultsLoc); $j++) {
		  $d = new Doctor();
		  $d->name = $object->get('Name');
		  $d->type = $object->get('Speciality');
		  $d->gender = $object->get('Gender');
		  $d->location = $resultsLoc[$j]->get('PlaceName')." ".$resultsLoc[$j]->get('City');
		  
		  $resultsArr[] = $d;
		}

	}
	return json_encode($resultsArr);
 
} 

?>