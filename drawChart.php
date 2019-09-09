<?php
	 session_start();
	  if ((!$_SESSION['signed_in']) || !(($_SESSION['permissions'] == 'PM')|| ($_SESSION['permissions'] == 'CEO')) ) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$employee_id = $_SESSION['eid'];
	  }

ini_set('max_execution_time', 123456);

$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

If (!conn)


if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
if($_SESSION['permissions'] == 'PM'){
$query= oci_parse($conn, 'select first_name || \' \' || last_name NAME, sum(clock_out-clock_in)*24 HOURS from pr_employee e, pr_hours h where e.employee_ssn = h.employee_id and e.manager_id = :didbv group by e.employee_ssn, first_name, last_name');
	oci_bind_by_name($query, ':didbv', $employee_id);
}
elseif($_SESSION['permissions'] == 'CEO'){
	$query= oci_parse($conn, 'select first_name || \' \' || last_name NAME, sum(clock_out-clock_in)*24 HOURS from pr_employee e, pr_hours h where e.employee_ssn = h.employee_id and e.manager_id is null group by e.employee_ssn, first_name, last_name');
}
oci_execute($query);

$rows = array();
$table = array();
$table['cols'] = array(

array('label' => 'NAME', 'type' => 'string'),
array('label' => 'HOURS', 'type' => 'number'),

);

$rows = array();
while($r = oci_fetch_array($query, OCI_NUM)) {
//The below col names have to be in upper caps.
	$rows[] = $r;
}
// print_r($rows);
// $out = array_values($rows);
// print "<br>";
// print_r($out);
//Use the line below to see the data in jason format
echo json_encode($rows);

//Use the below lines of code to see data in a HTML table

// echo '<table border=\'1\'> \n';
// echo '<tr><th>NAME</th><th>HOURS</th></tr>\n';
// while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
// 	echo '<tr>\n ';
// 	foreach ($query as $block) {
// 		echo ' <td>' . ($block !== null ? htmlentities($block, ENT_QUOTES) : '&nbsp;') . '</td>\n';
// 	}
// 	echo '</tr>\n';
// }
// 	echo '</table>\n'; 

// print '<table border="1">';
	// print '<th> NAME </th> <th> HOURS </th>';
	// while ($row = oci_fetch_array($query, OCI_RETURN_NULLS+OCI_ASSOC)) {
	//    print '<tr>';
	//    foreach ($row as $item) {
	//        print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
	//    }
	//    print '</tr>';
	// }
	// print '</table>';

?>