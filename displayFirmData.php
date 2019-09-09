<?php 
	// Create connection to Oracle
	session_start();
    if ((!$_SESSION['signed_in']) || (!$_SESSION['permissions'] == 'CF') ){
      echo "Error";
    	exit; // IMPORTANT: Be sure to exit here!
  	}
	echo '<h1> Welcome: '.$_SESSION['name'].'</h1>';
	echo '<h3> Total Pay: '.$_SESSION['pay'].' Dollars</h3>';
	echo '<h3> Pay Date: '.$_SESSION['payDate'].'</h3>';

 ?>