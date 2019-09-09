<?php 
	session_start();
    if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] == 'CF') ){
      echo "Error";
    	exit; // IMPORTANT: Be sure to exit here!
  	}
    else{
      echo "Success";
    }

 

 ?>