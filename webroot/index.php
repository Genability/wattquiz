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
if ($_POST['city'] == 'san_francisco') {
	$GREEN_BUTTON_DATA = 2;
	//3 = lse doesn have it
} elseif ($_POST['city']) {
	$GREEN_BUTTON_DATA = 3;
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

//print_r($USER);
}

if ($_GET['city'] == 'san_francisco') {
$dc = 'http://api.donorschoose.org/common/json_feed.html?subject4=7&state=CA&keywords=electricity&APIKey=mqv7gprb9vgu';
} else {
$dc = 'http://api.donorschoose.org/common/json_feed.html?subject4=7&state=NY&keywords=electricity&APIKey=mqv7gprb9vgu';
}
$result = file_get_contents($dc);
$dc = json_decode($result);
$rand_p = array_rand($dc->proposals, 1);
//print_r($dc);

$dcp = $dc->proposals[$rand_p];

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

.poweredbyLogos {
	text-align: center;
}

.poweredbyLogos img {
	margin-right: 50px;
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
	$("#city").change(function () {
		//console.log(window.location);
		window.location = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname + "?city=" + $(this).val();
	});

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
	$('<p/>').attr('class', 'pull-right').text('This question is from ' + data.broughtBy).appendTo($("#questionCont"));
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
				if (data.questionId) {
				if (data.answerResult == true) {
					$('.answer.info').removeClass('info').addClass('success');
					if (data.answerTip) {
						$('<p/>').attr('class', 'alert-message block-message success answerExplanation').text("You just earned " + data.wattValue + " watts!").appendTo($('#questionCont'));
					}
					$('<a/>').attr('class', 'btn big nextQuestion').text('Next Question').appendTo($('#questionCont'));
					$('.lightbulb').css('height', data.questionId + '0%');
					var newWatts = parseFloat($('#wattCount').text()) + data.wattValue;
console.log(newWatts);
					$('.wattCount').text(newWatts);
				} else {
					$('.answer.info').removeClass('info').addClass('error');
					if (data.answerTip) {
						$('<p/>').attr('class', 'alert-message block-message error answerExplanation').text(data.answerTip).appendTo($('#questionCont'));
					}
					$('<a/>').attr('class', 'btn big nextQuestion').text('Try Again').appendTo($('#questionCont'));
				}
				$('.nextQuestion').click(function () {
					displayQuestion(data);
				});
				} else {
					if (data.answerResult == true) {
						$('.answer.info').removeClass('info').addClass('success');
						$("#finishScreen").css('display', 'block');
					} else {
						$('.answer.info').removeClass('info').addClass('error');
						if (data.answerTip) {
							$('<p/>').attr('class', 'alert-message block-message error answerExplanation').text(data.answerTip).appendTo($('#questionCont'));
						}
						$('<a/>').attr('class', 'btn big nextQuestion').text('Try Again').appendTo($('#questionCont'));
					}
				}

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

<?if ($USER["userId"]) { ?>
<div class="topbar">
	<div class="fill">
		<div class="container">
			<form id="userx" action="?logout=true" method="post" class="pull-right">
				<img class="gravatar" src="http://www.gravatar.com/avatar/<?=$USER["gravatarHash"]?>" /> Hey <?=$USER["userId"]?>
				<button class="btn" type="submit">Log Out</button>
			</form>
		</div>
	</div>
</div>
<?}?>
<div class="container">
<div class="hero-unit">
	<h1>Watt Quiz</h1>
	<p>A simple social quiz, a la freerice.com, that asks you questions and educates you about your energy. Correct answers generate watts that are donated to worthy charities via DonorsChoose.org!</p>
</div>
<div class="content">
	<? if($GREEN_BUTTON_DATA == 2) { ?>

		<h3>Awesome! Pacific Gas & Electric has green button data!</h3>
		<p>Get it from their site and upload here or email to greenbutton@wattquiz.com</p>

		<form id="profile_upload_form" action="https://api.genability.com/rest/beta/usage/bulk?appId=6830fbc2&appKey=5811743465758e20a3fc15aee0853936" method="post" enctype="multipart/form-data">
			<iframe id="upload_target" name="upload_target" src="" style="display: none; width: 100px; height: 100px; border: 1px solid #ccc;">
				<script type="text/javascript">
					function init() {
						if(top.uploadDone) top.uploadDone(); //top means parent frame.
					}
					window.onload=init;
				</script>
			</iframe>
			<input type="hidden" name="accountId" value="<?=$USER["accountId"]?>"/>
		  	<input type="hidden" name="sourceId" id="sourceId" value="<?=$USER["userId"]?>"/>
		   	<input type="hidden" name="fileFormat" value="espi">

			<input type="file" name="fileData" id="fileData"/>

<br/><br/>
					
			<a href="#" class="uploadProfile uploadGB alert-message block-message warning"><img src="static/images/green_button.jpg" style="width: 132px; height: 155px; vertical-align: middle;"/> Upload Green Button</a>
					<span id="span_status"></span>
					<span id="span_result"></span>
		</form>
<script>
$('#fileData').change(function () {
	if ($(this).val() != '') {
		$("#chooseFormat").show();
	} else {
		$("#chooseFormat").hide();
	}
});

$('.uploadGB').click(function (e) {
	e.preventDefault();
	$('input[name="fileFormat"]').val('espi');
	$('#profile_upload_form').submit();
});

$('.uploadCSV').click(function (e) {
	e.preventDefault();
	$('input[name="fileFormat"]').val('');
	$('#profile_upload_form').submit();
});

function init() {
	//point the form to target the iframe
	document.getElementById('profile_upload_form').onsubmit=function() {
		document.getElementById('profile_upload_form').target = 'upload_target';
		//document.getElementById("upload_target").onload = uploadDone;
		$("#span_status").html('<img src="static/images/ajax-loader.gif"/> Uploading...');
		setTimeout("window.location = window.location;",5000);
	};                                              
}         

//This function gets called when the iframe is loaded
function uploadDone() {
	//check if response contained success or error text
	var ret = frames['upload_target'].document.getElementsByTagName("body")[0].innerHTML;

	//Clear out status fields
	$("#span_status").html("");
	$("#span_result").html("");

	if (ret.indexOf("success") != -1) {
		//Uploaded successfully.
		$("#span_result").html("Upload successful").attr("class","uploadmsg uploadsuccess");
	} else {
		//Display message based on reason for failure.
		if (ret.indexOf("overlapping") != -1) {
			$("#span_result").html("Upload failed because of overlapping dates.").attr("class","uploadmsg");
		} else if(ret.indexOf("message") != -1) {
			var messageString=ret.substring(ret.indexOf("message")+10);
			var message=messageString.substring(0,messageString.indexOf('"'));
			$("#span_result").html(message).attr("class","uploadmsg");
		} else {
			$("#span_result").html("Upload failed.  Check the csv format.").attr("class","uploadmsg");
		}
	}
}

window.onload=init;
</script>
<? } else if($GREEN_BUTTON_DATA == 3) { ?>

		<h1>Boo! Con Edison of New York does not have green button data.</h1>
		<p>Tell them to give it to you. in the meanwhile, you can take a generic quiz about New York energy!</p>

		<input type="button" value="Start the Quiz">
<? } else if(isset($_SESSION['userId'])) { ?>
	<div class="row">
		<div id="finishScreen" class="span11 alert-message block-message info answerExplanation" style="display: none;">
				<h2>Thanks for playing! You helped donate the equivalent of <span class="wattCount"></span> watts of power to a school via DonorsChoose.org! Share your score with friends and get them to play to raise even more energy awareness!</h2><br/>
				<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:81px; height:20px; background:url('http://platform.tumblr.com/v1/share_1.png') top left no-repeat transparent;">Share on Tumblr</a>
				<br/><br/>
				<a href="https://twitter.com/share" class="twitter-share-button" data-related="wattquiz" data-lang="en" data-size="large" data-count="none">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=142685402497610";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-href="http://wattquiz.com" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
			</div>
		<div id="questionCont" class="span11"></div>
		<div class="span5 quizStatus">
			<div class="lightbulbCont">
				<div class="lightbulb" style="height: 0%;"></div>
			</div>
			<h4>You have helped donate <span id="wattCount" class="wattCount"><?=$USER["totalWatts"]?></span> watts!</h4>
		</div>
	</div>
<? } else { ?>
	<div class="row">
	<div class="span11">
		<h1>Take the Quiz</h1>

		<form method="post" action=".">
		<div class="clearfix">
			<label for"userId">Email</label>
			<div class="input">
				<input id="userId" type="text" name="userId" style="x-large">
			</div>
		</div>
		<div class="clearfix">
			<label for"city">City</label>
			<div class="input">
				<select id="city" name="city" style="x-large">
					<option value="new_york"<?if ($_GET['city'] == 'new_york') echo ' selected';?>>New York, NY</option>
					<option value="san_francisco"<?if ($_GET['city'] == 'san_francisco') echo ' selected';?>>San Francisco, CA</option>
					<option disabled>More cities coming soon!</option>
				</select>
			</div>
		</div>
		<div class="actions">
			<input type="submit" value="Go" class="btn primary">
		</div>
		</form>	
	</div>
	<div class="span5">
		<h3>Today, you are playing for:</h3><a href="<?=$dcp->proposalURL?>" target="_blank"><img class="dcImage" src="<?=$dcp->imageURL?>"/><br/><?=$dcp->title?></a><br/><?=$dcp->teacherName?>'s class at <?=$dcp->schoolName?> in <strong><?=$dcp->city?>, <?=$dcp->state?></strong>
	</div>
	</div>
<? } ?>
</div>


<div class="poweredby">
	<div class="pb">using apis and data from</div>
</div>
<div class="poweredbyLogos">
	<a href="http://nycopendata.socrata.com/" target="_blank"><img src="static/images/logos/nyc_opendata.png"/></a>
	<a href="http://genability.com/" target="_blank"><img src="static/images/logos/genability.png"/></a>
	<a href="http://donorschoose.org/" target="_blank"><img src="static/images/logos/donorschoose.png"/></a>
</div>


<footer>
</footer>

</div>

<script type="text/javascript" src="http://platform.tumblr.com/v1/share.js"></script>
</body>
</html>
