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

	$man_name = $_POST['manager_name'];
	$name = $_POST['dept_name'];
	$budget = $_POST['budget'];


	$query1 = 'SELECT employee_ssn from pr_employee where user_name = :didbv4';
	$stid1 = oci_parse($conn, $query1);
	oci_bind_by_name($stid1, ':didbv4', $man_name);
	$r1 = oci_execute($stid1);

	if(($row1 = oci_fetch_array($stid1, OCI_BOTH)) != false){
		$id = $row1[0];
	}


	$query = 'INSERT into pr_department( manager_ssn, department_name, expenses) values (:didbv,:didbv2,:didbv3)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $id);
	oci_bind_by_name($stid, ':didbv2', $name);
	oci_bind_by_name($stid, ':didbv3', $budget);




	$r = oci_execute($stid);
	oci_commit($conn);


	$query2 = 'UPDATE pr_employee set job_id = \'PM\', department_id = (select department_id from pr_department where manager_ssn = employee_ssn), manager_id = null where employee_ssn = :didbv7';
	$stid2 = oci_parse($conn, $query2);
	oci_bind_by_name($stid2, ':didbv7', $id);

	$r2 = oci_execute($stid2);
	oci_commit($conn);



	header("Location: clockIn.html");
	exit;




?>