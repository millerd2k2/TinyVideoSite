<?php
// Recent action w/ JavaScript
// Danny Miller with help from Mozilla web docs for sessionStorage
// CS 385
// Spring 2024
?>

<div>
	<h3>Most recent action:</h3>
	<p id="recentAction">Logged in</p>
</div>
<script>
'use strict';

let action = document.getElementById('recentAction');

if (sessionStorage.getItem("action"))
{
	action.innerHTML = sessionStorage.getItem("action");
}

function updateToUpload() // called when uploading a video
{
	sessionStorage.setItem("action", "Attempted to upload a video");
}
function updateToDelete() // called when uploading a video
{
	sessionStorage.setItem("action", "Deleted a video");
}
</script>