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



$query = new ParseQuery("Doctor");


$query->equalTo("Speciality", "Orthopedics");




$results = $query->find();


echo "Successfully retrieved " . count($results) . " records.";
// Do something with the returned ParseObject values

for ($i = 0; $i < count($results); $i++) {

  $object = $results[$i];

  $queryLoc = new ParseQuery("Location");

  $queryLoc->equalTo("Id", $object->LocationId);  

  $resultsLoc = $queryLoc->find();

for ($j = 0; $j < count($resultsLoc); $j++) {

  echo $object->getObjectId() . ' - ' . $object->get('Name').$object->get('Speciality').$object->get('Gender').$resultsLoc[$j]->get('PlaceName');

}

}




?>