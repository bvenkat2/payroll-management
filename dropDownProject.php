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

// Create connection to Oracle
$conn = oci_connect("V00832687", "V00832687", "localhost/xe");



$query = 'SELECT department_name, department_id from pr_department';
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);

// Fetch each row in an associative array
print '<label for="department_id">Department</label>';
print '<select id = \'department_id\' name = \'department_id\'>';
	while ($row = oci_fetch_array($stid,OCI_BOTH)) {

	       print '<option value = \''.$row[1] .'\'>'.$row[0].'</option>';
	}
print '</select>';

 ?>