<?php
  session_start();
  if (!$_SESSION['signed_in']) {
    $_SESSION['flash_error'] = "Please sign in";
    echo 0;
    // header("Location: /index.php");
    exit; // IMPORTANT: Be sure to exit here!
  }
  else{
  	echo 1;
  }
?>
