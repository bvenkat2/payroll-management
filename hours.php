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



$query = 'SELECT to_char(clock_in, \'YYYY-MM-DD HH24:MI:SS\'), to_char(clock_out, \'YYYY-MM-DD HH24:MI:SS\') FROM pr_hours WHERE employee_id = :didbv order by clock_in desc';
$stid = oci_parse($conn, $query);
oci_bind_by_name($stid, ':didbv', $employee_id);


$r = oci_execute($stid);

// Fetch each row in an associative array
print '<table border="1">';
	print '<th> Time Clocked In </th> <th> Time Clocked Out </th>';
	while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
	   print '<tr>';
	   foreach ($row as $item) {
	       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
	   }
	   print '</tr>';
	}
	print '</table>';

 ?>