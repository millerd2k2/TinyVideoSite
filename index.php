<?php
// HW 10 - Complete site (with JS)
// Danny Miller
// With help from the HW6 & HW7 examples by Will Briggs
// CS 385
// Spring 2024

require_once('dbLogin.php');

if (session_id() != '') session_destroy();
ini_set('session.gc_maxlifetime', 60*60*24);	// session timer
session_start(); 								//<-- up at the top; leave it here

require_once('sessionInfo.php');

if (isset($_POST['delete']) && isset($_POST['videoID']))
{ 
	$stmt = $pdo->prepare('DELETE FROM videos WHERE videoID=?');
	$stmt->bindParam(1, $videoID,     PDO::PARAM_INT );
	 
	$videoID   = $_POST['videoID'];
	$filename = $_POST['fileToDelete'];
	if (! $stmt->execute([$videoID]))die ("Couldn't execute DELETE!\n"); 
	
	unlink($filename);	// deletes the file from the uploads folder
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language"/>
<title>Homework 10 CS 385</title>

<link href="styles.css" rel="stylesheet" type="text/css" />

</head>

<body style="background-color: silver">
	
	<?php include_once("header.php"); ?>
	
<div id="modalMask">
	<div id="popupWindow">
		<p>This video has been deleted.</p>
		<input type="button" id="closePopup" value="Close"/>
	</div>
</div>
	
	<table style="width: 100%">
		<tr valign="top">
			<td style="width: 60%">
				<?php
					include_once('leftcolumn.php');?>
			</td>
			<td>
				<?php
					include_once('rightcolumn.php');?>
			</td>
		</tr>
	</table>
	
	<?php include_once('footer.php'); ?>
</body>

</html>