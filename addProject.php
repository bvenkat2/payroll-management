<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'CEO')) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$manager_id = $_SESSION['eid'];
	  }



	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$name = $_POST['proj_name'];
	$id = $_POST['department_id'];



	$query = 'INSERT into pr_project (project_name, department_id) values (:didbv,:didbv2)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $name);
	oci_bind_by_name($stid, ':didbv2', $id);




	$r = oci_execute($stid);
	oci_commit($conn);
	header("Location: clockIn.html");




?>