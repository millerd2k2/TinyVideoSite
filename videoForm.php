<?php
// videoForm.php
// Danny Miller
// CS 385
// Spring 2024

function checkFile($target_dir)
{
	$target_file = $target_dir . basename($_FILES["filename"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$result = false;

	//Check if file isn't an image
	//if(! getimagesize($_FILES["filename"]["tmp_name"])) echo "Sorry, file is not an image.";

	// Check if file already exists
	if (file_exists($target_file))                     echo "Sorry, file already exists.";
	
	// Check file size
	else if ($_FILES["filename"]["size"] > 500000000)      	echo "Sorry, your file is too large.";  
	
	// Allow certain file formats
	else if($imageFileType != "mp4") 
                                                            echo "Sorry, only MP4 files are allowed.";
	
	// Try to load it
	else if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file))
	{
		echo "<p>The file ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.</p>";
		$result = true;
	}
	  
	// Report if it didn't work
	else 
	                                                        echo "Sorry, there was an error uploading your file.";
	
	return $result;
}

if (isset($_POST['title'])   &&
	isset($_FILES['filename'])    &&
	isset($_POST['description']) &&
	$_POST['title'] != '')
{
	$directory = "uploads/";
	if (checkfile($directory))
	{
		$stmt = $pdo->prepare('INSERT INTO videos(title, filename, description, date, userID) VALUES(?,?,?,?,?)');
		$stmt->bindParam(1, $title,   PDO::PARAM_STR, 128);
		$stmt->bindParam(2, $filename,    PDO::PARAM_STR, 128);
		$stmt->bindParam(3, $description, PDO::PARAM_STR, 512 );
		$stmt->bindParam(4, $date,     PDO::PARAM_STR, 10 );
		$stmt->bindParam(5, $userID,     PDO::PARAM_INT);
		 
    	$title   = $_POST['title'];
    	$filename    = $directory.$_FILES['filename']['name'];
    	$description = $_POST['description'];
    	$date     = date("m/d/Y");
    	$userID     = $_SESSION['userid'];
    	
		if (! $stmt->execute([$title, $filename, $description, $date, $userID]))
			die ("Couldn't execute INSERT!\n");
			
		header("Refresh:0"); // refreshes page
	}

	
}

?>

<div>
	<form method="post" action="index.php" enctype="multipart/form-data">
		<legend><h3>Enter Video Information:</h3></legend>
		<table>
			<tr>
				<td><label class="label" for="name">Title*:</label></td>
				<td><input name="title" type="text" /></td>
			</tr>
			<tr>
				<td><label class="label" for="name">Video File*:</label></td>
				<td><input name="filename" id="filename" type="file" accept=".mp4"/></td>
			</tr>
			<tr>
				<td><label class="label" for="name">Description:</label></td>
				<td><textarea name="description" cols="40" rows="8" style="margin:20px"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="submit-button" type="submit" value="Upload Video" onclick="updateToUpload()"/></td>
			</tr>
		</table>
	</form>
	<?php echo ("<p style=\"color:red\">*: is required to upload a video</p>") ?>
</div>
