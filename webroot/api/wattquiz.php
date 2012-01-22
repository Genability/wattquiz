<?php

/** include the Genability PHP Library */
require_once('genability.php');

class wattquiz {
	
	
	private $gen;
	
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
		
		$this->gen = new genability(array(
		  'app_id'  => '6830fbc2',
		  'app_key' => '5811743465758e20a3fc15aee0853936',
		  'debug'   => false,
		));
	}


	/**
	 * getQuestion gets you a question to answer
	 */
	function getQuestion($params) {

		if ($params['answeredCorrectly'] == true) {
			// get the next question from mongodb using the userId and the questionId
			$questionId = intval($params['previousQuestionId']) + 1;
			$question = $this->_getQuestionFromMongo($questionId);
		} else if ($params['answeredCorrectly'] == false && $params['previousQuestionId']) {
			// get the next question from mongodb using the userId and the questionId
			$questionId = intval($params['previousQuestionId']);
			$question = $this->_getQuestionFromMongo($questionId);
		} else if ($params['previousQuestionId']) {
			$questionId = intval($params['previousQuestionId']) + 1;
			$question = $this->_getQuestionFromMongo($questionId);
		} else {
			// get the first question from mongodb
			$question = $this->_getQuestionFromMongo(1);
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
        $question = $this->_getQuestionFromMongo($questionId);

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
			    $question = $this->_getQuestionFromMongo($questionId);
			    break;
			}
		}
		
		if ($question){
			$question = array_merge(
				array(
					'answerResult'	=> $correct,
				),
				$question
			);
		}
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
		// else if($user["accountId"] == '')
		// {
		// 	todo - update the account - only to make life easier for dev
		// }
		
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
		
		$account = $this->_addGenAccount( $userId );
		$accountId = $account["results"][0]["accountId"];
		
		$user = array(
			'userId' => $userId,
			'gravatarHash' => $gravatarHash,
			'questionsAnswered' => 0,
			'greenButtonCount' => 0,
			'totalWatts' => 0,
			'rank' => 0,
			'lastCorrectQuestionId' => 0,
			'accountId' => $accountId,
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
	function _getQuestionFromMongo($questionId){
	
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
	
	
	
	function _addGenAccount($userId) {
		
		//if ($key != "providerOrgId" && $key != "accountName" && $key != "customerOrgName" && $key != "providerAccountId")		
		$x = array(
			//"providerOrgId" => "eecb537f-584b-40e4-91b6-2a615198ecdb",
			"accountName" => "Green Button",
			"providerAccountId" => $userId,
			);
			
		$json = $this->gen->addAccount($x);
		$results = json_decode($json, true);
		
		// check if account already exists
		if($results["status"] == "error") {
			$findAccount = array(
				"providerAccountId" => $userId,
				);
				
			$json = $this->gen->getAccounts($findAccount);
			$results = json_decode($json, true);
		}
		
		return $results;
		
	}
	
	
}

?>
