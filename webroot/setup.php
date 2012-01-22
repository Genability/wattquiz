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
			    'questionText' => 'Which team will win tomorrow?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 5,
			    'broughtBy' => 'Acme questions',
			    'answerTip' => 'In the winter months, people use more electricity to heat their homes!',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Patriots', 'answerRank' => 4),
			        array('answerId' => 'b','answerValue' => 'Giants', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => 'Ravens', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => '49ers', 'answerRank' => 1),
			        )
			);

$question3 = array(
			    'questionId' => 3, 
			    'questionText' => 'Who will win the super bowl?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 7,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'You know this man!',			    
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


