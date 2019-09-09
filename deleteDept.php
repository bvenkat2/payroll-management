<?php
  session_start();
  if (!$_SESSION['signed_in']|| $_SESSION['permissions']!='HR') {
        $_SESSION['flash_error'] = "Please sign in";
    echo "Error";
    header("Location: clockIn.html");
    exit; // IMPORTANT: Be sure to exit here!
  }
  else{

	$employee_id = $_SESSION['eid'];
  }



// Create connection to Oracle
$conn = oci_connect("V00832687", "V00832687", "localhost/xe");



$query = 'select department_id, department_name from pr_department';

$stid = oci_parse($conn, $query);
$r = oci_execute($stid);


// Fetch each row in an associative array
print '<h1> Select Which Departments You Wish to Remove from This Company';
print '<form method = "POST" action = "deptDelete.php">';
print '<table border="1">';
  print ' <th> Department Number </th> <th> Department Name </th><th> Select Employees to Remove</th>';
  while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
      $count = 0;
     print '<tr>';
     foreach ($row as $item) {
        # code...
         print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
       
        if ($count == 0) {
            $var = $item;
        }

         $count++;
     }
     print '<td>'. '<input type="checkbox" name= "checkDelete[]" value="'. $var .'">' .'</td>';

     print '</tr>';
  }
  print '</table>';
  print '<input type = "submit" value = "Submit">';
  print '</form>';

?>
