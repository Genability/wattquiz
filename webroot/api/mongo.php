<?
/** include the Genability PHP Library */
// MIHLE: make sure to mongo.so in the right directory and add 'extension=mongo.so' to PHP.ini file located in /etc
/**  phpinfo();  **/



class wattquiz_mongo {


	/**
	 * Save answer to Mongo
	 */
	function saveAnswer($params) {

		
		
	} // end of saveAnswer method


	/**
	 * get question from Mongo
	 */
	function getQuestion($questionId) {

			$findQuestionId = '1';
			$question = array('questionId' => $findQuestionId, 
			    'questionText' => 'Who will win the superbowl',
			    'questionType' => 'multi-choice',
			    'wattValue' => 1,
			    'broughtBy' => 'Genability',
			    'answers' => array(
			        array('answerId' => 'a','answerValue' => '49ers'),
			        array('answerId' => 'b','answerValue' => '49ers'),
			        array('answerId' => 'c','answerValue' => '49ers'),
			        array('answerId' => 'd','answerValue' => '49ers')
			        )
			);
    
		return $question;

	} // end of getQuestion method
	

	/**
	 * Get Answers from Mongo
	 */
	function getAnswers($params) {

		
		
	} // end of getAnswers method


	function updateMongo($collectionName, $collection){
		// assumes connection to local database 
		$m = new Mongo();

		// select a database
		$db = $m->wattquiz;

		// select a collection (analogous to a relational database's table)
		$collection = $db->questions;

		// add a record 
		$obj = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson" );
		$collection->insert($obj);

		// add another record, with a different "shape"
		$obj = array( "title" => "XKCD", "online" => true );
		$collection->insert($obj);

		// find everything in the collection
		$cursor = $collection->find();

		// iterate through the results
		foreach ($cursor as $obj) {
		    echo $obj["title"] . "\n";
		}
	}

}






?>


