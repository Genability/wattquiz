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
	 * answerQuestion answers a question
	 */
	function getNextQuestion($params) {

		if ($params['previousQuestionId']) {
			// get the next question from mongodb using the userId and the questionId
			$question = array('questionId' => '2', 
			    'questionText' => 'What will score first',
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
			$question = array('questionId' => '1', 
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
	}
	
}

?>
