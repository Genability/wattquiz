<?
/** Seed Genability Mongo Database */

phpinfo();

// assumes connection to local database 

// connect
$m = new Mongo();

// select a database
$db = $m->wattquiz;


$userCollection = $db->wattUser;
$response = $userCollection->drop();


// select a collection (analogous to a relational database's table)
$collection = $db->question;
$response = $collection->drop();
print_r($response);

$collection = $db->question;

$question1 = array(
			    'questionId' => 1, 
			    'questionText' => 'Using 1008 kWh consumption this month, how much would you expect to pay for electricity in New York?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 1,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'In the winter months, people use more electricity to heat their homes!',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '$150-$250', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => '$250-$400', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => 'less than $150', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => 'over $400', 'answerRank' => 4),
			        )
			);

$question2 = array(
			    'questionId' => 2, 
			    'questionText' => 'If you don\'t expect to be home during business hours, would moving to a time of use rate plan make sense?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 2,
			    'broughtBy' => 'Acme questions',
			    'answerTip' => 'In the winter months, people use more electricity to heat their homes!',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Yes', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => 'No', 'answerRank' => 2)
			        )
			);

$question3 = array(
			    'questionId' => 3, 
			    'questionText' => 'Who will win the super bowl?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Turning off heating and air conditionining when you\'re away will save money on time of use based plans.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Ravens', 'answerRank' => 3),
			        array('answerId' => 'b','answerValue' => 'Giants', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => '49ers', 'answerRank' => 1),
			        array('answerId' => 'd','answerValue' => 'Patriots', 'answerRank' => 4),
			        )
			);

				
print_r("<br/>insterting new records");

$collection->insert($question1);
$collection->insert($question2);
$collection->insert($question3);

// put index on wattUser
//$collection.ensureIndex(array('userId' => 1), array('unique' => true));

?>


