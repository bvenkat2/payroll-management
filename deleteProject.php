<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'HR')) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }


	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$project_id = $_POST['project_id'];


	$query = 'DELETE from pr_project where project_id = :didbv';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $project_id);
	$r = oci_execute($stid);
	oci_commit($conn);

	header("Location: clockIn.html");
	exit;




?>