<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'HR')) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }

	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$newCEO = $_POST["ceo"];
	$query2 = 'changeCeo(:didbv)';
	$stid2 = oci_parse($conn, $query2);
	oci_bind_by_name($stid2, ':didbv', $newCEO);

	$r2 = oci_execute($stid2);
	oci_commit($conn);



	header("Location: clockIn.html");
	exit;





?>