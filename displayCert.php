<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || !(($_SESSION['permissions'] != 'PE') || ($_SESSION['permissions'] != 'BA')
	  	)) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$employee_id = $_SESSION['eid'];
	  }

$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

if($_SESSION['permissions'] == 'PE'){
	$query = 'SELECT cert_name,cert_date from pr_cert where employee_ssn = :didbv';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $employee_id);


	$r = oci_execute($stid);

	// Fetch each row in an associative array
	print '<table border="1">';
		print '<th> Cert Name </th> <th> Cert Date </th>';
		while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
		   print '<tr>';
		   foreach ($row as $item) {
		       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
		   }
		   print '</tr>';
		}
		print '</table>';
}
elseif($_SESSION['permissions'] == 'BA'){
		$query = 'SELECT tool_name,PROFICIENCY from pr_tool where employee_ssn = :didbv';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $employee_id);


	$r = oci_execute($stid);

	// Fetch each row in an associative array
	print '<table border="1">';
		print '<th> Tool Name </th> <th> Tool Proficiency </th>';
		while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
		   print '<tr>';
		   foreach ($row as $item) {
		       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
		   }
		   print '</tr>';
		}
		print '</table>';
}



?>