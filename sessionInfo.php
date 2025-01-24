<?php
// Web page session/storing login info
// Danny Miller
// CS 385
// Spring 2024

$isLoggedIn  = false;
$loginFailed = false;
  
// submitted login
if (isset($_POST['username']) && isset($_POST['password']))
{
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);
    
	$stmt = $pdo->prepare('SELECT * FROM users WHERE username=?');
	$stmt->bindParam(1, $username,   PDO::PARAM_STR, 64);
	 
	if (! $stmt->execute([$username])) die ("Couldn't access database!\n");  

	$result= $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (count($result) == 0) die("User not found");
	if (count($result) >  1) die ("Duplicate entries for this user -- call the database cops!");

	$row = $result[0];
    
	$isLoggedIn = password_verify ($password, $row['password']);
	$loginFailed = ! $isLoggedIn;
	
	if ($isLoggedIn) $userid = $row['userID'];
}

// log out button clicked
if (isset($_POST['logout']))
{
	require_once('logoutCode.php');
}

// already logged in
if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$userid = $_SESSION['userid'];
	$isLoggedIn = true;
	
	// prevent hijacking
	if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) different_user();
}

// start/regenerate session
if ($isLoggedIn)
{
	$_SESSION['username'] = $username;
	$_SESSION['userid'] = $userid;
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	session_regenerate_id();	// prevent fixation
}
?>