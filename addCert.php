<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'PE')) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$employee_id = $_SESSION['eid'];
	  }



	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$cert_name = $_POST['cert_name'];
	$cert_date = $_POST['cert_date'];


	$query = 'INSERT into pr_cert(employee_ssn, cert_name,cert_date) values (:didbv,:didbv2,to_date(:didbv3, \'YYYY-MM-DD\'))';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $employee_id);
	oci_bind_by_name($stid, ':didbv2', $cert_name);
	oci_bind_by_name($stid, ':didbv3', $cert_date);




	$r = oci_execute($stid);
	oci_commit($conn);

	header("Location: clockIn.html");
	exit;




?>