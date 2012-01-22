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
			    'questionText' => 'Which government initiative allows consumers to download their detailed energy usage?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 1,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Green button is modelled after Blue Button but for details your energy use.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Blue Button', 'answerRank' => 3),
			        array('answerId' => 'b','answerValue' => 'Green Door', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => 'Green Button', 'answerRank' => 1),
			        array('answerId' => 'd','answerValue' => 'Green Start', 'answerRank' => 4),
			        )
			);

$question2 = array(
			    'questionId' => 2, 
			    'questionText' => 'Consumption is measured by:',
			    'questionType' => 'multi-choice',
			    'wattValue' => 2,
			    'broughtBy' => 'Acme questions',
			    'answerTip' => 'Consumption is measured over a time interval.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'killowatts', 'answerRank' => 3),
			        array('answerId' => 'b','answerValue' => 'megawatts', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => 'killowatts per hour', 'answerRank' => 1),
			        array('answerId' => 'd','answerValue' => 'megawatts per hour', 'answerRank' => 4),
			        )
			);

$question3 = array(
			    'questionId' => 3, 
			    'questionText' => 'True or False: Your cost of energy fluctuates during the day and changes at night?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Turning off heating and air conditionining when you\'re at work will save money on time of use based plans.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'True', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => 'False', 'answerRank' => 2)
			        )
			);

$question4 = array(
			    'questionId' => 3, 
			    'questionText' => 'Which Utility services your location?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Turning off heating and air conditionining when you\'re at work will save money on time of use based plans.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Consolidated Edison Co-NY Inc', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => 'Pacific Gas and Electric', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => 'New York Energy Savings Corp.', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => 'Clay Electric Cooperative, Inc', 'answerRank' => 4)
			        )
			);

				
print_r("<br/>insterting new records");

$collection->insert($question1);
$collection->insert($question2);
$collection->insert($question3);

// put index on wattUser
//$collection.ensureIndex(array('userId' => 1), array('unique' => true));

?>


