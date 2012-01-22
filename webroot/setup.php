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
			    'broughtBy' => 'Executive Office',
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
			    'answerTip' => 'Green button is modelled after Blue Button but for details your energy use.',			    
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
			    'questionId' => 4, 
			    'questionText' => 'Which Utility services your location?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Turning off heating and air conditionining when you\'re at work will save money on time of use based plans.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Consolidated Edison Co-NY Inc', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => 'Pacific Gas and Electric', 'answerRank' => 1),
			        array('answerId' => 'c','answerValue' => 'New York Energy Savings Corp.', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => 'Clay Electric Cooperative, Inc', 'answerRank' => 4)
			        )
			);


$question5 = array(
			    'questionId' => 5, 
			    'questionText' => 'What was your total consumption last month?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Consumption rises in the winter months',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '0-50 kWh', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => '50-200 kWh', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => '200-500 kWh', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => '500-1000 kWh', 'answerRank' => 4)
			        )
			);

$question6 = array(
			    'questionId' => 6, 
			    'questionText' => 'What was your monthly electricity bill last month?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Your consumption went down during business hours.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '0-50 kWh', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => '50-200 kWh', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => '200-500 kWh', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => '500-1000 kWh', 'answerRank' => 4)
			        )
			);

$question7 = array(
			    'questionId' => 7, 
			    'questionText' => 'What was your monthly electricity bill last month?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Your consumption went down during business hours.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '0-$30 kWh', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => '$30-$40 kWh', 'answerRank' => 1),
			        array('answerId' => 'c','answerValue' => '$40-$50 kWh', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => '$50+ ', 'answerRank' => 4)
			        )
			);

$question8 = array(
			    'questionId' => 8, 
			    'questionText' => 'True or False: Would you save money by switching to a time of use rate plan?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Your consumption went down during business hours.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'True', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => 'False', 'answerRank' => 2)
			        )
			);			

$question9 = array(
			    'questionId' => 9, 
			    'questionText' => 'Who will win the super bowl this year?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'broughtBy' => 'San Francisco 49ers',
			    'answerTip' => 'Your consumption went down during business hours.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'New York Giants', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => 'San Francisco 49ers', 'answerRank' => 1),
			        array('answerId' => 'c','answerValue' => 'Baltimore Ravens', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => 'New England Patriots', 'answerRank' => 4)
			        )
			);

				
print_r("<br/>insterting new records");

$collection->insert($question1);
$collection->insert($question2);
$collection->insert($question3);
$collection->insert($question4);
$collection->insert($question5);
$collection->insert($question6);
$collection->insert($question7);
$collection->insert($question8);
$collection->insert($question9);


// put index on wattUser
//$collection.ensureIndex(array('userId' => 1), array('unique' => true));

?>


