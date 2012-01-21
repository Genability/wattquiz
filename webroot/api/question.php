<?php

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

// Send the JSON back
echo json_encode($question);

?>