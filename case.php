
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
			
			//--get targeted date
			if(isset($_POST['targetted_date']))
			{ $target_date=$_POST['targetted_date'];}
			else
			{
			$target_date = $leads->get_group_one($_POST['groupid']);
			$target_date = $target_date[0]['lead_confirm_time'];
			$date_now=date('Y-m-d');
			$target_date = date('Y-m-d', strtotime($date_now. '+'.$target_date.' days')); 

			}
			
			$save=$leads->create_new($_POST['company'],$_POST['company_type'],$_POST['groupid'],$_POST['group_remak'],$_POST['userid'],$attachment,$target_date);


			
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
			//header('Content-Type: application/json; charset=utf-8');

			$header=array();
			$bodyrow=array();
			$bodyrow2=array();
			$row = 1;
			$data='';
			$data0='';
			$column_names=array();
			$no_header=array();
			$yes_header=array();
			$no_column=array();
			$yes_column=array();
			//-- add columns in array
			$table_header=$admin->check_table_column('leads');
					foreach($table_header as $r=>$v)
					{
						array_push($column_names,$table_header[$r]['Field']);
					}


			if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
				
				//--- set header
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					
					$row++;
					
					//-- add group id & handledby [ACTUAL]
					$x=array("column_nu"=>'x',"column_data"=>'group_id');	
					array_push($yes_header,$x);		
					$y=array("column_nu"=>'y',"column_data"=>'handledby');				
					array_push($yes_header,$y);	
					$z=array("column_nu"=>'z',"column_data"=>'targetted_date');					
					array_push($yes_header,$z);					

					

					//-- add header into array
					for ($c=0; $c < $num; $c++) {
					
						//-- check column exist or not
								
						if (in_array($data[$c],$column_names)) {							
						
							//multi dimension array for column nu chech
							$yes_header0=array("column_nu"=>$c,"column_data"=>$data[$c]);	
							array_push($yes_header,$yes_header0);	
							//echo "Yes! " . $data[$c] . " is present in the table!<br>";				
						}
						else
						{
							$no_header0=array("column_nu"=>$c,"column_data"=>$data[$c]);	
							array_push($no_header,$no_header0);	
							//array_push($no_header,$data[$c]);
						}						
						
					}
					
					//-- insert header in leads2
					$leads2_header=$leads->save_csv_records2($no_header,'000','header');

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
					array_push($bodyrow,$_POST['targetted_date']);

					//-- count nu of yes header
					$no_header_first = count($yes_header)-4; //becoz 3 (groupid, handledby and targetted day)
					
					//-- add yes header into array
					for ($c=0; $c < $num; $c++) {
						//echo $data0[$c] . "<br />\n";
						//-- replace special characters
						$data_str=str_replace( array( '\'', '"',',' , ';', '<', '>' ), ' ', $data0[$c]);
						
						
						array_push($bodyrow,$data_str);

						//--- todo (column count nu of no_header)
							
							if($no_header_first == $c)
							{$d=$c+1; break;} // $c+1 for correct record

						//-- save row as per the column 
						
					}
					
					$yes_header_col = implode(', ', array_map(function ($entry) {
						    return $entry['column_data'];
						  }, $yes_header));

					$max_id = $leads->save_csv_records($yes_header_col,$bodyrow);

					
					
					
					//-- insert other fileds in details 2 table	
					
					for ($e=$d; $e < $num; $e++) {
						$data_str=str_replace( array( '\'', '"',',' , ';', '<', '>' ), ' ', $data0[$e]);
						$data_str0=array("column_nu"=>$e, "column_data"=>$data_str);
						array_push($bodyrow2,$data_str0);
					}
					
					
					$details2 = $leads->save_csv_records2($bodyrow2,$max_id,'data');
					
					//-- empty the bodyrow
					$bodyrow = [];
					$bodyrow2 = [];
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

		// if($_GET['query']=='get_company_info')
		// 		{		
		// 			$details0=$admin->get_metaname_byvalue1($_GET['meta_name'],$_GET['detail2']);
		// 			foreach($details0 as $r=>$v)
		// 			{
		// 				echo "<option value='".$details0[$r]['value2']."'>".$details0[$r]['value2']."</option>";
		// 			}
		// 		}


		//-- getting value 3
		if($_GET['query']=='get_company_info')
		{		
			
			$details0=$admin->get_metaname_byvalue2($_GET['meta_name'],$_GET['id']);
			foreach($details0 as $k=>$v)
			{
				$type=$details0[$k]['value2_input'];
					if($type=='radio')
					{
						
						$details0=$admin->get_metaname_byvalue_multi_group($details0[$k]['meta_name'],$details0[$k]['value2'],'value2','value3');
						?>
						
						<select id="<?php echo $details0[0]['id'];?>" name="value2[]" class='form-control' onchange="get_details('<?php echo $details0[0]['id'];?>','<?php echo str_replace(' ','_',$details0[$k]['value2']);?>result2','<?php echo $base_url.'index.php?action=leads&query=get_company_info2&meta_name=lead_company_info&id=';?>')">
						<?php 
						echo "<option disabled='disabled' selected='selected'>-Select-</option>";
						$i=1;
						
							foreach($details0 as $k=>$v){
								echo "<option value='".$details0[$k]['value3']."'>".$details0[$k]['value3']."</option>";
							}
						echo "</select>";
						
						//-- becuase all select box repeating		
						break;
					}
					elseif($type=='checkbox')
					{?>
						<input id='<?php echo $details0[$k]['id'];?>text2' type='checkbox' name='value2[]' value='<?php echo $details0[$k]['value3'];?>' onclick="get_details('<?php echo $details0[$k]['id'];?>text2','<?php echo $details0[$k]['id'];?>result3','<?php echo $base_url.'index.php?action=leads&query=get_company_info2&meta_name=lead_company_info&id=';?>')">

						<label for='<?php echo $details0[$k]['id'];?>text2' ><?php echo $details0[$k]['value3'];?></label>
						<div id='<?php echo $details0[$k]['id'];?>result3'>
							 <!-- 	 -->
						</div>
						<hr>
					<?php }
					elseif($type=='textarea')
					{
						//-- label will be of 3 and input will be of 2
						echo "<label>".$details0[$k]['value3']."</label>";
						echo "<textarea col='5' row='4' name='value2[]' class='form-control'></textarea>";
						if($details0[$k]['value3']=='')
						{echo "<input type='hidden' name='value3[]'>";}
					}
					else
					{	
						if($details0[$k]['value2']=='Not Disclosed' || $details0[$k]['value2']=='Not Known'){}
						else {echo "<textarea col='5' row='4' name='value2' class='form-control'></textarea>";}
					}
			}
				
		}

		if($_GET['query']=='get_company_info2')
		{
			//-- check value 4 category
			//print_r($_GET);
			$details0=$admin->get_metaname_byvalue3($_GET['meta_name'],$_GET['id']);

			//-- get value 3
			//-- if value 3 is blank thats mean there is no multi  value4 availble stop here and cancel the loop
			$details1=$admin->get_metaname_byvalue_multi_group($details0[0]['meta_name'],$details0[0]['value2'],'value2','value3');
			if($details1[0]['value2']=='Not Known' || $details1[0]['value2']=='Not Disclosed')
			{}
			else if($details1[0]['value3']=='')
			{   
				//echo "<input type='text' name='value3[]' class='form-control'>";
			}

			//-- if value 3 is not blank    
			else
			{  
			   $value4_type=$details1[0]['value4_input'];
			   $value4=unserialize($details1[0]['value4']);
			   $value4=explode(",",$value4);
			   //-- change input type by for each
			   if($value4_type=='radio')
			   {
				echo "<select name='value3[]' class='form-control'>";
				echo "<option disbaled='disbaled' selected='selected'>-Select-</option>";
					foreach($value4 as $r)
					{
						echo "<option value='".$r."'>".$r."</option>";
					}
				echo "</select>";
			   }
			  
			}       
		}

		if($_GET['query']=='fileviewer')
				{
					echo '<object data="'.$base_url.'images/'.$_GET['file'].'" width="100%" height="auto"></object>';
				}	
				
		if($_GET['query']=='save_company_details')
		{
			//print_r($_POST);

					$lid = $_POST['lid'];
					$details = $_POST['details'];
					$value1 = $_POST['value1'];
					$value2 = $_POST['value2'];
					if(isset($_POST['value3'])){$value3 = $_POST['value3'];}else{$value3='';}
					if(isset($_POST['value4'])){$value4 = $_POST['value4'];}else{$value4='';}

					//-- if value 1 is array
					if(is_array($value1))
					{
						foreach($value1 as $key=>$value) 
									{ 
										$value1_single = mysqli_real_escape_string($con,$value1[$key]);
										$value2_single = mysqli_real_escape_string($con,$value2[$key]);
										if(is_array($value3))
										{$value3_single = mysqli_real_escape_string($con,$value3[$key]);}
										//=== save
										$save = $leads->leads_save_company_details($lid,$details,$value1_single,$value2_single,$value3_single,$value4); 
										
									}
									echo "<div class='alert alert-success'>Detail Saved !!!</div>"; 	
					}
					else
					{
						$save = $leads->leads_save_company_details($lid,$details,$value1,$value2,$value3,$value4); 
						if(!$save)
						{
							echo "<div class='alert alert-danger'>Something went wrong !!</div>";
						}
						else
						{
							echo "<div class='alert alert-success'>Detail Saved !!!</div>"; 	
						}
					}
			
						
		}
		if($_GET['query']=='company_research')		
		{
					$metaname = $_POST['meta_name'];
					$value1 = $_POST['value1'];
					$value1_input = $_POST['input_type_value1'];
					$value2 = $_POST['value2'];
					$value2_input = $_POST['input_type_value2'];
					$value3_array = $_POST['value3'];
					$value4_array = $_POST['value4'];
					$value3_input_array = $_POST['input_type_value3'];
					$value4_input_array = $_POST['input_type_value4'];
					
					
					if(isset($_POST['value3']))
					{
									foreach($value3_array as $key=>$value) 
									{ 
										$value3 = mysqli_real_escape_string($con,  $value3_array[$key]);
										$value4 = mysqli_real_escape_string($con,  $value4_array[$key]);
										$value3_input = mysqli_real_escape_string($con,  $value3_input_array[$key]);
										$value4_input = mysqli_real_escape_string($con,  $value4_input_array[$key]);

										$value4 = explode(",",$value4);
										
										$value4=serialize($value4);
										//=== save
										$save = $leads->meta_lead_company_details($metaname,$value1,$value2,$value3,$value4,$value1_input,$value2_input,$value3_input,$value4_input); 
									}
					}
					else
					{
						$save = $leads->meta_lead_company_details($metaname,$value1,$value2,'','',$value1_input,$value2_input,'',''); 
					}

					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=lead_add_company_info&status=1';</script>"	;	
		}

		if($_GET['query']=='delete_company_info')		
		{ $delete = $admin->delete_meta($_GET['id']);}

		if($_GET['query']=='lead_edit_company_info_update')
		{	
			$value4=explode(",",$_POST['value4']);
			$value4=serialize($value4);
			$update=$leads->update_meta_company($_POST['value1'],$_POST['value2'],$_POST['value3'],$value4,$_POST['value2_input'],$_POST['value3_input'],$_POST['value4_input'],$_POST['id']);
			if($update)
			{echo "<div class='alert alert-success'>Updated Successfully !!!";}
			else{echo "<div class='alert alert-danger'>Something went wrong!!!";}
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

				if($_GET['query']=='create_user')
				{
					$save=$admin->create_user($_POST['uname'],$_POST['upass'],$_POST['utype'],$_POST['email'],$_POST['contact'],$_POST['person_name']);
					if($save)
					{echo "<div class='alert alert-success'>User Created Successfully</div>";}
					else
					{echo "<div class='alert alert-danger'>Something went wrong !! Please try again later !!</div>";}
						
				}
			}
		}	
		break;
//-- admin close	
	


//-- sales open
case "hr":
	if($_GET['action']=='hr')
	{
		if($_GET['query']=='save_emp_profile')
		{
			
			//-- save to user
			$save=$admin->edit_user($_POST['uname'],$_POST['upass'],$_POST['utype'],$_POST['uemail'],$_POST['ucontact'],$_POST['person_name'],$_POST['uid']);
			//-- save to profile
			$save0=$hr->edit_profile($_POST['gender'],$_POST['company_now'],$_POST['location'],$_POST['religion'],$_POST['dob'],$_POST['family_linkage'],$_POST['goal'],$_POST['motivation'],$_POST['channel'],$_POST['current_since'],$_POST['uid']);
			//-- save to experience
					$designation_array = $_POST['designation'];
					$from_array = $_POST['from'];
					$to_array = $_POST['to'];
					$company_array = $_POST['company'];
	 				for ($i = 0; $i < count($designation_array); $i++) 
								{
									$company = mysqli_real_escape_string($con, $company_array[$i]);
									$from = mysqli_real_escape_string($con, $from_array[$i]);
									$to = mysqli_real_escape_string($con, $to_array[$i]);
									$designation = mysqli_real_escape_string($con, $designation_array[$i]);

									$save1=$hr->edit_emp_experience($company,$from,$to,$designation,$_POST['uid']);
								}

			
			echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=hr_emp_profile&status=1&id=".$_POST['uid']."';</script>";
		}
	}
	break;



}

?>

