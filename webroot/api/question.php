<?php

if ($_POST['questionId']) {
	$QUESTION_ID = $_POST['questionId'];
}

if ($_POST['answerId']) {
	$ANSWER_ID = $_POST['answerId'];
}

$USER_ID = 'obama';

/** include the watt quiz services */
require_once('wattquiz.php');

// set your app id and app key
$wq = new wattquiz(array(
  'debug'   => true,                // Debug mode echos API Url & POST data if set to true (Optional)
));

// make the getQuestion call
$question = $wq->getQuestion(array(
  'answeredCorrectly' => false,
  'previousQuestionId'=> $QUESTION_ID,         // Unique ID for the previous question (Optional)
  'userId'            => $USER_ID              // ID of the user answering the question (Required)
));

// Send the JSON back
echo json_encode($question);

?>