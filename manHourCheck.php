<?php  
  session_start();
  if (!$_SESSION['signed_in'] || $_SESSION['permissions']!='CEO') {
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



$query = 'SELECT hour_id, first_name, last_name, to_char(clock_in, \'YYYY-MM-DD HH24:MI:SS\'), to_char(clock_out, \'YYYY-MM-DD HH24:MI:SS\'),hourly_rate
from pr_employee, pr_hours
where pr_employee.employee_ssn = pr_hours.employee_id and manager_id is null and validated = 0 and clock_out is not null';


$stid = oci_parse($conn, $query);
oci_bind_by_name($stid, ':didbv', $employee_id);


$r = oci_execute($stid);


// Fetch each row in an associative array
print '<h1> Select Which Hours You Wish to Validate';
print '<form method = "POST" action = "validateHours.php">';
print '<table border="1">';
  print '<th>Hour ID </th> <th> First Name </th> <th> Last Name </th> <th> Clock In Time </th> <th> Clock Out Time </th> <th> Hourly Rate </th><th> Select Hours To Validate </th><th> Select Hours to Delete</th>';
  while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
      $count = 0;
     print '<tr>';
     foreach ($row as $item) {
         print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
         if ($count == 0) {
            $var = $item;
         }
         $count++;
     }
     print '<td>'. '<input type="checkbox" name= "checkValid[]" value="'. $var .'">' .'</td>';
     print '<td>'. '<input type="checkbox" name= "checkDelete[]" value="'. $var .'">' .'</td>';

     print '</tr>';
  }
  print '</table>';
  print '<input type = "submit" value = "Submit">';
  print '</form>';




?>