<?php 
	// $employee_id = 1;
	// $query = 'INSERT into pr_hours (employee_id, clock_in) values (:didbv, sysdate)';
	// $stid = oci_parse($conn, $query);
	// oci_bind_by_name($stid, ':didbv', $employee_id);
	// $r = oci_execute($stid);
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

  	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");
  	$query1 = 'SELECT * FROM pr_hours WHERE employee_id = :didbv3 and clock_out is null';
	$stid1 = oci_parse($conn, $query1);
	oci_bind_by_name($stid1, ':didbv3', $employee_id);
	$r1 = oci_execute($stid1);

	if(($row1 = oci_fetch_array($stid1, OCI_BOTH)) != false){
		//clear old sessions

		echo "Please Clock Out before you Clock In";
	    // header("Location: clockIn.html");
	}
	else{

		// $employee_id = 1;
		// $conn = oci_connect("V00832687", "V00832687", "localhost/xe");
		$query = 'INSERT into pr_hours (employee_id, clock_in, clock_out, pp_start, pp_end) values (:didbv, SYSDATE, null, to_date(\'20-04-19\', \'DD-MM-YY\'), to_date(\'04-05-19\',\'DD-MM-YY\'))';
		$stid = oci_parse($conn, $query);
		oci_bind_by_name($stid, ':didbv', $employee_id);
		$r = oci_execute($stid);
		oci_commit($conn);

		echo "Success";

		// if($r){
		// 	echo "Success";
		// }
		// else{
		// 	echo "Failure";
		// }
	}
 ?>