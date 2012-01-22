<?php

/** include the watt quiz services */
require_once('wattquiz.php');

// set your app id and app key
$wq = new wattquiz(array(
  'debug'   => false,                // Debug mode echos API Url & POST data if set to true (Optional)
));


// make the getQuestion call
$user = $wq->getLeaderboard();

// Send the JSON back
echo json_encode($user);

?>
