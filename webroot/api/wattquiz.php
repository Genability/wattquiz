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
		
		// get the appropriate question
		$question = $this->getQuestion(array(
		  'answeredCorrectly' => $correct,             // whether they got it right or not
		  'previousQuestionId'=> $questionId,         // Unique ID for the previous question (Optional)
		  'userId'            => $userId              // ID of the user answering the question (Required)
		));
	
		
		if ($this->config['debug']) { echo $result; };
		
		return $question;
		
	} // end of answerQuestion method
	
}

?>
