<?php 
  session_start();
  if (!$_SESSION['signed_in']|| (($_SESSION['permissions']!='PM') && ($_SESSION['permissions']!='CEO'))) {
    $_SESSION['flash_error'] = "Please sign in";
    echo "Error";
    header("Location: index.html");
    exit; // IMPORTANT: Be sure to exit here!
  }

	if(isset($_POST['checkValid']) || isset($_POST['checkDelete'])) {
    	$hours = $_POST['checkValid'];
        $toDelete = $_POST['checkDelete'];
    	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

    	$query = 'UPDATE pr_hours set validated = 1 where 1 = 0';
    	foreach ($hours as $hour){
   			 $query = $query.' or '.' hour_id = '.$hour;
    	}
    	$stid = oci_parse($conn, $query);
    	$r = oci_execute($stid);
    	oci_commit($conn);



        $query1 = 'DELETE from pr_hours where hour_id = -100';
        foreach ($toDelete as $hour1){
             $query1 = $query1.' or '.' hour_id = '.$hour1;
        }
        $stid1 = oci_parse($conn, $query1);
        $r1 = oci_execute($stid1);
        oci_commit($conn);





    	header("Location: clockIn.html");



    } // end brace for if(isset

    else {
        header("Location: clockIn.html");
    }


 ?>