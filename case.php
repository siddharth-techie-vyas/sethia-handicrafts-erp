
<?php

switch ($action) {
				
case "dashboard":
 		if($_GET['action']=='dashboard')
 		{
 			
 			//-- no css modal popup
			if(isset($_GET['nocss']))
			{
				if(!file_exists("web/".$_GET['nocss'].".php"))
 						{require_once("web/404.php");}
 					else
 						{require_once("web/".$_GET['nocss'].".php");}
			}
			else if(isset($_GET['page']))
 				{
 					require_once("web/header.php");
					require_once("web/menu.php");
 					//============================================ OPEN ALL PAGES		
 					if(!file_exists("web/".$_GET['page'].".php"))
 						{require_once("web/404.php");}
 					else
 						{require_once("web/".$_GET['page'].".php");}
 					
 					require_once("web/footer.php");
 				}
 			else
 				{require_once("web/dashboard.php");}
 		}
 		break;
//--- dashboard closed

//--- leads open
case "leads":
	if($_GET['action']=='leads')
	{
		if($_GET['query']=='create_new')
		{
			$save=$leads->create_new($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['designation'],$_POST['req'],$_POST['lp_url'],$_POST['form_id'],$_POST['company']);
			if($save)
			{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_addnew&status=1';</script>";}
			else
			{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_addnew&status=2';</script>";}
		}

		if($_GET['query']=='edit_lead')
		{
			
			$save=$leads->edit_lead($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['designation'],$_POST['req'],$_POST['lp_url'],$_POST['form_id'],$_POST['company'],$_POST['id']);
			if($save)
			{echo "<div class='alert alert-success'>Lead Edited Successfully !!!</div>";}
			else
			{echo "<div class='alert alert-danger'>Something went wrong !!!</div>";}
		}

		
		if($_GET['query']=='create_group')
		{
			$save=$leads->create_group($_POST['gname'],$_POST['color_code']);
			if($save)
			{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_addgroup&status=1';</script>";}
			else
			{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_addgroup&status=2';</script>";}
		}	

		if($_GET['query']=='get_details')
		{
			if($_GET['type']=='state')
			{
				$state=$admin->get_states($_GET['id']);
				foreach($state as $r=>$v)
				{
					echo "<option value='".$state[$r]['id']."'>".$state[$r]['name']."</option>";
				}
			}

			if($_GET['type']=='city')
			{
				$city=$admin->get_cities($_GET['id']);
				foreach($city as $r=>$v)
				{
					echo "<option value='".$city[$r]['id']."'>".$city[$r]['name']."</option>";
				}
			}
		}

		if($_GET['query']=='leads_feedback_save')
		{
			$save=$leads->save_feedback($_POST['id'],$_POST['feedback']);
			if($save)
			{
				echo "<div class='alert alert-success'>Feedback Saved Successfully !!!</div>";
			}
			else
			{	echo "<div class='alert alert-danger'>Something went wrong !!!</div>";}
		}
	}
	break;
//--- leads closed
}
?>

