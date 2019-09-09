<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'BA')) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$employee_id = $_SESSION['eid'];
	  }



	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$tool_name = $_POST['tool_name'];
	$prof = $_POST['prof'];


	$query = 'INSERT into pr_tool(employee_ssn, tool_name,PROFICIENCY) values (:didbv,:didbv2,:didbv3)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $employee_id);
	oci_bind_by_name($stid, ':didbv2', $tool_name);
	oci_bind_by_name($stid, ':didbv3', $prof);




	$r = oci_execute($stid);
	oci_commit($conn);

	header("Location: clockIn.html");
	exit;




?>