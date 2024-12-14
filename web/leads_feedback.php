<?php $query=$leads->get_lead_one($_GET['id']);
$query2=$leads->get_lead_last_feedback($_GET['id']);
//-- get feedback type from custoomer_type meta
$feedback_type=$admin->get_metaname_byvalue1('lead_customer_type',$query[0]['company_type']);
?>

			<!--- form -->
			<div class="col-md-12">
						<!-- /.box-header -->
             <?php 
			 if($query[0]['utype'] =='1' || $query[0]['utype']=='6'){
			 
			 if($query[0]['status'] =='2' || $query[0]['status']=='0'){?>
                         <span id="msgleads_feedback_save" style="max-height:350px; x-overflow:scroll;"></span>
						<form class="form" method="post" action="<?php echo $base_url.'index.php?action=leads&query=leads_feedback_save'; ?>" name="leads_new" id="leads_feedback_save">
							<div class="box-body">
								<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
								<div class="row">
                                    
								  <div class="col-md-12">
									<div class="form-group">
									  <label>Feedback</label>
									  <textarea col="5" row="5" name="feedback" class="form-control"></textarea>
									</div>
								  </div>

								<div class="col-md-12">
								<div class="form-group">
									<label>Last Updated On :</label>
									<?php echo date("d-m-Y H:i:s", strtotime($query[0]['last_updated'])); ?>
								</div>
								</div>

                  				<div class="col-md-12">
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

                                  	
								<div class="col-md-12">
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
						

								<div class="col-md-12">
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
								 
								  <div class="col-md-12">
									<div class="form-group">
										<label>Next Feddback Date</label>
                                        <input type="date" name="next_feedback" class="form-control">
                                    </div>
                                    </div>



								  <div class="col-md-4">
									<div class="form-group">
                                        <input type="button" name="submit" onclick="form_submit('leads_feedback_save')" value="Save" class="btn btn-round btn-xs btn-info">
                                    </div>
                                    </div>
									
									<div class="col-md-4">
									<div class="form-group">
                                        <input type="button" name="submit1" onclick="form_submit('leads_feedback_save')" value="Save & Email" class="btn btn-round btn-xs btn-danger">
                                    </div>
                                    </div>

                                    </div>
                                    
</form>
<?php } }?>
</div>
<hr class="my-10">
<div class="col-md-12" style="max-height:250px; overflow-x:scroll;">
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