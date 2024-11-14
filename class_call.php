<?php
include_once('class/DBController.php');
include_once('class/Admin.php');
include_once('class/Leads.php');

$db_handle = new DBController();

$admin = new Admin();
$leads = new Leads();

$conn = new DBController();
$con = $conn->connectDB();

$action = "";
if (!empty($_GET["action"])) 
	{
    	$action = $_GET["action"];
	}
	else { ?><script type="text/javascript">
                window.location = "logout.php";
                </script><?php }

    
	
?>