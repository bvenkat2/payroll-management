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



$query = 'select user_name from pr_employee where job_id = \'BA\' or job_id = \'PE\'';
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);

print '<label for="manager_name">Manager Username</label>';
print '<select id = \'manager_name\' name = \'manager_name\'>';
	while ($row = oci_fetch_array($stid,OCI_BOTH)) {

	       print '<option value = \''.$row[0] .'\'>'.$row[0].'</option>';
	}
print '</select>';

 ?>