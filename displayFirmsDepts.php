<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) ||(($_SESSION['permissions'] != 'CEO') && ($_SESSION['permissions'] != 'CEO'))) {
	    echo "Error";
	    // header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$employee_id = $_SESSION['eid'];
	  
$conn = oci_connect("V00832687", "V00832687", "localhost/xe");


	$query = 'SELECT project_id, firm_name, fee, pay_date from pr_firm';
	$stid = oci_parse($conn, $query);

	$r = oci_execute($stid);

	// Fetch each row in an associative array
	print '<table border="1">';
		print '<th> Project Number </th> <th> Firm Name </th><th> Fee </th> <th> Pay Date </th>';
		while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
		   print '<tr>';
		   foreach ($row as $item) {
		       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
		   }
		   print '</tr>';
		}
		print '</table> <br> <br>';


	$query1 = 'SELECT d.department_id, department_name, expenses, first_name || \' \' || last_name from pr_department d, pr_employee where employee_ssn = d.manager_ssn' ;
	$stid1 = oci_parse($conn, $query1);

	$r1 = oci_execute($stid1);


	// Fetch each row in an associative array
	print '<table border="1">';
		print '<th> Department Number </th> <th> Department Name </th><th> Expenses </th> <th> Manager Name </th>';
		while ($row1 = oci_fetch_array($stid1, OCI_RETURN_NULLS+OCI_ASSOC)) {
		   print '<tr>';
		   foreach ($row1 as $item1) {
		       print '<td>'.($item1 !== null ? htmlentities($item1, ENT_QUOTES) : '&nbsp').'</td>';
		   }
		   print '</tr>';
		}
		print '</table> <br> <br>';


		$query2 = 'SELECT * from pr_project';
	$stid2 = oci_parse($conn, $query2);

	$r2 = oci_execute($stid2);

	// Fetch each row in an associative array
	print '<table border="1">';
		print '<th> Project Number </th> <th> Project Name </th><th> Department Number </th>';
		while ($row2 = oci_fetch_array($stid2, OCI_RETURN_NULLS+OCI_ASSOC)) {
		   print '<tr>';
		   foreach ($row2 as $item2) {
		       print '<td>'.($item2 !== null ? htmlentities($item2, ENT_QUOTES) : '&nbsp').'</td>';
		   }
		   print '</tr>';
		}
		print '</table>';



}

?>