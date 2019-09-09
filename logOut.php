<?php 
  session_start();
  $_session["signed_in"]=false;
	session_destroy();
  header("Location: index.html");
  exit();
 ?>