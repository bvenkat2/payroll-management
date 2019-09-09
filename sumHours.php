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
	  	echo "<h1> Welcome ". $_SESSION["name"]." </h1>";
  		echo "<h1> Permissions: ". $_SESSION["permissions"]." </h1>";

  }

  	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");
  	$query1 = 'SELECT to_char(pp_start, \'MM/DD\') || \'-\' ||to_char(pp_end, \'MM/DD\'), sum(clock_out - clock_in)*24 from pr_hours group by employee_id, pp_start, pp_end having employee_id = :didbv3';
  	// $query1 = 'SELECT employee_id, clock_in from pr_hours';
	$stid1 = oci_parse($conn, $query1);
	oci_bind_by_name($stid1, ':didbv3', $employee_id);
	$r1 = oci_execute($stid1);

	if(($row1 = oci_fetch_array($stid1, OCI_BOTH)) != false){
		echo '<h3> Pay Period: '. $row1[0]. '</h3>';
		echo '<h3> Hours Worked in Pay Period: '. round($row1[1],2). '</h3>';
	}
	else{

		// echo '<h3> Error, no rows fetched </h3>';
	}

 ?>