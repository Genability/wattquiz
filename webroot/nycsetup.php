<?
/** Seed Genability Mongo Database */

phpinfo();

// assumes connection to local database 

// connect
$m = new Mongo();

// select a database
$db = $m->wattquiz;


$userCollection = $db->wattUser;
// $response = $userCollection->drop();

// select a collection (analogous to a relational database's table)
$collection = $db->question;
// $response = $collection->drop();
print_r($response);


$question9 = array(
			    'questionId' => 9, 
			    'questionText' => 'Is New York City one of the top 10 greenest cities in the United States?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
			    'city' => 'New York',
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Try again',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Yes', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => 'No', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => ' It depends on who you ask and what criteria are used.', 'answerRank' => 1)
			        )
			);


$question10 = array(
			    'questionId' => 10, 
			    'questionText' => 'Is New York City one of the top 10 solar power producing states in America?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
  			    'city' => 'New York',
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Try again',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Yes', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => 'No', 'answerRank' => 2)
			        )
			);



$question11 = array(
			    'questionId' => 11, 
			    'questionText' => 'What percentage of NYC homes use solar heating?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 1,
  			    'city' => 'New York',			   
			    'broughtBy' => 'CTO of USA',
			    'answerTip' => 'It\'s not that high',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '10%', 'answerRank' => 3),
			        array('answerId' => 'b','answerValue' => '1%', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => '0.1%', 'answerRank' => 4),
			        array('answerId' => 'd','answerValue' => '0.01%', 'answerRank' => 1)
			        )
			);

$question12 = array(
			    'questionId' => 12, 
			    'questionText' => 'What is peak electric demand?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 2,
  			    'city' => 'New York',			    
			    'broughtBy' => 'Acme questions',
			    'answerTip' => 'Peak demand is when the demand on the grid is at its highest.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Peak demand is the largest number of kilowatts a customer uses in a given month.', 'answerRank' => 3),
			        array('answerId' => 'b','answerValue' => 'Peak demand occurs when maximum power is being consumed simultaneously by customers on the electricity grid. ', 'answerRank' => 1),
			        array('answerId' => 'c','answerValue' => 'Peak demand is when a utility company buys electricity from another company.', 'answerRank' => 2),
			        array('answerId' => 'd','answerValue' => 'Peak demand is a term used to describe when a transmission has burned out.', 'answerRank' => 4)
			        )
			);

$question13 = array(
			    'questionId' => 13, 
			    'questionText' => 'When does peak electric demand typically occur?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
  			    'city' => 'New York',			    
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Air conditioners can put a large strain on the grid.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'On weekdays during the afternoon.', 'answerRank' => 1),
			        array('answerId' => 'b','answerValue' => 'On weekdays during the evening.', 'answerRank' => 2),
			        array('answerId' => 'c','answerValue' => 'On weekends during the afternoon.', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => 'On weekends during the evening.', 'answerRank' => 4)
			        )
			);

$question14 = array(
			    'questionId' => 14, 
			    'questionText' => 'On a hot, summer day in NYC, when does peak electric demand typically occur?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
  			    'city' => 'New York',			    
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Air conditioners can put a large strain on the grid.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'Between 9 a.m. and noon', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => 'Between noon and 3 p.m.', 'answerRank' => 1),
			        array('answerId' => 'c','answerValue' => 'Between 3 p.m. and 6 p.m.', 'answerRank' => 3),
			        array('answerId' => 'd','answerValue' => 'Between 6 p.m. and 9 p.m.', 'answerRank' => 4)
			        )
			);


$question15 = array(
			    'questionId' => 15, 
			    'questionText' => 'How many trips are made on public transportation on a typical weekday in NYC?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
  			    'city' => 'New York',			    
			    'broughtBy' => 'Genability',
			    'answerTip' => 'It\s more than the population of the city.',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '30,000', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => '500,000', 'answerRank' => 3),
			        array('answerId' => 'c','answerValue' => '5,000,000', 'answerRank' => 4),
			        array('answerId' => 'd','answerValue' => '13,303,000', 'answerRank' => 1)
			        )
			);			

$question16 = array(
			    'questionId' => 16, 
			    'questionText' => 'What percentage of NYC residents recycle?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
  			    'city' => 'New York',			    
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Try again',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '27%', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => '48%', 'answerRank' => 3),
			        array('answerId' => 'c','answerValue' => '68%', 'answerRank' => 1),
			        array('answerId' => 'd','answerValue' => '82%', 'answerRank' => 4)
			        )
			);
			
$question17 = array(
			    'questionId' => 17, 
			    'questionText' => 'Manhattan, NY (10019, 10022, 10017) has the highest average commercial electricity consumption in the New York city area.  ConEd is the utility serving this area.  What are the primary plans they offer for commercial service?',
			    'questionType' => 'multi-choice',
			    'wattValue' => 3,
  			    'city' => 'New York',			    
			    'broughtBy' => 'Genability',
			    'answerTip' => 'Try again',			    
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => 'General Small', 'answerRank' => 2),
			        array('answerId' => 'b','answerValue' => 'General Large', 'answerRank' => 3),
			        array('answerId' => 'c','answerValue' => 'All of the above', 'answerRank' => 1)
			        )
			);


				
print_r("<br/>inserting new records");

$collection->insert($question9);
$collection->insert($question10);
$collection->insert($question11);
$collection->insert($question12);
$collection->insert($question13);
$collection->insert($question14);
$collection->insert($question15);
$collection->insert($question16);
$collection->insert($question17);

// put index on wattUser
//$collection.ensureIndex(array('userId' => 1), array('unique' => true));

?>


