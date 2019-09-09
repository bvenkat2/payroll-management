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

	$id = $_POST['proj_id'];
	$name = $_POST['firm_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$accountnum = $_POST['accountnum'];
	$routingnum = $_POST['routingnum'];
	$fee = $_POST['fee'];
	$date = $_POST['date'];


	$query = 'INSERT into pr_firm values (:didbv,:didbv2,:didbv3,:didbv4,:didbv,:didbv2,:didbv5,:didbv6,:didbv7,:didbv8,:didbv9)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $id);
	oci_bind_by_name($stid, ':didbv2', $name);
	oci_bind_by_name($stid, ':didbv3', $fee);
	oci_bind_by_name($stid, ':didbv4', $date);
	oci_bind_by_name($stid, ':didbv5', $accountnum);
	oci_bind_by_name($stid, ':didbv6', $routingnum);
	oci_bind_by_name($stid, ':didbv7', $fee);
	oci_bind_by_name($stid, ':didbv8', $username);
	oci_bind_by_name($stid, ':didbv9', $password);



	// oci_bind_by_name($stid, ':didbv9', $_SESSION['department_id']);

	$r = oci_execute($stid);
	oci_commit($conn);
	echo "<h1>success</h1>";
	header("Location: clockIn.html");




?>