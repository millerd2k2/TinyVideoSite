<?php

  	//session_start(); //<-- up at the top; leave it here

	function destroy_session_and_data()
	{
	   $_SESSION = array();
	   define ("A_LONG_TIME", 2592000); 	//about a month 
	   setcookie(session_name(), '', time() - A_LONG_TIME, '/');
	   echo ("<script>sessionStorage.clear();</script>");	// remove entries from the session storage
	   session_destroy();
	}

	destroy_session_and_data();
?>