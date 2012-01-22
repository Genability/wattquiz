<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>test</title>
	
</head>

<body>


    <h3>Add or Get User</h3>
	<form method="post" action="api/user.php">
	
	   userId: <input type="text" name="userId">
	
	   <input type="submit" value="Get or Add">
	
	</form>
	
	<h3>Answer a question</h3>
	<form method="post" action="api/question.php">
	
	   questionId: <input type="text" name="questionId">
	
	   answerId: <input type="text" name="answerId">
	
	   userId: <input type="text" name="userId">
	
	   <input type="submit" value="Answer">
	
	</form>
	
	<h3>Upload Green Button</h3>
	
	<form action="https://api.genability.com/rest/beta/usage/bulk?appId=6830fbc2&appKey=5811743465758e20a3fc15aee0853936" method="post" enctype="multipart/form-data">
		accountId:	<input type="text" name="accountId" value="dbb27c7c-07cd-4f4e-8a7e-98ac9c6f92ed"/>
	  	sourceId:   <input type="text" name="sourceId" id="sourceId" value="jriley"/>
	    fileFormat: <input type="text" name="fileFormat" value="espi">
	
	    <input type="file" name="fileData" id="fileData"/>

	    <input type="submit" value="Upload">
	
	</form>
	
	<a href="api/leaderboard.php">Get Leaderboard JSON</a>
	

</body>
</html>
