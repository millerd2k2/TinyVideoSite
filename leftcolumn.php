<?php
// Web page left column (database entries)
// Danny Miller
// CS 385
// Spring 2024
?>

<div class="flex-container">
	<div>
		<h3>Sort videos:
		<center><input type="button" id="flipColumn" value="View by latest upload date" onclick="flip()"></center>
		</h3>
		
	</div>
</div>

<div class="flex-container" id="videoColumn">
<?php
	$stmt = $pdo->prepare("SELECT * FROM videos");
	$stmt->execute();

	// Fetch the results as an associative array
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Output the results
	foreach ($results as $row) 
	{ 
		$r0 = htmlspecialchars($row['title']);  //Prevent HTML injection, all fields
		$r1 = htmlspecialchars($row['filename']);
		$r2 = htmlspecialchars($row['description']);
		$r3 = htmlspecialchars($row['date']);
		$r4 = htmlspecialchars($row['userID']);
		$r5 = htmlspecialchars($row['videoID']);
		
		echo <<<_END
<div>
<pre>
<h3 id="title$r5">$r0</h3>
<hr/>
<center><video width="480" height="320"  controls>
  <source src="$r1" type="video/mp4">
Your browser does not support the video tag.
</video></center>
<hr/>
<p>Date Posted: $r3</p>
<p>Description: $r2</p>
</pre>
_END;

		if (isset ($_SESSION['userid']))
		{
			if ($r4 == $_SESSION['userid'])
			{
				echo <<<_END
<form action='index.php' method='post'>
<input type='hidden' name='delete' value='yes'>
<input type='hidden' name='fileToDelete' value='$r1'>
<input type='hidden' name='videoID' value='$r5'>
<input type='submit' id='deleteButton' value='Delete Video' onclick="updateToDelete()"></form>
_END;
			}
		}
		echo ("</div>");
	}
?>
</div>
<script>
'use strict';

function flip()
{
	let columnDirection = document.getElementById("videoColumn").style.flexDirection;
	
	if (columnDirection == "column-reverse")
	{
		document.getElementById("videoColumn").style.flexDirection = "column";
		document.getElementById("flipColumn").value = "View by latest upload date";
	}
	else
	{
		document.getElementById("videoColumn").style.flexDirection = "column-reverse";
		document.getElementById("flipColumn").value = "View by earliest upload date";
	}
}
</script>
