<?php
session_start();
if ($_GET['logout']) {
	unset($_SESSION['userId']); 
}

if ($_POST['userId']) {
	$_SESSION['userId'] = $_POST['userId'];
	$USER_ID = $_POST['userId'];
} 

$GREEN_BUTTON_DATA = 1;
if ($_POST['zipCode']) {
	$GREEN_BUTTON_DATA = 2;
	//3 = lse doesn have it
}

if(isset($_SESSION['userId'])) {

	/** include the watt quiz services */
	require_once('api/wattquiz.php');

	// set your app id and app key
	$wq = new wattquiz(array(
	  'debug'   => false,                // Debug mode echos API Url & POST data if set to true (Optional)
	));

	// make the getUser call
	$USER = $wq->getUser( $_SESSION['userId'] ); // ID of the user (Required)

print_r($USER);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Watt Quiz</title>

	<link rel="stylesheet" href="static/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Qwigley' rel='stylesheet' type='text/css'>
<style type="text/css">
/* Override some defaults */
html, body {
	background-color: #eee;
}

.topbar .fill {
	height: 40px;
	color: #ddd;
}

.topbar input {
	height: 27px; //hax
}

.hero-unit {
	margin: 50px -20px 15px;
	padding: 35px;
	border: 2px solid #ccc;
}

/* The white background content wrapper */
.container > .content {
	background-color: #fff;
	padding: 20px;
	margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
	-webkit-border-radius: 6px;
	   -moz-border-radius: 6px;
		border-radius: 6px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
	   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
		box-shadow: 0 1px 2px rgba(0,0,0,.15);
}

.quizStatus {
}

.lightbulbCont {
	height: 370px;
	position: relative;
	bottom: 0;
}

.lightbulb {
	background: url('static/images/lightbulb.jpg') no-repeat scroll left bottom #fff;
	background-size: 300px 373px;
	width: 300px; height: 100%;
	position: absolute;
	bottom: 0;
	border-top: 3px solid #000;
}

.poweredby {
	margin: 40px 0 10px;
	text-align: center;
	border-top: 1px solid #aaa;
}

.poweredby .pb {
	background-color: #eee;
	width: 275px;
	margin: 0 auto;
	position: relative;
	top: -8px;
	font-family: 'Qwigley', cursive;
	font-size: 3em;
}

ul.answers {
	margin: 0;
}

li.answer {
	list-style: none;
	margin-bottom: 6px;
	cursor: pointer;
}

li.answer .loader {
	margin-left: 25px;
}

.answerExplanation {
	margin-top: 35px;
}

.gravatar {
	width: 30px;
	height: 30px;
	margin-right: 10px;
	vertical-align: top;
}
</style>

	<script src="static/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script>
$(function (){
	$("#user").submit(function (e) {
		e.preventDefault();

		payload = {};
		payload["userId"] = $("#userId").val();

		console.log(payload);
	
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: "api/user.php",
			data: payload,
			success: function(data, textStatus) {
				console.log(data);
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log(textStatus + " " + errorThrown);
			}
		});

	});

	function getQuestion() {
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url: "api/question.php",
			contentType: "application/json; charset=utf-8",
			success: function(data, textStatus) {
				displayQuestion(data);
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log(textStatus + " " + errorThrown);
			}
		});
	}
	
	getQuestion();
});

function displayQuestion(data) {
	$("#questionCont").html('');
	$('<h2/>').attr('id', 'question').attr('questionid', data.questionId).text(data.questionText).appendTo($("#questionCont"));
	switch (data.questionType) {
		case "multi-choice":
			var choices = $('<ul/>').attr('class', 'answers');
			for (answer in data.answers) {
				$('<li/>').attr('class', 'answer alert-message warning').attr('answerid', data.answers[answer].answerId).text(data.answers[answer].answerValue).appendTo(choices);
			}
			choices.appendTo($("#questionCont"));
			break;
	}
}

$('li.answer').live('hover', function() {
	if (!$(this).hasClass('disabled'))
		$(this).removeClass('warning').addClass('info');
});

$('li.answer').live('mouseout', function() {
	if (!$(this).hasClass('disabled'))
		$(this).removeClass('info').addClass('warning');
});

$('li.answer').live('click', function() {
	if ($(this).hasClass('disabled')) {
		return false;
	} else {
		$(this).addClass('info');
		$('li.answer').each(function() {
			$(this).addClass('disabled');
		});
		$(this).append('<img class="loader" src="static/images/ajax-loader.gif"/>');

		var payload = {};

		payload['questionId'] = $("#question").attr('questionid');
		payload['answerId'] = $(this).attr('answerid');

		console.log(payload);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: "api/question.php",
			data: payload,
			success: function(data, textStatus) {
				$('.answer .loader').remove();
				console.log(data);
				if (data.answerResult == true) {
					$('.answer.info').removeClass('info').addClass('success');
					if (data.answerTip) {
						$('<p/>').attr('class', 'alert-message block-message success answerExplanation').text(data.answerTip).appendTo($('#questionCont'));
					}
					$('<a/>').attr('class', 'btn big nextQuestion').text('Next Question').appendTo($('#questionCont'));
				} else {
					$('.answer.info').removeClass('info').addClass('error');
					if (data.answerTip) {
						$('<p/>').attr('class', 'alert-message block-message error answerExplanation').text(data.answerTip).appendTo($('#questionCont'));
					}
					$('<a/>').attr('class', 'btn big nextQuestion').text('Next Question').appendTo($('#questionCont'));
				}

				$('.nextQuestion').click(function () {
					displayQuestion(data);
				});
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log(textStatus + " " + errorThrown);
			}
		});

	}
});
</script>
	
</head>

<body>

<div class="topbar">
	<div class="fill">
		<div class="container">
			<?if ($USER["userId"]) { ?>
			<form id="userx" action="?logout=true" method="post" class="pull-right">
				<img class="gravatar" src="http://www.gravatar.com/avatar/<?=$USER["gravatarHash"]?>" /> Hey <?=$USER["userId"]?>
				<button class="btn" type="submit">Log Out</button>
			</form>
			<?} else {?>
			<form id="userx" action="" method="post" class="pull-right">
				<input id="userId" class="input-big" type="text" name="userId" placeholder="Email">
				<button class="btn" type="submit">Sign In</button>
			</form>
			<?}?>
		</div>
	</div>
</div>

<div class="container">
<div class="hero-unit">
	<h1>Watt Quiz</h1>
	<p>A simple social quiz, a la freerice.com, that asks you questions and educates you about your energy. Correct answers generate watts that are donated to worthy charities.</p>
</div>
<div class="content">
	<? if($GREEN_BUTTON_DATA == 2) { ?>

		<h3>Congrats! XXX has green button data.</h3>
		<p>Get it from their site and upload here or email to greenbutton@wattquiz.com</p>
		<form action="https://api.genability.com/rest/beta/usage/bulk?appId=6830fbc2&appKey=5811743465758e20a3fc15aee0853936" method="post" enctype="multipart/form-data">
			accountId:	<input type="text" name="accountId" value="<?$USER["accountId"]?>"/>
		  	sourceId:   <input type="text" name="sourceId" id="sourceId" value="<?$USER["userId"]?>"/>
		    fileFormat: <input type="text" name="fileFormat" value="espi">

		    <input type="file" name="fileData" id="fileData"/>

		    <input type="submit" value="Upload">

		</form>
<? } else if(isset($_SESSION['userId'])) { ?>
	<div class="row">
		<div id="questionCont" class="span11"></div>
		<div class="span5 quizStatus">
			<h3>You have answered 4/10 questions correctly!</h3>
			<div class="lightbulbCont">
				<div class="lightbulb"></div>
			</div>
			<h4>You have helped donate <span id="wattCount"><?=$USER["totalWatts"]?></span> watts!</h4>
		</div>
	</div>
	
<? } else if($GREEN_BUTTON_DATA == 3) { ?>

		<h3>Boo! YYY does not have green button data.</h3>
		<p>Tell them to give it to you.</p>

		<input type="button" value="Start the Quiz">

<? } else { ?>
	<div class="row">
		<h3>Sign up or Sign In</h3>
		<form method="post" action=".">
			Email: <input type="text" name="userId">
           Zipcode: <input type="text" name="zipCode">
		   <input type="submit" value="Go">
		</form>
		
	</div>
<? } ?>
</div>
	
<div class="poweredby">
	<div class="pb">using apis and data from</div>
</div>
<img src="static/images/logos/nyc_opendata.png"/>
<img src="static/images/logos/genability.png"/>

<footer>
&copy; 2012
</footer>

</div>

</body>
</html>
