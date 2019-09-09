<?php
         session_start();
  if (!$_SESSION['signed_in'] || $_SESSION['permissions'] != 'HR') {
        $_SESSION['flash_error'] = "Please sign in";
    echo "Error";
    header("Location: index.html");
    exit; // IMPORTANT: Be sure to exit here!
  }

// Create connection to Oracle
$conn = oci_connect("V00832687", "V00832687", "localhost/xe");



$query = 'SELECT user_name, employee_ssn from pr_employee WHERE job_id != \'CEO\'';
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);

print '<label for="ceo">New CEO Username</label>';
print '<select id = \'ceo\' name = \'ceo\'>';
        while ($row = oci_fetch_array($stid,OCI_BOTH)) {

               print '<option value = \''.$row[1] .'\'>'.$row[0].'</option>';
        }
print '</select>';

 ?>