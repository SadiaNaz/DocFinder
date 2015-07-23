<?php


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

$gameScore = new ParseObject("GameScore");

$gameScore->set("score", 1337);
$gameScore->set("playerName", "Sean Plott");
$gameScore->set("cheatMode", false);

try {
  $gameScore->save();
  echo 'New object created with objectId: ' . $gameScore->getObjectId();
} catch (ParseException $ex) {  
  // Execute any logic that should take place if the save fails.
  // error is a ParseException object with an error code and message.
  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}







$query = new ParseQuery("GameScore");
$query->equalTo("playerName", "Sean Plott");
$results = $query->find();
echo "Successfully retrieved " . count($results) . " scores.";
// Do something with the returned ParseObject values
for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];
  echo $object->getObjectId() . ' - ' . $object->get('playerName');
}


$query = new ParseQuery("Location");

$doctorQuery = new ParseQuery("Doctor");
$doctorQuery->equalTo("LocationId", 1);
$userQuery = new ParseQuery("Location");
$userQuery->matchesKeyInQuery("LocationId", "Id", $doctorQuery);
$results = $userQuery->find();


for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];
  echo "<br>";
  echo $object->getObjectId() . ' - ' . $object->get('Id');
}



?>