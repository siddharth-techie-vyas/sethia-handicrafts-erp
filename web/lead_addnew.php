<div class="content-wrapper">
	  <div class="container-full">


	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Add New Single Lead</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Leads</li>
								<li class="breadcrumb-item active" aria-current="page">Add New</li>
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
			<div class="col-md-12">
			<?php include('alert.php');?>	
            <div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Add New Lead</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="<?php echo $base_url.'index.php?action=leads&query=create_new'?>" name="leads_new">
							<div class="box-body">
								<h4 class="box-title text-info"><i class="ti-user mr-15"></i> Personal Info</h4>
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-4">
									<div class="form-group">
									  <label>Name</label>
									  <input type="hidden" name="status" value="0">
									  <input type="hidden" name="handledby" value="<?php echo $_SESSION['uid'];?>">
									  <input type="text" class="form-control" placeholder="Name" name="name" required>
									</div>
								  </div>
								  <div class="col-md-4">
									<div class="form-group">
									  <label>Phone</label>
									  <input type="number" class="form-control" placeholder="Phone" name="phone">
									</div>
								  </div>
                                  <div class="col-md-4">
									<div class="form-group">
									  <label>E-mail</label>
									  <input type="email" class="form-control" placeholder="E-mail" name="email">
									</div>
								  </div>
								</div>

								<div class="row">
								<div class="col-md-3">
								<div class="form-group">
								  <label>Country</label>
								  <select class="form-control" name="country" id="country" onchange="get_details('country','state','<?php echo $base_url.'index.php?action=leads&query=get_details&type=state&id=';?>')">
									<option disabled="disabled" selected="selected" >-- Select --</option>
									<?php $country=$admin->get_country();
									foreach($country as $r => $v)
									{
										echo "<option value='".$country[$r]['id']."'>".$country[$r]['name']."</option>";
									}?>
								  </select>
								</div>
								</div>

								  <div class="col-md-3">
									<div class="form-group">
									  <label>State</label>
									 
									  <select class="form-control" name="state" id="state" onchange="get_details('state','city','<?php echo $base_url.'index.php?action=leads&query=get_details&type=city&id=';?>')"></select>
									  <span id="msgstate"></span> 
									</div>
								  </div>

								  <div class="col-md-3">
									<div class="form-group">
									  <label>City</label>
									  <select class="form-control" name="city" id="city"></select>
									  <span id="msgcity"></span> 
									</div>
								  </div>

                                <div class="col-md-3">
								<div class="form-group">
								  <label>Designation</label>
								  <input type="text" class="form-control" placeholder="Designation" name="designation">
								</div>
								</div>

                            </div>
                                

                            <div class="row">
								<div class="col-md-3">
								<div class="form-group">
								  <label>Company</label>
								  <input type="text" class="form-control" placeholder="Company" name="company">
								</div>
								</div>

								<div class="col-md-3">
								<div class="form-group">
								  <label>Company / Cusotomer Type</label>

								  <select class="form-control" name="company_type" id="company_type" required>
									<option disabled="disabled" selected="selected" >-- Select --</option>
									<?php $company_type=$admin->get_metaname_byvalue('lead_customer_type');
									foreach($company_type as $r => $v)
									{
										echo "<option value='".$company_type[$r]['value1']."'>".$company_type[$r]['value1']."</option>";
									}?>
								  </select>
								</div>
								</div>

								<div class="col-md-3">
								<div class="form-group">
								  <label>Address</label>
								  <input type="text" class="form-control" placeholder="Address" name="address">
								</div>
								</div>

								  <div class="col-md-3">
									<div class="form-group">
									  <label>Requirment</label>
									  <input type="text" class="form-control" placeholder="Requirment" name="req">
									</div>
								  </div>

                               
                               

								

                            </div>


							<div class="row">

							<div class="col-md-3">
								<div class="form-group">
								  <label>LP Url</label>
								  <input type="text" class="form-control" placeholder="Lp Url" name="lp_url">
								</div>
								</div>


							<div class="col-md-3">
								<div class="form-group">
								  <label>Form Id</label>
								  <input type="number" class="form-control" placeholder="Form Id" name="form_id">
								</div>
								</div>

							<div class="col-md-3">
									<div class="form-group">
										<label for="firstName5">Alloted To :</label>
										<select class="custom-select form-control" id="userid" name="userid" required>
										<option disbaled="disabled" selected="selected">Select</option>
										<?php
										if($_SESSION['uid']=='1')
										{
											$users=$admin->get_alluser();
											foreach($users as $k=>$v){
												echo "<option value='".$users[$k]['id']."'>".$users[$k]['person_name']."</option>";
											}
										}
										else
										{echo "<option value='".$_SESSION['uid']."'>".$_SESSION['person_name']."</option>";}	
										?>
										</select>
									</div>
								</div>

							<div class="col-md-3">
									<div class="form-group">
										<label for="lastName1">Select Group :</label>
										<select class="custom-select form-control" id="group" name="groupid" required>
										<option disbaled="disabled" selected="selected">Select</option>
										<?php
										$group = $leads->get_group();
										foreach($group as $k=>$v){
											echo "<option value='".$group[$k]['id']."'>".$group[$k]['gname']."</option>";
											//-- get sub group
											$sgroup=$leads->get_sub_group($group[$k]['id']);
											foreach($sgroup as $k=>$v)
												{
													echo "<option value='".$sgroup[$k]['id']."'>- ".$sgroup[$k]['gname']."</option>";

												}
										}
										?>
										</select>
								</div>
							</div>



							
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="reset" class="btn btn-rounded btn-warning btn-outline mr-1" value="Reset"/>
								<input type="submit" class="btn btn-rounded btn-primary btn-outline" value="Save">
								  
							</div>  
						</form>
					  </div>

				

			<!-- /.box-body -->
		  </div>

</div>

</section>

</div>
</div>