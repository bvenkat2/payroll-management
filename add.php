<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'PM')) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$manager_id = $_SESSION['eid'];
	  }



	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$username = $_POST['username'];
	$password = $_POST['user-pw'];
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$accountnum = $_POST['accountnum'];
	$routingnum = $_POST['routingnum'];
	$salary = $_POST['salary'];
	$ssn = $_POST['ssn'];
	$job = $_POST['role'];

	$query = 'INSERT into pr_employee values (:didbv8,:didbv3,:didbv4,:didbv,:didbv2,:didbv5,:didbv6,:didbv7,:didbv10,:didbv9,:didbv11)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $username);
	oci_bind_by_name($stid, ':didbv2', $password);
	oci_bind_by_name($stid, ':didbv3', $first_name);
	oci_bind_by_name($stid, ':didbv4', $last_name);
	oci_bind_by_name($stid, ':didbv5', $accountnum);
	oci_bind_by_name($stid, ':didbv6', $routingnum);
	oci_bind_by_name($stid, ':didbv7', $salary);
	oci_bind_by_name($stid, ':didbv8', $ssn);
	oci_bind_by_name($stid, ':didbv9', $manager_id);
	oci_bind_by_name($stid, ':didbv10', $job);

	oci_bind_by_name($stid, ':didbv11', $_SESSION['department_id']);

	$r = oci_execute($stid);
	oci_commit($conn);
	echo "<h1>success</h1>";
	header("Location: clockIn.html");




?>