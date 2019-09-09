<?php
    echo "Hello";
         session_start();
          if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'HR')) {
            echo "Error";
            header("Location: clockIn.html");
            exit; // IMPORTANT: Be sure to exit here!
          }

    if(isset($_POST['checkDelete'])) {



        $toDelete = $_POST['checkDelete'];
        $conn = oci_connect("V00832687", "V00832687", "localhost/xe");

        $query1 = 'DELETE from pr_employee where 1=0 ';
        foreach ($toDelete as $hour1){
             $query1 = $query1.' or '.' employee_ssn = '.$hour1;
        }
        $stid1 = oci_parse($conn, $query1);
        $r1 = oci_execute($stid1);
        oci_commit($conn);

        header("Location: clockIn.html");



    } // end brace for if(isset
    else{
        header("Location: clockIn.html");
    }




?>
