<?php $query=$leads->get_lead_one($_GET['id']);
$query2=$leads->get_lead_last_feedback($_GET['id']);
//-- get feedback type from custoomer_type meta
$feedback_type=$admin->get_metaname_byvalue1('lead_customer_type',$query[0]['company_type']);
?>

<div class="content-wrapper">
	  <div class="container-full">


									<div class="content-header">
											<div class="d-flex align-items-center">
												<div class="mr-auto">
													<h3 class="page-title">Single Lead</h3>
													<div class="d-inline-block align-items-center">
														<nav>
															<ol class="breadcrumb">
																<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
																<li class="breadcrumb-item" aria-current="page">Leads</li>
																<li class="breadcrumb-item active" aria-current="page">Manage Single Lead</li>
															</ol>
														</nav>
													</div>
												</div>
												
											</div>
										</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">

				<!--- form -->
							
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h4 class="box-title">Lead Details</h4>
							</div>
							<div class="box-body">
								<table class=" table-bordered" width="100%">
									<tr>
										<th>Compnay</th>
										<td><?php echo $query[0]['company'];?></td>
									</tr>
									<tr>
										<th>Type</th>
										<td><?php echo $query[0]['company_type'];?></td>
									</tr>
									<tr>
										<th>Source</th>
										<td><?php $group=$leads->get_group_one($query[0]['group_id']);  echo $group[0]['gname']; ?></td>
									</tr>
									<tr>
										<th>Target Outcome Date :</th>
										<td><?php echo $query[0]['date_time'];?></td>
									</tr>
									<tr>
										<th>Targetted Outcome Number(s) </th>
										<td><?php echo $query[0]['targetted_outcome_with'];?></td>
									</tr>
									<tr>
										<th>Targetted Outcome Detail(s) :</th>
										<td><?php echo $query[0]['targetted_outcome_with_details'];?></td>
									</tr>
									<tr>
										<th>Alloted To :</th>
										<td><?php $uname=$admin->getone_user($query[0]['handledby']); echo $uname[0]['uname']; ?></td>
									</tr>
								</table>
							</div>
						</div>	
					</div>
					
					<div class="col-md-6">
						<div class="row">
							<?php if(empty($query[0]['attachment'])){?>
								<div class="alert alert-warning">No Attachment Found</div>	
							<?php } else { $counter=1; $files=explode(",",$query[0]['attachment']); echo '<h6 class="text-danger col-sm-12">Click to view !!!</h6>'; foreach($files as $r){?>
								<div class="col-sm-2 text-center">
									
									<?php $info = pathinfo($r);
										if ($info["extension"] == "jpg" || $info["extension"] == "png" || $info["extension"] == "webp" || $info["extension"] == "avi" || $info["extension"] == "tiff" || $info["extension"] == "jpeg" ) 
										{ $type="image/".$info["extension"]; $icon='image-area'; $title='Image';}
										elseif ($info["extension"] == "csv")  	
										{ $type="image/".$info["extension"]; $icon='file-delimited'; $title='CSV';}
										elseif ($info["extension"] == "pdf")  	
										{ $type="image/".$info["extension"]; $icon='file-pdf-box'; $title='PDF';}
										elseif ($info["extension"] == "excel")  
										{ $type="image/".$info["extension"]; $icon='microsoft-excel'; $title='Excel';}
										elseif ($info["extension"] == "html")  
										{ $type="image/".$info["extension"]; $icon='code-block-tags'; $title='Html';}
										else
										{ $type="image/".$info["extension"]; $icon='file-cloud-outline'; $title='Others';}
									?>

									<span class="display-4 mdi mdi-<?php echo $icon;?>" data-toggle="modal" data-target="#exampleModal" onclick="show_page_model('File Viewer','<?php echo $base_url.'index.php?action=leads&query=fileviewer&type='.$type.'&file='.$r;?>')" ></span><br><?php echo $counter++.') '.$title;?>
								</div>
							<?php } }?>	

							<!--   -->

							</div>	
					</div>



				</div>	
			</div>
		</section>


<!-- feedback content -->
<section class="content">
	<div class="row">
			<div class="col-sm-12">
					<ul class="nav nav-tabs nav-fill" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home11" role="tab" aria-selected="true"><span><i class="fa fa-info"></i></span> <span class="hidden-xs-down ml-15">Company & Query Detail </span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile11" role="tab" aria-selected="false"><span><i class="fa fa-user"></i></span> <span class="hidden-xs-down ml-15">Followup</span></a> </li>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#msg" role="tab" aria-selected="false"><span><i class="fa fa-comment"></i></span> <span class="hidden-xs-down ml-15">Followup History</span></a> </li>
					</ul>


					<div class="tab-content tabcontent-border">					
<!------------ company list -------->
						<div class="tab-pane active" id="home11" role="tabpanel">
							<div class="p-15 content">
									
									<div class="row">

										<div class="col-md-5">
											<?php 
												if(isset($_GET['lstatus']))
												{
													if($_GET['lstatus']=='1')
													{echo "<div class='alert alert-success'>Company Details Added Successfully !</div>";}
												}
											?>
										<form name="addmore_details" action="<?php echo $base_url.'index.php?action=leads&query=save_company_details';?>" method="post">
											<input type="hidden" name="lid" value="<?php echo $_GET['id'];?>"/>
											<div class="row">		
												
												<div class="col-md-4">
													<div class="form-group">
														<label>Detail 1</label>
														<select name="details[]" class="form-control" id="details1"  onchange="get_details('details1','subdetails1','<?php echo $base_url.'index.php?action=leads&query=get_company_info&meta_name=lead_company_info&detail2='?>')"required>
															<option disabled="disabled" selected="selected" >-- Select --</option>
															<?php $stage=$admin->get_metaname_byvalue_group('lead_company_info');
																foreach($stage as $k=>$v)
																{
																echo "<option value='".$stage[$k]['value1']."' ";
																echo ">".$stage[$k]['value1']."</option>";
																}
																?>
														</select>
													</div>
												</div>


												<div class="col-md-4">
													<div class="form-group">
													<label>Sub Detail 1</label>
													<select name="subdetails[]" class="form-control" id="subdetails1"  required>
													<option disabled="disabled" selected="selected" >-- Select --</option>

													</select>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
													<label>Remark 1</label>
													<input type="text" name="remark" class="form-control">
													</div>
												</div>

												<div class="col-sm-12" id="addmore"></div>
												
												<div class="col-sm-2">
													<input type="button" name="addmore_btn" id="addmore_btn" value="Add More" class="btn btn-secondary btn-sm">
												</div>
												<div class="col-sm-2">
													<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary btn-sm">
												</div>
												
											</div>	
											</form>
										</div>   

										<div class="col-md-7">
											<table class="table table-bordered">
												<tr>
													<th>#</th>
													<th>Title</th>
													<th>Sub Title</th>
													<th>Details</th>
												</tr>
												<?php
												$counter=1;
												$company_details_leads=$leads->get_leads_company_details($_GET['id']);
												foreach($company_details_leads as $r =>$v)
												{
													echo "<tr>";
														echo "<th>".$counter++."</th>";
														echo "<td>".$company_details_leads[$r]['details']."</td>";
														echo "<td>".$company_details_leads[$r]['subdetails']."</td>";
														echo "<td>".$company_details_leads[$r]['remark']."</td>";
													echo "</tr>";
												}
												?>
											</table>
										</div>						
								
									</div>




								</div>
			 			</div>	



<!-- feedback form -->
						<div class="tab-pane" id="profile11" role="tabpanel">
							<div class="p-15">
							
							<h4>Process to handle this lead.</h4>
							<?php 
							$steps = $admin->get_metaname_byvalue1('lead_customer_type',$query[0]['company_type']);
							$steps = explode(',', $steps[0]['value2']); 
							$badge=array('warning','success','info','primary','secondary','danger');
							foreach($steps as $r)
							{
								$b=$badge[array_rand($badge)];
								echo "<i class='fa fa-arrow-right'></i> <span class='badge badge-$b'>".$r."</span>";
							}
							?>


							
							<span id="msgleads_feedback_save" style="max-height:350px; x-overflow:scroll;"></span>
									<form class="form" method="post" action="<?php echo $base_url.'index.php?action=leads&query=leads_feedback_save'; ?>" name="leads_new" id="leads_feedback_save">
										
										<div class="box-body">
											<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
											
											<div class="row">

											<div class="col-md-10">
												<div class="form-group">
												<label>Feedback</label>
												<textarea col="5" row="5" name="feedback" class="form-control"></textarea>
												</div>
											</div>

												<div class="col-md-2">
												<div class="form-group">
													<label>Last Updated On :</label>
													<?php echo date("d-m-Y H:i:s", strtotime($query[0]['last_updated'])); ?>
												</div>
												</div>


											</div>

											<div class="row">

													<div class="col-md-3">
														<div class="form-group">
														<label>Status</label>
														<select name="status" class="form-control">
																<option  selected='selected' value="0">--Select--</option>
																<?php 
																	$status=$admin->get_metaname_byvalue('lead_status');
																	foreach($status as $r=>$value)
																	{
																		echo "<option value='".$status[$r]['value2']."' ";
																		if($query[0]['status']==$status[$r]['value2']){echo "selected='selected'";}
																		echo  ">".$status[$r]['value1']."</option>";
																	}
																?>
															</select> 
														</div>
													</div>

													<div class="col-md-3">
														<div class="form-group">
														<label>Qualified Lead</label>
															<div class="c-inputs-stacked">
															<input name="qualified" type="radio" id="radio_123" value="1" <?php if($query[0]['lead_qualified']=='1'){echo "checked='checked'" ;}?>>
															<label for="radio_123" class="mr-30">Yes</label>
															<input name="qualified" type="radio" id="radio_456" value="0" <?php if($query[0]['lead_qualified']=='0'){echo "checked='checked'" ;}?>>
															<label for="radio_456" class="mr-30">No</label>
														</div>
												
														</div>
													</div>	
									

													<div class="col-md-3">
														<div class="form-group">
															<label>Feddback Type</label>
															<?php //echo $feedback_type[0]['value2'];?>
															<select name="feedback_type" class="form-control">
																<option disabled='disbaled'>-Select-</option>
																<?php $feedback=explode(",",$feedback_type[0]['value2']);
																foreach($feedback as $k=>$v){
																	echo "<option value='".$feedback[$k]."' ";
																	if($query2[0]['feedback_type']==$feedback[$k]){echo "selected='selected'";}
																	echo  ">".$feedback[$k]."</option>"; }?>
																</select>
															</div>
													</div>
											

													<div class="col-md-3">
														<div class="form-group">
															<label>Next Feddback Date</label>
															<input type="date" name="next_feedback" class="form-control">
														</div>
													</div>

											</div>



											<div class="row">

												<div class="col-md-2">
													<div class="form-group">
														<input type="button" name="submit" onclick="form_submit('leads_feedback_save')" value="Save" class="btn btn-round btn-xs btn-info">
													</div>
												</div>
												
												<div class="col-md-2">
													<div class="form-group">
														<input type="button" name="submit1" onclick="form_submit('leads_feedback_save')" value="Save & Email" class="btn btn-round btn-xs btn-danger">
													</div>
												</div>

											</div>
									</div>
												
								</form>
							</div>   
						</div>	



<!------------ feedback list -------->
						<div class="tab-pane" id="msg" role="tabpanel">
							<div class="p-15">
								<div class="col-md-12" style="max-height:200px; overflow-x:scroll;">
								<?php $list=$leads->get_feedback_limit_5($_GET['id']);
								if($list)
								{
								foreach($list as $row=>$value)
								{
								echo '<div class="alert alert-secondary alert-dismissable">'.$list[$row]['feedback'];
								echo '<br><small class="text-white">'.$list[$row]['date_time'].'</small>';
								echo '</div>';
								}

								if(isset($_GET['from']))
								{echo "<a class='btn btn-warning btn-xs' href='".$base_url."index.php?action=dashboard&page=sales_feedback&id=".$query[0]['id']."'>View More</a>";}
								else
								{echo "<a class='btn btn-warning btn-xs' href='".$base_url."index.php?action=dashboard&page=lead_feedback_detail&id=".$query[0]['id']."'>View More</a>";}
								}
								else
								{echo "<div class='alert alert-warning'>No Feedback Found</div>";}	
								?>
								</div>
							</div>   
						</div>	
			
			</diV>		

			</diV>	
		</div>						
	</div>
</section>							



</div>
</div>




<!-------- add more --------->
<?php $detail=$admin->get_metaname_byvalue_group('lead_company_info');
$url=$base_url."index.php?action=leads&query=get_company_info&meta_name=lead_company_info&detail2=";
?>
<script type="text/javascript">

$(document).ready(function() {

var max_fields      = 50; //maximum input boxes allowed
var wrapper         =  $("#addmore"); //Fields wrapper
var add_button      =  $("#addmore_btn"); //Add button ID
var x = 1; //initlal text box count

        

$(add_button).click(function(e)
{ //on add input button click
    e.preventDefault();
    if(x < max_fields){ 
        x++; 
		
    $(wrapper).append('<div id="addmore'+x+'" class="row">  <div class="col-md-4"><div class="form-group"><label>Detail '+x+'</label><select name="detail[]" class="form-control" id="details'+x+'" onchange=get_details("details'+x+'","subdetails'+x+'","<?php echo $url;?>")><option disabled="disabled" selected="selected" >-- Select --</option><?php foreach($detail as $k=>$v){echo "<option value=".$detail[$k]['value1'].">".$detail[$k]['value1']."</option>";}?></select></div></div> <div class="col-md-4"><div class="form-group"><label>Sub Detail '+x+'</label><select name="subdetails[]" class="form-control" id="subdetails'+x+'"  required><option disabled="disabled" selected="selected" >-- Select --</option></select></div></div>	<div class="col-md-3"><div class="form-group"><label>Reamrk '+x+'</label><input type="text" name="remark[]" class="form-control"></div></div> <div class="col-sm-1"><br><i class="btn btn-sm btn-danger fa fa-trash" onclick="removeme('+x+')"></i></div> </div>'); 

        
        }
      
    
    else
    {alert("Sorry, you can add only 50 Items in this segment");}

});



});


function removeme(x)
{
  //alert(x);
  $('#addmore'+x).remove();
    //get_subtotal(x);
}  
</script>