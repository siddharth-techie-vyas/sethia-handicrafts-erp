<div class="content-wrapper">
	  <div class="container-full">


	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Leads Bulk Upload</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Leads</li>
								<li class="breadcrumb-item active" aria-current="page">Bulk Upload</li>
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

            <div class="box box-default">
				<div class="box-header with-border">
				<h4 class="box-title">Upload Leads</h4>
				<h6 class="box-subtitle">You can download the <a href="<?php echo $base_url.'images/lead_demo.csv'?>" target="_blank">Demo File Here </a></h6>		
				</div>
				<!-- /.box-header -->
				<div class="box-body wizard-content">
					<form action="#" class="tab-wizard wizard-circle">
						<!-- Step 1 -->
						<section>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="firstName5">Upload File :</label>
										<input type="file" class="form-control" id="file" name="file" accept=".csv"> </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lastName1">Select Group :</label>
										<select class="custom-select form-control" id="group" name="group">
										<option disbaled="disabled" selected="selected">Select</option>
										</select>
								</div>
							</div>
						</section>	
						
						<!-- Step 4 -->
						<h6>Remark</h6>
						<section>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<textarea name="decisions" id="decisions1" rows="4" class="form-control"></textarea>
									</div>
									
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<div class="col-sm-2"><input type="reset" name="reset" value="Reset" class="btn btn-warning"></div>
								<div class="col-sm-2"><input type="submit" name="submit" value="Upload" class="btn btn-success"></div>
							</div>
						</section>	
					</form>
					</div>
				</div>
			</div>

				<!--- list--->
				<div class="col-sm-6">
				<div class="box box-default">
					<div class="box-header with-border">
					<h4 class="box-title">Previous Uploaded Data & Details</h4>
				
					</div>
					<!-- /.box-header -->
					<div class="box-body wizard-content"></div>
					</div>
					</div>
				</div>

			<!-- /.box-body -->
		  </div>

</div>

</section>

</div>
</div>