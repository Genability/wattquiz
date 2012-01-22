<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>test</title>
	
</head>

<body>
	
	<form method="post" action="api/question.php">
	
	   questionId: <input type="text" name="questionId">
	
	   answerId: <input type="text" name="answerId">
	
	   userId: <input type="text" name="userId">
	
	   <input type="submit" value="Answer">
	
	</form>


	<form method="post" action="api/user.php">
	
	   userId: <input type="text" name="userId">
	
	   <input type="submit" value="Get or Add">
	
	</form>
	
	<a href="api/leaderboard.php">leaderboard JSON</a>
	

</body>
</html>
