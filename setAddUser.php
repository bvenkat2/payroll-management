<?php 
	session_start();
    if (!$_SESSION['signed_in']) {
    	exit; // IMPORTANT: Be sure to exit here!
  	}
    elseif ($_SESSION['permissions'] == 'PM') {
      echo "<a href=\"addUser.html\">Add a User</a> <br>";
      echo "<a href=\"addFirm.html\">Add a Consulting Firm to your Project</a> <br>";
      echo "<a href=\"empHourCheck.php\">Validate Hours for Users in your Department</a>";

    }
     elseif ($_SESSION['permissions'] == 'CEO') {
     	
      echo "<a href=\"manHourCheck.php\">Validate Hours for all Managers</a> <br>";
      echo "<a href=\"addProject.html\">Add a Project to your company</a> <br>";
      echo "<a href=\"addDepartment.html\">Add a Department to your company</a> <br>";



    }
     elseif ($_SESSION['permissions'] == 'PE') {
      echo "<a href=\"addCert.html\">Add a Certification to your company</a> <br>";
    }
         elseif ($_SESSION['permissions'] == 'BA') {
      echo "<a href=\"addTool.html\">Add a Tool to your company</a> <br>";
    }
         elseif ($_SESSION['permissions'] == 'HR') {
      echo "<a href=\"deleteFirm.html\">Delete a Firm from your company</a> <br>";
            echo "<a href=\"deleteProject.html\">Delete a Project from your company</a> <br>";

    }



 

 ?>