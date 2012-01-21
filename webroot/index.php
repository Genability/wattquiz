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

.hero-unit {
	margin: 25px -20px 15px;
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
</style>

	<script src="static/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script>
$(function (){
	function getQuestion() {
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url: "api/question.php",
			contentType: "application/json; charset=utf-8",
			success: function(data, textStatus) {
				$('<h2/>').attr('class', 'question').text(data.questionText).appendTo($("#questionCont"));
				switch (data.questionType) {
					case "multi-choice":
						var choices = $('<ul/>').attr('class', 'answers');
						for (answer in data.answers) {
							$('<li/>').attr('class', 'answer alert-message warning').text(data.answers[answer].answerValue).appendTo(choices);
						}
						choices.appendTo($("#questionCont"));
						break;
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log(textStatus + " " + errorThrown);
			}
		});
	}
	
	getQuestion();
});

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
	}
});
</script>
	
</head>

<body>

<div class="container">
<div class="hero-unit">
	<h1>Watt Quiz</h1>
	<p>A simple social quiz, a la freerice.com, that asks you questions and educates you about your energy. Correct answers generate watts that are donated to worthy charities.</p>
</div>
<div class="content">
<div class="row">
	<div id="questionCont" class="span11"></div>
	<div class="span5 quizStatus">
		<h3>You have answered 4/10 questions correctly!</h3>
		<div class="lightbulbCont">
			<div class="lightbulb"></div>
		</div>
	</div>
</div>
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
