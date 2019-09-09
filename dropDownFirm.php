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



$query = 'SELECT project_name, project_id from pr_project where project_id not in (select project_id from pr_firm) 
and pr_project.department_id = (select department_id from pr_employee where employee_ssn = :didbv)';

$stid = oci_parse($conn, $query);
  oci_bind_by_name($stid, ':didbv', $employee_id);

$r = oci_execute($stid);

print '<label for="proj_id">Project</label>';
print '<select id = \'proj_id\' name = \'proj_id\'>';
	while ($row = oci_fetch_array($stid,OCI_BOTH)) {

	       print '<option value = \''.$row[1] .'\'>'.$row[0].'</option>';
	}
print '</select>';

 ?>