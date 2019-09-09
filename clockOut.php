<?php 
  session_start();
  if (!$_SESSION['signed_in']) {
    $_SESSION['flash_error'] = "Please sign in";
    echo "Error";
    header("Location: index.html");
    exit; // IMPORTANT: Be sure to exit here!
  }
  else{
	$employee_id = $_SESSION['eid'];
  }
	// $employee_id = 1;
	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");


	
	$query = 'UPDATE pr_hours set clock_out = sysdate where employee_id = :didbv and clock_out is null';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $employee_id);
	$r = oci_execute($stid);
	oci_commit($conn);
	if($r){
		echo "Success";
	}
	else{
		echo "Failure";
	} ?>