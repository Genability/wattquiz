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
		
		// setup mongo
		//$this->$m = new Mongo();
		//$this->$db = $m->wattquiz;
	}


	/**
	 * getQuestion gets you a question to answer
	 */
	function getQuestion($params) {

		if ($params['answeredCorrectly'] == true) {
			// get the next question from mongodb using the userId and the questionId
			$questionId = intval($params['previousQuestionId']) + 1;
			$question = $this->_getQuestionFromMongo($params['userId'],$questionId);
		} else if ($params['answeredCorrectly'] == false) {
			// get the next question from mongodb using the userId and the questionId
			$questionId = intval($params['previousQuestionId']);
			$question = $this->_getQuestionFromMongo($params['userId'],$questionId);
		} else if ($params['previousQuestionId']) {
			$questionId = intval($params['previousQuestionId']) + 1;
			$question = $this->_getQuestionFromMongo($params['userId'],$questionId);
		} else {
			// get the first question from mongodb
			$question = $this->_getQuestionFromMongo($params['userId'],null);
		}

		if ($this->config['debug']) { echo $question; }
		
		return $question;
		
	} // end of getQuestion method


	/**
	 * answerQuestion to submit an answer to a question
	 */
	function answerQuestion($params) {

        $questionId = intval($params['questionId']);
		$userId = $params['userId'];
        $question = $this->_getQuestionFromMongo($userId,$questionId);

		// compare the answerId(s) passed in with the answerRank(s) in the DB
        $correct = false;
		foreach($question[answers] as $answer) {
		    if( $params['answerId'] == $answer['answerId'] && $answer['answerRank'] == 1) {
			    $correct = true;
				// TODO save answer here
				
				$m = new Mongo();
				$db = $m->wattquiz;
				$collection = $db->wattUser;
				$collection->update(
				    array('userId' => $userId),
				    array('$inc' => array("totalWatts" => $question[wattValue]),
				        '$set' => array("lastCorrectQuestionId" => $questionId), )
				);
				$collection->update(
				    array('userId' => $userId),
				    array('$inc' => array("questionsAnswered" => 1))
				);
			    $questionId++;
			    $question = $this->_getQuestionFromMongo($userId, $questionId);
			    break;
			}
		}
		
		$question = array_merge(
			array(
				'answerResult'	=> $correct,
			),
			$question
		);
		
		if ($this->config['debug']) { echo $result; };
		
		return $question;
		
	} // end of answerQuestion method
	
	/**
	 * Get the user object with their information.
	 */
	function getUser($userId) {
		
		// find the user by their id
		$m = new Mongo();
		$db = $m->wattquiz;
		$collection = $db->wattUser;
		$user = $collection->findOne(array('userId' => $userId));
		
		if(empty($user)) {
			$user = $this->_addUser($userId);
		}
		
		return $user;
		
	} // end of getUser
	
	
	/**
	 * Get the leader board.
	 */
	function getLeaderboard() {
		
		$m = new Mongo();
		$db = $m->wattquiz;
		$collection = $db->wattUser;
		$cursor = $collection->find();//TODO top n sorted by totalWatts
		$leaderboard = iterator_to_array($cursor);
		
		return $leaderboard;
		
	}
	
	
	/******************************************************************************************
	 * Private Helper Methods Below Here
	 ******************************************************************************************/
	
	function _addUser($userId) {

		$gravatarHash = md5( strtolower( trim( $userId ) ) );
		// then the URL is...
		//http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y
		
		$user = array(
			'userId' => $userId,
			'gravatarHash' => $gravatarHash,
			'questionsAnswered' => 0,
			'greenButtonCount' => 0,
			'totalWatts' => 0,
			'rank' => 0,
			'lastCorrectQuestionId' => 0
		);
				
		// select the user collection 
		$m = new Mongo();
		$db = $m->wattquiz;
		$collection = $db->wattUser;
		$collection->insert($user);
		
		return $user;
		
	} // end of _addUser
	
	/**
	* Get question based on user and previous question
	*/
	function _getQuestionFromMongo($userId, $questionId){
	
		$m = new Mongo();
		$db = $m->wattquiz;
		$collection = $db->question;
		//need to add user Id to query when complete

		if (is_null($questionId) == false) {
			$question = $collection->findOne(array('questionId' => $questionId ));
		} else {
			$question = $collection->findOne(array('questionId' => 1 ));
		}
		
		return $question;
	
	} // end of _getQuestionFromMongo
	
	
	
	
}

?>
