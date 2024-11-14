<?php 


require('session.php'); 

//login confirmation
confirm_logged_in();
$action=$_GET['action']; 

include('class_call.php');
include('case.php');
?>
