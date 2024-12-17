
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

		//-- from masters 
		if($_GET['query']=='add-customer-type')
				{
					
						$save = $admin->create_meta($_POST['metaname'],$_POST['value1'],$_POST['value2'],'0'); 
						if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_customertype&status=1';</script>";}   
						else{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_customertype&status=2';</script>";}
				}


		if($_GET['query']=='create_new')
		{
			$file=array();
			if(isset($_FILES['attachment']))
			{		
				foreach($_FILES['attachment']['name'] as $k=>$v)
				{
					$file[] = $admin->upload_file_multi($_FILES['attachment']['name'][$k],$_FILES['attachment']['tmp_name'][$k]);
				}
			}
			$attachment = implode(",",($file));

			$save=$leads->create_new($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['designation'],$_POST['req'],$_POST['group_remark'],$attachment,$_POST['company'],$_POST['address'],$_POST['groupid'],$_POST['handledby'],$_POST['company_type']);


			
			if($save)
			{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_addnew&status=1';</script>";}
			else
			{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_addnew&status=2';</script>";}


		}

		if($_GET['query']=='edit_lead')
		{
			
			
			$save=$leads->edit_lead($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['designation'],$_POST['req'],$_POST['lp_url'],$_POST['form_id'],$_POST['company'],$_POST['status'],$_POST['id']);
			if($save)
			{echo "<div class='alert alert-success'>Lead Edited Successfully !!!</div>";}
			else
			{echo "<div class='alert alert-danger'>Something went wrong !!!</div>";}
		}

		
		if($_GET['query']=='create_group')
		{
			prinT_r($_POST);
			$save=$leads->create_group($_POST['gname'],$_POST['parent_group'],$_POST['lead_confirm_time'],$_POST['per_day_lead'],$_POST['color_code']);
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
			$save=$leads->save_feedback($_POST['id'],$_POST['feedback'],$_POST['status'],$_POST['next_feedback'],$_POST['qualified'],$_POST['feedback_type']);
			if($save)
			{
				echo "<div class='alert alert-success'>Feedback Saved Successfully !!!</div>";
			}
			else
			{	echo "<div class='alert alert-danger'>Something went wrong !!!</div>";}
		}

		if($_GET['query']=='upload_csv')
		{
			
			$header=array();
			$bodyrow=array();
			$row = 1;
			$data='';
			$data0='';
			if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
				
				//--- update latest uploads
				

				//--- set header
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					//echo "<p> $num fields in line $row: <br /></p>\n";
					$row++;
					
					//-- add group id & handledby
					array_push($header,'group_id');
					array_push($header,'handledby');
					array_push($header,'company_type');

					//-- add header into array
					for ($c=0; $c < $num; $c++) {
						//echo $data[$c] . "<br />\n";
						array_push($header,$data[$c]);
					}
					
					
					if($row='1')
					{break;}
				}

				//----------  save row
				while (($data0 = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data0);
					//echo "<p> $num fields in line $row: <br /></p>\n";
					$row++;
					
					//-- add group id & handledby & company_type
					array_push($bodyrow,$_POST['group']);
					array_push($bodyrow,$_POST['userid']);
					array_push($bodyrow,$_POST['company_type']);

					//-- add header into array
					for ($c=0; $c < $num; $c++) {
						//echo $data0[$c] . "<br />\n";
						//-- replace special characters
						$data_str=str_replace( array( '\'', '"',',' , ';', '<', '>' ), ' ', $data0[$c]);
						array_push($bodyrow,$data_str);
					}
					
					$save=$leads->save_csv_records($header,$bodyrow);
					
					//-- empty the bodyrow
					$bodyrow = [];
				}
				
				//- save hostiry
				$upload_details = $leads->upload_csv_details($_FILES['file']['name'],$row,$_POST['userid'],$_POST['group']);
				//- save alerts / notification
				$admin->save_alerts($_SESSION['uid'],'Lead Data Has Been Uploaded',$_POST['userid']);
				//-- close
				fclose($handle);

				

			}
			echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_bulkupload&status=1';</script>";
		}
	}
	break;
//--- leads closed


//-- sales open
case "sales":
	if($_GET['action']=='sales')
	{
		if($_GET['query']=='add-meta')
				{
						if($_POST['parent_meta'])
						{$save = $admin->create_meta_withparent($_POST['metaname'],$_POST['value1'],$_POST['value2'],'0',$_POST['parent_meta'],$_POST['final_step']); }
						else
						{$save = $admin->create_meta($_POST['metaname'],$_POST['value1'],$_POST['value2'],'0'); }
						
						if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=".$_POST['pagename']."&status=1';</script>";}   
						else
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=".$_POST['pagename']."&status=2';</script>";}
				}
		if($_GET['query']=='get_outcome')
				{		
					$details=$admin->get_metaname_byid($_GET['stage']);
					$details0=explode(',',$details[0]['value2']);
					foreach($details0 as $r)
					{
						echo "<option value='".$r."'>".$r."</option>";
					}
				}
		if($_GET['query']=='get_status')
				{		
					$details=$admin->get_metaname_byparent($_GET['stage']);
					foreach($details as $r=>$v)
					{
						$final = $details[$r]['final_step'];
						echo "<option value='".$details[$r]['value2']."'>";
						if($final=='1'){$final='<i class="badge badge-primary">(Final)</i>';}else{$final='';}
						echo $details[$r]['value1'].$final.'</option>';
					}
				}
		if($_GET['query']=='sales_feedback_save')
				{
					$save=$sales->save_sales_feedback($_POST['sales_lid'],$_POST['feedback'],$_POST['status'],$_POST['stage'],$_POST['outcome'],$_POST['handledby'],$_POST['next_feedback_date']);
						if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_feedback&status=1&id=".$_POST['sales_lid']."';</script>";}   
						else
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_feedback&status=2&id=".$_POST['sales_lid']."';</script>";}
				}						
	}
	break;
//-- sales close



//-- admin
case "admin":
		if($_GET['action']=='admin')
		{
			if (isset($_GET['query']))
			{
				//===== insert
				if($_GET['query']=='add-meta')
				{
					
						$save = $admin->create_meta($_POST['metaname'],$_POST['value1'],$_POST['value2'],$_POST['editable']); 
						if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_meta&status=1';</script>";}   
						else{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_meta&status=2';</script>";}
				}

				//======= edit 
				if($_GET['query']=='edit-meta')
				{
						$save = $admin->edit_meta($_POST['metaname'],$_POST['value1'],$_POST['value2'],$_POST['editable'],$_POST['id']); 
						if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_meta&status=3';</script>";}   
						else{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_meta&status=2';</script>";}
				}
			}
		}	
//-- admin close	
	




}
?>

