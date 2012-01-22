<?php

class wattquiz {
	

	/**
	 * Creates a new wattquiz object
	 *
	 *
	 */
	function __construct($config) {
		$this->params = array();

		// default configuration options
		$this->config = array_merge(
			array(
				'debug'         => '',
			),
			$config
		);
	}


	/**
	 * getQuestion gets you a question to answer
	 */
	function getQuestion($params) {

		if ($params['answeredCorrectly'] == true) {
			// get the next question from mongodb using the userId and the questionId
			$findQuestionId = '3';//$params['previousQuestionId'] + 1
			$question = array('answerResult' => true,
			    'answerTip' => 'You know your football',
			    'questionId' => $findQuestionId, 
			    'questionText' => 'Which team is the greatest',
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
		} else if ($params['answeredCorrectly'] == false) {
			// get the next question from mongodb using the userId and the questionId
			$findQuestionId = '3';//$params['previousQuestionId'] + 1
			$question = array('answerResult' => false,
			    'answerTip' => 'They are from the bay area',
				'questionId' => $findQuestionId, 
			    'questionText' => 'Which team is the greatest',
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
		} else if ($params['previousQuestionId']) {
			// get the next question from mongodb using the userId and the questionId
			$findQuestionId = '2';//params['previousQuestionId']
			$question = array('questionId' => $findQuestionId, 
			    'questionText' => 'Who will score first',
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
		} else {
			// get the first quesiton from mongodb
			$findQuestionId = '1';
			$question = getQuestion($params['userId'],null);
		}

		if ($this->config['debug']) { echo $question; }
		
		return $question;
		
	} // end of getQuestion method


	/**
	 * answerQuestion to submit an answer to a question
	 */
	function answerQuestion($params) {

        if ($params['answerId'] == "a") {
		    $correct = true;
		}
		else 
		{
			$correct = false;
		}
		
		$questionId = $params['questionId'];
		$userId = $params['userId'];
		
		//
		// Save the answer with the user.
		//
		//TODO

		// add another record, with a different "shape"
		$obj = array( "title" => "XKCD", "online" => true );
		$collection->insert($obj);
		
		// get the appropriate question
		$question = $this->getQuestion(array(
		  'answeredCorrectly' => $correct,            // whether they got it right or not
		  'previousQuestionId'=> $questionId,         // Unique ID for the previous question (Optional)
		  'userId'            => $userId              // ID of the user answering the question (Required)
		));
	
		
		if ($this->config['debug']) { echo $result; };
		
		return $question;
		
	} // end of answerQuestion method
	
	/**
	 * Get the user object with their information.
	 */
	function getUser($userId) {
		
		// connect
		$m = new Mongo();

		// select a database
		$db = $m->wattquiz;
		
		// find the user by their id
		$collection = $db->wattUser;
		$user = $collection->findOne(array('userId' => $userId));
		
		if($user == '') {
			$user = $this->_addUser($userId);
		}
		
		return $user;
		
	} // end of getUser

	function _addUser($userId) {
		
		// connect
		$m = new Mongo();

		// select a database
		$db = $m->wattquiz;

		$gravatarHash = md5( strtolower( trim( $userId ) ) );
		// then the URL is...
		//http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y
		
		$user = array(
//			'_id' => $userId,
			'userId' => $userId,
			'gravatarHash' => $gravatarHash,
			'questionsAnswered' => 0,
			'greenButtonCount' => 0,
			'totalWatts' => 0,
			'rank' => 0,
			'lastCorrectAnswerId' => 0
		);
				
		// select the user collection 
		$collection = $db->wattUser;
		$collection->insert($user);
		
		return $user;
		
	} // end of addUser
	
	
	/**
	 * Get the leader board.
	 */
	function getLeaderboard() {
		
		$leaderboard = array(
			'_id' => 'obama',
			'greenButtonCount' => 2,
			'gravatarHash' => '',
			'questionsAnswered' => 10,
			'totalWatts' => 22,
			'rank' => 1,
			'lastCorrectAnswerId' => 1
		);
		
		return $leaderboard;
		
	}
	
	/**
	* Get question based on user and previous question
	*/

	function getQuestion($userId, $previousQuestionId){
	
	$m = new Mongo();
	$db = $m->wattquiz;
	$collection = $db->question;
	//need to add user Id to query when complete

	if (is_null($previousQuestionId) == false) {
		$query = array("questionId" => $previousQuestionId );
		$question = $collection->find( $query );
	} else {
		$question = $collection->findOne();
	}

	
	return $question;
	}
	
}

?>
