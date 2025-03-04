
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
			
			$save=$leads->create_new($_POST['company'],$_POST['company_type'],$_POST['groupid'],$_POST['group_remak'],$_POST['userid'],$attachment,$target_date,$_POST['step']);


			
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
				echo "<option disabled='disbaled' selected='selected'>-Select States-</option>";
				foreach($state as $r=>$v)
				{
					echo "<option value='".$state[$r]['id']."'>".$state[$r]['name']."</option>";
				}
			}

			if($_GET['type']=='city')
			{
				$city=$admin->get_cities($_GET['id']);
				echo "<option disabled='disbaled' selected='selected'>-Select Cities-</option>";
				foreach($city as $r=>$v)
				{
					echo "<option value='".$city[$r]['id']."' >".$city[$r]['name']."</option>";
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

		if($_GET['query']=='qulified_lead')
		{
			$update=$leads->update_lead_qualified($_POST['id'],$_POST['qualified']);
			
			//-- send notification to all MD if disqualified
										if($_POST["qualified"]=='1'){$qualified= "Qualified";}
										if($_POST["qualified"]=='2'){$qualified= "Dis-Qualified";}
										
			//-- lead gen to MD
			if($_SESION['utype']=='6')
				{
				$mds=$admin->getonetype_user('9');
				foreach($mds as $r=>$v)
				{$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified",$mds[$r]['id']);}
				exit();
				}

			//-- MD to lead gen
			if($_SESION['utype']=='9')
				{
					//--this time we need lead gen id
					$lead_genid=$lead->get_lead_one($_POST['id']);
					$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified",$lead_genid[0]['handledby']);
				}	

			//--- next step proceed
				
			if($update)
			{echo "<div class='alert alert-success'>Lead Qualified Status Changed Successfully !!!";}
			else{echo "<div class='alert alert-danger'>Something went wrong!!!";}
			
		}

		if($_GET['query']=='qulified_lead')
		{
			$update=$leads->update_lead_qualified($_POST['id'],$_POST['qualified']);
			
			//-- send notification to all MD if disqualified
										if($_POST["qualified"]=='1'){$qualified= "Qualified";}
										if($_POST["qualified"]=='2'){$qualified= "Dis-Qualified";}
										
			//-- lead gen to MD
			if($_SESION['utype']=='6')
				{
				$mds=$admin->getonetype_user('9');
				foreach($mds as $r=>$v)
				{$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified",$mds[$r]['id']);}
				
				}

			//-- MD to lead gen
			if($_SESION['utype']=='9')
				{
					//--this time we need lead gen id
					$lead_genid=$leads->get_lead_one($_POST['id']);
					$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified",$lead_genid[0]['handledby']);
				}	

			//--- next step proceed
				
			if($update)
			{echo "<div class='alert alert-success'>Lead Qualified Status Changed Successfully !!!";}
			else{echo "<div class='alert alert-danger'>Something went wrong!!!";}
			
		}

		//-- company audit by business development manager
		if($_GET['query']=='comp_qulified_lead')
		{
			$update=$leads->update_lead_audit($_POST['id'],$_POST['qualified'],$_POST['audit_by']);
			//-- send notification to all MD if disqualified
			if($_POST["qualified"]=='1'){$qualified= "Approved";}
			if($_POST["qualified"]=='2'){$qualified= "Dis-Approved";}
			//--send notification to lead manager
			$lead_genid=$leads->get_lead_one($_POST['id']);
					$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified by Business devlopment manager",$lead_genid[0]['handledby']);
			//-- send notification to MD 
				$mds=$admin->getonetype_user('9');
				foreach($mds as $r=>$v)
				{$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified",$mds[$r]['id']);}
			//--update the step to 11 and 
				$update=$leads->step_change($_POST['id'],'11');
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[id]&status=1';</script>";

		}

		//-- company audit by MD
		if($_GET['query']=='comp_qulified_lead_md')
		{
			$update=$leads->update_lead_audit_md($_POST['id'],$_POST['qualified']);
			//-- send notification to all MD if disqualified
			if($_POST["qualified"]=='3'){$qualified= "Approved";}
			if($_POST["qualified"]=='4'){$qualified= "Dis-Approved";}
			//--send notification to lead manager
			$lead_genid=$leads->get_lead_one($_POST['id']);
					$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified By MD",$lead_genid[0]['handledby']);
			//-- send notification to MD 
				$mds=$admin->getonetype_user('9');
				foreach($mds as $r=>$v)
				{$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified By MD",$mds[$r]['id']);}
			//--update the step to 11 
				$update=$leads->step_change($_POST['id'],'12');
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[id]&status=1';</script>";

		}

		//-- step changhes
		if($_GET['query']=='step_change')
			{				
				$update=$leads->step_change($_POST['lid'],$_POST['step']);
				$same_page=$_POST['step']-1;
				if($update)
				{
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
				}
				else
				{
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=2';</script>";
				}
			}

			if($_GET['query']=='save_step_9')
			{
				//print_r($_POST);
				//-- save to profile
				$save0=$leads->save_comp_profile($_POST['lid'],$_POST['firstname'],$_POST['lastname'],$_POST['gender'],$_POST['company_now'],$_POST['designation_now'],$_POST['phone'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['zipcode'],$_POST['timezone'],$_POST['dob'],$_POST['family_linkage'],$_POST['religion'],$_POST['goal'],$_POST['point'],$_POST['motivation'],$_POST['channel'],$_POST['current_since']);
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
	
										$save1=$leads->edit_comp_experience($company,$from,$to,$designation,$_POST['lid']);
									}


				//-- send notification to all BDM
				$bdm=$admin->getonetype_user('9');
				foreach($bdm as $r=>$v)
				{$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[id] Has Been $qualified By MD",$bdm[$r]['audit_by']);}

				$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[lid] has been received for Company Profile Audit",$lead_genid[0]['audit_by']);
				//-- update next step
				$leads->step_change($_POST['lid'],'10');
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}	

			if($_GET['query']=='step_12')
			{
					$lid = $_POST['lid'];
					$step= '12';
					$value1_array = $_POST['contact_person'];
					$value2_array = $_POST['contact'];
					
					foreach($value1_array as $key=>$value) 
					{ 
						$value1 = mysqli_real_escape_string($con,  $value1_array[$key]);
						$value2 = mysqli_real_escape_string($con,  $value2_array[$key]);
						//=== save
						$save = $leads->leads_company_more_details ($lid,$step,$value1,$value2); 
					}
					//-- update next step
					
				$leads->step_change($_POST['lid'],'13');
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}

			//--- from step 13
			if($_GET['query']=='step_12_update')
			{
					$id_array = $_POST['id'];
					$value3_array = $_POST['value3'];
					
					foreach($value3_array as $key=>$value) 
					{ 
						$value3 = mysqli_real_escape_string($con,  $value3_array[$key]);
						$id = mysqli_real_escape_string($con,  $id_array[$key]);
						//=== save
						$query="value3=$value3";
						$save = $leads->leads_company_more_details_update ($id,$query); 
						
					}
					//-- update next step
					
				$leads->step_change($_POST['lid'],'13');
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}

			

			//-- update only no step process
			if($_GET['query']=='step_14_update')
			{
				
					$lid = $_POST['lid'];
					$value3_array = $_POST['value3'];
					$value4_array = $_POST['value4'];
					$id_array = $_POST['id'];

					foreach($value3_array as $key=>$value) 
					{ 
						$value3 = mysqli_real_escape_string($con,  $value3_array[$key]);
						$value4 = mysqli_real_escape_string($con,  $value4_array[$key]);
						$id = mysqli_real_escape_string($con,  $id_array[$key]);
						//=== save
						$query="value3='$value3', value4='$value4'";
						$save = $leads->leads_company_more_details_update ($id,$query); 
					}

				
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}
			if($_GET['query']=='step_14')
			{
				$leads->step_change($_POST['lid'],'15');
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}


			//-- ste 15 update
			if($_GET['query']=='step_15_update')
			{
					$lid = $_POST['lid'];
					$value5_array = $_POST['value5'];
					$id_array = $_POST['id'];

					foreach($value5_array as $key=>$value) 
					{ 
						$value5 = mysqli_real_escape_string($con,  $value5_array[$key]);
						$value6 = date("Y-m-d h:i:s");
						$id = mysqli_real_escape_string($con,$id_array[$key]);
						//=== save
						$query="value5='$value5', value6='$value6'";
						$save = $leads->leads_company_more_details_update($id,$query); 
					}

				
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}
			if($_GET['query']=='step_15')
			{
				$leads->step_change($_POST['lid'],'16');
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}

			

			//-- for step 16 to 20
			if($_GET['query']=='step_16to20_update')
			{
					$lid = $_POST['lid'];
					$value3_array = $_POST['value3'];
					$value7_array = $_POST['value7'];
					$value8_array = $_POST['value8'];
					$value9_array = $_POST['value9'];
					$value10_array = $_POST['value10'];
					$value11_array = $_POST['value11'];
					$id_array = $_POST['id'];

					foreach($value7_array as $key=>$value) 
					{ 
						
						$value3 = mysqli_real_escape_string($con,  $value3_array[$key]);

						$value7 = mysqli_real_escape_string($con,  $value7_array[$key]);
						//-- yes or or record date of 7
						if($value7=='1'){$value8=date('Y-m-d h:i:s');}
						else {$value8 = mysqli_real_escape_string($con,  $value8_array[$key]);}

						$value9 = mysqli_real_escape_string($con,  $value9_array[$key]);
						$value10 = mysqli_real_escape_string($con,  $value10_array[$key]);
						$value11 = mysqli_real_escape_string($con,  $value11_array[$key]);
						
						$id = mysqli_real_escape_string($con,$id_array[$key]);
						//=== save
						$query="value3='$value3', value7='$value7', value8='$value8', value9='$value9', value10='$value10', value11='$value11'";
						$save = $leads->leads_company_more_details_update($id,$query); 
					}

				
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}

			//-- upgrade the step only using by other pages too
			if($_GET['query']=='step_16to20')
			{
				$leads->step_change($_POST['lid'],$_POST['step']);
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}

			if($_GET['query']=='step_30to38_update')
			{
				$id_array = $_POST['id'];
				$meeting_date_array = $_POST['meeting_date'];
				$meeting_location_array = $_POST['meeting_location'];
				$meeting_req_array = $_POST['meeting_req'];
				
				$meeting_images_array = $_POST['meeting_images'];
				$meeting_present_array = $_POST['meeting_present'];
				$meeting_status_array = $_POST['meeting_status'];
				$meeting_updates_array = $_POST['meeting_updates'];
				$meeting_call_array = $_POST['meeting_call'];
				$meeting_updates2_array = $_POST['meeting_updates2'];
				$meeting_intouch_array = $_POST['meeting_intouch'];
				$meeting_drip_array = $_POST['meeting_drip'];

				foreach($id_array as $key=>$value) 
				{ 
					$meeting_date = mysqli_real_escape_string($con,  $meeting_date_array[$key]);
					$meeting_location = mysqli_real_escape_string($con,  $meeting_location_array[$key]);
					$meeting_req = mysqli_real_escape_string($con,  $meeting_req_array[$key]);
					//--multi images
					$meeting_images = mysqli_real_escape_string($con,  $meeting_images_array[$key]);
					$file=array();
						if(isset($_FILES[$meeting_images]))
						{		
							foreach($_FILES[$meeting_images]['name'] as $k=>$v)
							{
								$file[] = $admin->upload_file_multi($_FILES[$meeting_images]['name'][$k],$_FILES[$meeting_images]['tmp_name'][$k]);
							}
						}
						$meeting_images = implode(",",($file));

					
					$meeting_present = mysqli_real_escape_string($con,  $meeting_present_array[$key]);
					$meeting_status = mysqli_real_escape_string($con,  $meeting_status_array[$key]);
					$meeting_updates = mysqli_real_escape_string($con,  $meeting_updates_array[$key]);
					$meeting_call = mysqli_real_escape_string($con,  $meeting_call_array[$key]);
					$meeting_updates2 = mysqli_real_escape_string($con,  $meeting_updates2_array[$key]);
					$meeting_intouch = mysqli_real_escape_string($con,  $meeting_intouch_array[$key]);
					$meeting_drip = mysqli_real_escape_string($con,  $meeting_drip_array[$key]);

					$id = mysqli_real_escape_string($con,$id_array[$key]);
			
					$query="meeting_date='$meeting_date', meeting_location='$meeting_location', meeting_req='$meeting_req', meeting_images='$meeting_images', meeting_present='$meeting_present', meeting_location='$meeting_location', meeting_status='$meeting_status', meeting_updates='$meeting_updates', meeting_call='$meeting_call', meeting_updates2='$meeting_updates2', meeting_intouch='$meeting_intouch',meeting_drip='$meeting_drip' ";
					
					$save = $leads->leads_company_more_details_update ($id,$query); 

					//-- send meeting notification to MD
					$lead_genid=$leads->get_lead_one($_POST['lid']);
					
					$mds=$admin->getonetype_user('9');
					foreach($mds as $r=>$v)
					{$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[lid] Has Been Schduled on $meeting_date at $meeting_location",$mds[$r]['id']);}
					//-- send notification to BDM
					$admin->save_alerts($_SESSION['uid'],"Lead #SHL$_POST[lid] Has Been Schduled on $meeting_date at $meeting_location",$lead_genid[0]['audit_by']);
				}

				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";
			}

			//-- upgrade the step only using by other pages too
			if($_GET['query']=='step_30to38')
			{
				//-- send notification to BDM
				$admin->save_alerts($_SESSION['uid'],$_POST['msg'],$_POST['msgto']);
				$leads->step_change($_POST['lid'],$_POST['step']);
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=leads_feedback&id=$_POST[lid]&status=1';</script>";

				//-- save grapic designer in leads table if step = 32
				if($_POST['step']=='32')
				{
					$leads->save_leads_gd($_POST['lid'],$_POST['msgto']);
				}

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

				if($_GET['query']=='prospect1')
				{		
					//--0 is btype (means its a prospect)
					$save=$sales->create_beneficiery($_POST['fname'],$_POST['lname'],$_POST['phone'],$_POST['email'],$_POST['cname'],$_POST['ctype'],$_POST['designation'],$_POST['address'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['zipcode'],$_POST['regtype'],$_POST['regnu'],'0');
					if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_addprospect&status=1&id=".$save."';</script>";}   
						else
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_addprospect&status=2&id=".$save."';</script>";}
				}
		
				if($_GET['query']=='prospect2')
				{
					$bid = $_POST['bid'];
					$value1 = $_POST['value1'];
					$value2 = $_POST['value2'];
					
					//-- if value 1 is array
					if(is_array($value1))
					{
						foreach($value1 as $key=>$value) 
									{ 
										$value1_single = mysqli_real_escape_string($con,$value1[$key]);
										$value2_single = mysqli_real_escape_string($con,$value2[$key]);
										//=== save
										$save = $sales->beneficiery_details($bid,$value1_single,$value2_single); 
										
									}
									
					}
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_addprospect&status=1&id=".$bid."&tab=profile12';</script>";
				}
				
				
				
				
				if($_GET['query']=='prospect3')
				{
					$save=$sales->sales_prospect_type($_POST['id'],$_POST['type_of_client']);
					if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_addprospect&status=1&id=".$_POST['id']."';</script>";}   
						else
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_addprospect&status=2&id=".$_POST['id']."';</script>";}
				}

				if($_GET['query']=='prospect3_1')
				{
					print_r($_POST);
					$save=$sales->sales_prospect_tandc($_POST['pid'],$_POST['incoterms'],$_POST['shipping'],$_POST['shipping-basis'],$_POST['currency'],$_POST['liability'],$_POST['liability_per'],$_POST['advance'],$_POST['advance_per'],$_POST['no_advance'],$_POST['further_advance_per0'],$_POST['further_advance_per_val'],$_POST['further_advance0'],$_POST['further_advance_val'],$_POST['balance'],$_POST['credit_period'],$_POST['retention_period'],$_POST['progress_payment'],$_POST['document'],$_POST['document2'],$_POST['price_validity'],$_POST['audit1'],$_POST['Existing_not_acceptable_val'],$_POST['ctpat'],$_POST['lateshipment_per'],$_POST['lateshipment_max_per'],$_POST['repair_labour_rate'],$_POST['repair_labour_rate_after'],$_POST['repair_labour_rate_limit'],$_POST['commission_to'],$_POST['commision_name'],$_POST['commision_per'],$_POST['sample'],$_POST['sample_paid_foc_qty'],$_POST['photography'],$_POST['photography_qty'],$_POST['packing'],$_POST['product_testing'],$_POST['product_testing_paid'],$_POST['packing_testing'],$_POST['fsc'],$_POST['fsc_current'],$_POST['fsc_target'],$_POST['branding'],$_POST['branding_req']);
					if($save)
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_addprospect&status=1&id=".$_POST['pid']."';</script>";}   
						else
						{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_addprospect&status=2&id=".$_POST['pid']."';</script>";}
				}

				//----------------- rfq only
				if($_GET['query']=='rfq_additem')
				{
					$created_by = $_SESSION['uid'];
					$sid=$sales->rfq_step0($_POST['prospect'],$_POST['rfq_number'],$_POST['date_of_rfq'],$_POST['created_date'],$created_by);

					$sku=$_POST['sku'];
					$item_type=$_POST['item_type'];
					foreach($sku as $key=>$value) 
									{ 
										$sku_single = mysqli_real_escape_string($con,$sku[$key]);
										$item_type_single = mysqli_real_escape_string($con,$item_type[$key]);
										//=== save
										$save = $sales->rfq_items($sku_single,$item_type_single,$sid); 
										
									}

						echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=1&id=".$sid."';</script>";
				}

				if($_GET['query']=='rfq_item_edit')
				{
					
					$sales->rfq_step0_edit($_POST['prospect'],$_POST['rfq_number'],$_POST['date_of_rfq'],$_POST['created_date'],$_POST['id']);
					$sid=$_POST['id'];
					$sku=$_POST['sku'];
					$item_type=$_POST['item_type'];
					$item_id=$_POST['itemid'];
					foreach($sku as $key=>$value) 
									{ 
										$sku_single = mysqli_real_escape_string($con,$sku[$key]);
										$item_type_single = mysqli_real_escape_string($con,$item_type[$key]);
										$item_id_single = mysqli_real_escape_string($con,$item_id[$key]);
										//=== save
										if(empty($item_id_single))
										{$save = $sales->rfq_items($sku_single,$item_type_single,$sid);}
										else{$save = $sales->rfq_items_edit($sku_single,$item_type_single,$item_id_single); }										
									}

									echo "<div class='alert alert-success'>RFQ Updated Successfully</div>";
				}

				if($_GET['query']=='step0_edit_items_client')
				{
					$sid=$_POST['sid'];
					$sku=$_POST['tempsku'];
					$item_type=$_POST['item_type'];
					

					foreach($sku as $key=>$value) 
									{ 
										$sku_single = mysqli_real_escape_string($con,$sku[$key]);
										$item_type_single = mysqli_real_escape_string($con,$item_type[$key]);
										
										//--file upload
										$filename=$admin->upload_file_multi($_FILES['file']['name'][$key],$_FILES['file']['tmp_name'][$key]);
										//-- temp save
										$pid=$product->tempsave($sku_single,$filename);
										//=== save
										$save = $sales->rfq_items_2($pid,$item_type_single,$sid,$filename); 
										
									}

						echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=1&id=".$sid."';</script>";

				}

				if($_GET['query']=='delete_rfq_item')
				{
					$id=$_GET['id'];
					$save=$sales->delete_rfq_item($id);
				}

				if($_GET['query']=='rfq_step05_edit')
				{
					$sid=$_POST['sid'];
					$itemid=$_POST['itemid'];
					$length=$_POST['length'];
					$width=$_POST['width'];
					$height=$_POST['height'];
					//-- additional 
					$wood=$_POST['wood'];
					$fitting=$_POST['fitting'];
					$finish=$_POST['finish'];
					$packing=$_POST['packing'];
					$branding=$_POST['branding'];

					

					foreach($itemid as $key=>$value) 
									{ 
										$itemid_single = mysqli_real_escape_string($con,$itemid[$key]);
										$length_single = mysqli_real_escape_string($con,$length[$key]);
										$width_single = mysqli_real_escape_string($con,$width[$key]);
										$height_single = mysqli_real_escape_string($con,$height[$key]);
										$wood_single = mysqli_real_escape_string($con,$wood[$key]);
										$fitting_single = mysqli_real_escape_string($con,$fitting[$key]);
										$finish_single = mysqli_real_escape_string($con,$finish[$key]);
										$packing_single = mysqli_real_escape_string($con,$packing[$key]);
										$branding_single = mysqli_real_escape_string($con,$branding[$key]);
										
										//=== update
										$save = $sales->rfq_step0_5_update($itemid_single,$length_single,$width_single,$height_single,$sid,$wood_single,$fitting_single,$finish_single,$packing_single,$branding_single); 
										
									}

						echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=3&id=".$sid."';</script>";
				}

				if($_GET['query']=='rfq_step08_edit')
				{
					$sid=$_POST['sid'];
					$itemid=$_POST['itemid'];
					$price=$_POST['price'];
					$sprice=$_POST['sprice'];
					$bom=$_POST['bom'];
					$temp = rand(1000,9999);
					

					foreach($itemid as $key=>$value) 
									{ 
										//--file upload
										$filename=$admin->upload_file_multi($_FILES['sfile']['name'][$key],$_FILES['sfile']['tmp_name'][$key]);
										//-- temp save
										//$pid=$product->tempsave($sku_single,$filename);

										$itemid_single = mysqli_real_escape_string($con,$itemid[$key]);
										$price_single = mysqli_real_escape_string($con,$price[$key]);
										$sprice_single = mysqli_real_escape_string($con,$sprice[$key]);
										$bom_single = mysqli_real_escape_string($con,$bom[$key]);
										
										
										//=== update
										$save = $sales->rfq_step0_8_update($itemid_single,$price_single,$sprice_single,$bom_single,$filename,$sid); 
										
									}

						echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=1&id=".$sid."';</script>";
				}

				if($_GET['query']=='rfq_step1_edit')
				{
					$sid=$_POST['sid'];
					$save=$sales->rfq_step1_edit($sid);
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=1&id=".$sid."';</script>";
				}

				if($_GET['query']=='rfq_step2_edit')
				{
					$sid=$_POST['sid'];
					$itemid=$_POST['itemid'];
					$price=$_POST['price'];
					$moq=$_POST['moq'];
					$repeat_pa=$_POST['repeat_pa'];
					$plc = $_POST['plc'];
					

					foreach($itemid as $key=>$value) 
									{ 
										$itemid_single = mysqli_real_escape_string($con,$itemid[$key]);
										$price_single = mysqli_real_escape_string($con,$price[$key]);
										$moq_single = mysqli_real_escape_string($con,$moq[$key]);
										$repeat_pa_single = mysqli_real_escape_string($con,$repeat_pa[$key]);
										$plc_single = mysqli_real_escape_string($con,$plc[$key]);
										
										
										//=== update
										$save = $sales->rfq_step2_update($itemid_single,$price_single,$moq_single,$repeat_pa_single,$plc_single,$sid); 
										
									}

						echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=3&id=".$sid."';</script>";
				}	
				
				if($_GET['query']=='rfq_step3_edit')
				{
					$sid=$_POST['sid'];
					$save=$sales->rfq_step3_edit($sid);

				//-- send notification to MD 
				$mds=$admin->getonetype_user('9');
				foreach($mds as $r=>$v)
				{$admin->save_alerts($_SESSION['uid'],"RFQ #SHL-RFQ-$_POST[id] Has Been Send For Reveiew",$mds[$r]['id']);}

					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=1&id=".$sid."';</script>";
				}

				if($_GET['query']=='rfq_step4_edit_discount')
				{
					$sid=$_POST['sid'];
					$itemid=$_POST['itemid'];
					$discount=$_POST['discount'];
					$discount_amt=$_POST['discount_amt'];
					
					foreach($itemid as $key=>$value) 
						{ 
							$itemid_single = mysqli_real_escape_string($con,$itemid[$key]);
							$discount_single = mysqli_real_escape_string($con,$discount[$key]);
							$discount_amt_single = mysqli_real_escape_string($con,$discount_amt[$key]);
							
							//=== update
							$save = $sales->rfq_step4_discount($itemid_single,$discount_single,$discount_amt_single,$sid); 
							
						}

						echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=3&id=".$sid."';</script>";
				}

				if($_GET['query']=='rfq_step4_edit')
				{
					$sid=$_POST['sid'];
					$save=$sales->rfq_step4_edit($sid);
						echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=1&id=".$sid."';</script>";
				}

				if($_GET['query']=='rfq_step6_edit')
				{
					$sid=$_POST['sid'];
					$save=$sales->rfq_step5_edit($sid);
					//-- send notification to MD 
					$mds=$admin->getonetype_user('9');
					foreach($mds as $r=>$v)
					{$admin->save_alerts($_SESSION['uid'],"RFQ #SHL-RFQ-$_POST[id] Has Been Send Submitted to Client",$mds[$r]['id']);}

					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=sales_rfq_edit&status=1&id=".$sid."';</script>";
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

				if($_GET['query']=='add_ticket')
				{
					$save=$admin->add_ticket($_POST['subject'],$_POST['description'],$_FILES['img'],$_POST['uid']);
					if($save)
					{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=support_tickets&status=1';</script>";}   
						else{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=support_tickets&status=2';</script>";}
				}

				if($_GET['query']=='add_ticket2')
				{
					$save=$admin->add_ticket2($_POST['description'],$_POST['tid']);
					if($save)
					{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=view_ticket&status=3&id=".$_POST['tid']."';</script>";}   
						else{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=view_ticket&status=2&id=".$_POST['tid']."';</script>";}
				}

				if($_GET['query']=='ticket_close')
				{
					$save=$admin->ticket_close($_POST['tid']);
					if($save)
					{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=support_tickets&status=8';</script>";}   
						else{echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=support_tickets&status=2';</script>";}
				}
			}
		}	
		break;
//-- admin close	
	


//-- hr open
case "hr":
	if($_GET['action']=='hr')
	{
		
	}
	break;

//-- products open
case "product":
	if($_GET['action']=='product')
	{
		if($_GET['query']=='get_details')
		{
			
			$id=$_GET['id'];
			$details=$product->getone($id);
			if($details)
			{
					echo "<table border='1' style='font-size:11px;'><tr><th>Name</th><td>".$details[0]['product_name']."</td></tr>";					
					echo "<tr><th>Dimension</th><td>".$details[0]['width_cm'].' x '.$details[0]['depth_cm'].' x '.$details[0]['height_cm'].' (CM) <br>';
					echo $details[0]['width_inch'].' x '.$details[0]['depth_inch'].' x '.$details[0]['height_inch'].' (INCH)</td></tr>';
					echo "<tr><th>Finish</th><td>".$details[0]['finish']."</td></tr><tr><th>Material</th><td>".$details[0]['material']."</td></tr>";
				echo "</table>";
			}
			else
			{echo "No data found";}

		}	
		
	}
	break;




}

?>

