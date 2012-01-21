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
</style>
	
</head>

<body>

<div class="container">
<div class="hero-unit">
	<h1>Watt Quiz</h1>
	<p>A simple social quiz, a la freerice.com, that asks you questions and educates you about your energy. Correct answers generate watts that are donated to worthly charities.</p>
</div>
<div class="content">
<div class="row">
	<div class="span11">questions</div>
	<div class="span5 quizStatus">
		<h3>You have answered 4/10 questions correctly!</h3>
		<div class="lightbulbCont">
			<div class="lightbulb"></div>
		</div>
	</div>
</div>
</div>
	
<div class="poweredby">
	<div class="pb">using data and apis from</div>
</div>
<img src="static/images/logos/nyc_opendata.png"/>
<img src="static/images/logos/genability.png"/>

<footer>
&copy; 2012
</footer>

</div>

</body>
</html>
