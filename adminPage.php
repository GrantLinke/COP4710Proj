<!DOCTYPE HTML>
<html>

<head>
	<title>Admin homepage</title>
	<h1>Admin homepage</h1>
</head>

<body>
	<a href="createAdmin.html">
		<input type="submit" id="create" value="Create a new admin">
	</a>
	<br>
	
	<a href="deleteAdmin.html">
		<input type="submit" id="delete" value="Delete existing admin">
	</a>
	<br>
	
	<a href="changePassword.html">
		<input type="submit" id="change" value="Change password">
	</a>
	<br><br>
	
	<form method="post" action="sendEmail.php">
		Send email reminder to professors with submission deadline:<br>
		<input type="date" id="deadline" name="deadline">
		<input type="submit" id="subDeadline" value="Send email">
	</form>
	
	<br><br>
	
	<form method="post" action="individualReminder.php">
		Enter a professor's email to send them a book request: <br>
		<input type="text" name="email">
		<input type="submit" id="indivRemind" value="Send email">
	</form>
	<br>
	
	<a href="finalList.html">
		<input type="submit" name="finalList" value="Create final list">
	</a>
	<br>
	
	<a href="login.html">
		<input type="submit" name="back" value="Back">
	</a>
</body>
</html>