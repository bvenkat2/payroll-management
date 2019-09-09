<?php
         session_start();
          if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'IT')) {
            echo "Error";
            header("Location: clockIn.html");
            exit; // IMPORTANT: Be sure to exit here!
          }
         



        $conn = oci_connect("V00832687", "V00832687", "localhost/xe");

        $username = $_POST['username'];
        $password = $_POST['user-pw'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $salary = $_POST['salary'];
        $ssn = $_POST['ssn'];
        $dept = $_POST['dept'];

        if($dept != -1){

            $query = 'UPDATE pr_employee 
    		set first_name = :didbv3,
    		last_name = :didbv4,
    		user_name = :didbv,
    		password = :didbv2,
    		hourly_rate = :didbv7,
            department_id = :didbv9
    		where employee_ssn = :didbv8';


            $stid = oci_parse($conn, $query);
            oci_bind_by_name($stid, ':didbv', $username);
            oci_bind_by_name($stid, ':didbv2', $password);
            oci_bind_by_name($stid, ':didbv3', $first_name);
            oci_bind_by_name($stid, ':didbv4', $last_name);
            oci_bind_by_name($stid, ':didbv7', $salary);
            oci_bind_by_name($stid, ':didbv8', $ssn);
            oci_bind_by_name($stid, ':didbv9', $dept);


        }
        else{
            $query = 'UPDATE pr_employee 
            set first_name = :didbv3,
            last_name = :didbv4,
            user_name = :didbv,
            password = :didbv2,
            hourly_rate = :didbv7,
            department_id = null
            where employee_ssn = :didbv8';


            $stid = oci_parse($conn, $query);
            oci_bind_by_name($stid, ':didbv', $username);
            oci_bind_by_name($stid, ':didbv2', $password);
            oci_bind_by_name($stid, ':didbv3', $first_name);
            oci_bind_by_name($stid, ':didbv4', $last_name);
            oci_bind_by_name($stid, ':didbv7', $salary);
            oci_bind_by_name($stid, ':didbv8', $ssn);

        }

        $r = oci_execute($stid);
        oci_commit($conn);
        if($r){
        echo "<h1>success</h1>";
    }
        header("Location: clockIn.html");




?>
