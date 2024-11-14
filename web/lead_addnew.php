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
									  <label>Requirment</label>
									  <input type="text" class="form-control" placeholder="Requirment" name="req">
									</div>
								  </div>

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

                            </div>



							
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="reset" class="btn btn-rounded btn-warning btn-outline mr-1">
								  <i class="ti-trash"></i> Cancel
								</button>
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