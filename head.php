<?php 
	session_start();
  	if (!$_SESSION['signed_in']) {
    	$_SESSION['flash_error'] = "Please sign in";
    	header("Location: /index.html");
    	exit; // IMPORTANT: Be sure to exit here!
  	}

 ?>