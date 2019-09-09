<?php
	// Create connection to Oracle
	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$username = $_POST['username'];
	$password = $_POST['user-pw'];

	$query = 'SELECT * FROM pr_employee WHERE user_name = :didbv and password = :didbv2';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $username);
	oci_bind_by_name($stid, ':didbv2', $password);
	$r = oci_execute($stid);

	if(($row = oci_fetch_array($stid, OCI_BOTH)) != false){
		//clear old sessions
	  	session_start();
	  	session_destroy();
	  	session_start();

	    $_SESSION['signed_in'] = true;
	    $_SESSION['username'] = $username;
	    $_SESSION['eid'] = $row[0];
	    $_SESSION['name'] = $row[1]. ' '. $row[2];

		$_SESSION['permissions'] = $row[8];
		$_SESSION['department_id'] = $row[10];

		header("Location: clockIn.html");
		exit();


	}
	else{
		$query1 = 'SELECT * FROM pr_firm WHERE username = :didbv3 and password = :didbv4';
		$stid1 = oci_parse($conn, $query1);
		oci_bind_by_name($stid1, ':didbv3', $username);
		oci_bind_by_name($stid1, ':didbv4', $password);
		$r = oci_execute($stid1);
		if(($row1 = oci_fetch_array($stid1, OCI_BOTH)) != false){
			//clear old sessions
		  	session_start();
		  	session_destroy();
		  	session_start();


		    $_SESSION['signed_in'] = true;
		    $_SESSION['username'] = $username;
		    $_SESSION['name'] = $row1[2];
		    $_SESSION['pay'] = $row1[3];
		    $_SESSION['payDate'] = $row1[4];

			$_SESSION['permissions'] = 'CF';
			header("Location: firm.html");
			exit();


		}

		else {
		    $_SESSION['flash_error'] = "Invalid username or password";
		    $_SESSION['signed_in'] = false;
		    $_SESSION['username'] = null;
		    $_SESSION['eid'] = -1;
		    header("Location: badLogin.html");
		    exit();
		}
	}
?>