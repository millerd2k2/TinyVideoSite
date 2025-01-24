<?php
// Web page login form
// Danny Miller
// CS 385
// Spring 2024

require_once('dbLogin.php');

//session_start(); 								//<-- up at the top; leave it here

?>

<div>
<?php
	// if a session is started
	if ($isLoggedIn)
	{
		echo ("<h3>Logged in as: </h3><p>$username</p>");
	    echo ('<form action="index.php" method="post">');
	    echo ("<input type='submit' name='logout' value='Log out'>");
		echo ('</form>');
	}
	else
	{
		echo ('<form action="index.php" method="post">');
		echo ('<h3>Log in:</h3>');
		echo ('<p>Username: <input type="text" name="username"></p><p>Password: <input type="password" name="password"></p>');	
		echo ("<input type='submit' value='Log in'>");
		echo ('</form>');
		if ($loginFailed) echo ("<p style=\"color:red; font-weight:bold\">Invalid username/password combination</p>");
	}
?>
</div>

