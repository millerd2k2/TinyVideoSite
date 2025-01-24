<?php
// Web page right column
// Danny Miller
// CS 385
// Spring 2024
?>

<div class="flex-container">
	<?php
		include_once("loginForm.php");
		if ($isLoggedIn)
		{
			include_once("recentAction.php");
			include_once("videoForm.php");
		}
	?>
</div>