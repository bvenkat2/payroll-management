<?php 
	session_start();
    if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'PM')) {
      echo "Error";
    	exit; // IMPORTANT: Be sure to exit here!
  	}
    else{
      echo "Success";
    }

 

 ?>