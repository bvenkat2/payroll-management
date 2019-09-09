<?php 
	 session_start();
	  if ((!$_SESSION['signed_in']) || ($_SESSION['permissions'] != 'PM')) {
	    echo "Error";
	    header("Location: clockIn.html");
	    exit; // IMPORTANT: Be sure to exit here!
	  }
	  else{
		$manager_id = $_SESSION['eid'];
	  }



	$conn = oci_connect("V00832687", "V00832687", "localhost/xe");

	$id = $_POST['proj_id'];
	$name = $_POST['firm_name'];
	$username = $_POST['username'];
	$password = $_POST['user-pw'];
	$accountnum = $_POST['accountnum'];
	$routingnum = $_POST['routingnum'];
	$fee = $_POST['fee'];
	$date = $_POST['date'];


	$query = 'INSERT into pr_firm ( project_id, firm_name, fee, pay_date, account_number, routing_number, username, password) values (:didbv,:didbv2,:didbv3,to_date(:didbv4,\'YYYY-MM-DD\'),:didbv5,:didbv6,:didbv8,:didbv9)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ':didbv', $id);
	oci_bind_by_name($stid, ':didbv2', $name);
	oci_bind_by_name($stid, ':didbv3', $fee);
	oci_bind_by_name($stid, ':didbv4', $date);
	oci_bind_by_name($stid, ':didbv5', $accountnum);
	oci_bind_by_name($stid, ':didbv6', $routingnum);
	oci_bind_by_name($stid, ':didbv8', $username);
	oci_bind_by_name($stid, ':didbv9', $password);


	echo $id;
	echo $name;
	echo $fee;


	$r = oci_execute($stid);
	oci_commit($conn);

	// $query1 ='update pr_project set firm_id =  (select firm_id from pr_firm where username = :didbv10 and password = :didbv11) where project_id = (select project_id from pr_firm where username = :didbv10 and password = :didbv11)';


	// $stid1 = oci_parse($conn, $query1);

	// oci_bind_by_name($stid1, ':didbv10', $username);
	// oci_bind_by_name($stid1, ':didbv11', $password);





	// $r1 = oci_execute($stid1);
	// oci_commit($conn);




	header("Location: clockIn.html");




?>