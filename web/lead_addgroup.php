<div class="content-wrapper">
	  <div class="container-full">


	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Create Lead Group(s)</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Leads</li>
								<li class="breadcrumb-item active" aria-current="page">Create Group</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
		<?php include('alert.php');?>
			<div class="row">
				


                <div class="col-lg-6 col-12">
					  <div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Create Group</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="<?php echo $base_url.'index.php?action=leads&query=create_group'?>" name="leads_new">
							<div class="box-body">
								<div class="form-group">
									<label>Group Name</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="ti-user"></i></span>
										</div>
										<input type="text" class="form-control" placeholder="Group Name" name="gname">
									</div>
								</div>
								<div class="form-group">
									<label>Color Code</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="ti-email"></i></span>
										</div>
										<input class="form-control" name="color_code" type="color" value="#563d7c" id="example-color-input">
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
					  <!-- /.box -->			
				</div>



                <div class="col-lg-6 col-12  margin-top-10">
					  <div class="box">
					<div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th>#</th>
								<th>Group Name</th>
								<th>Color Code</th>
								<th>Nu Of Record(s)</th>
								<th>Status</th>
								<th>Utility</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							// $leadviewall = (new MongoDB\Client)->$db->leads_group;
							// $leadviewall=$leadviewall->find();
							$group=$leads->get_group();
							$counter=1;
							foreach ($group as $doc=>$value) {
								// change to php
								// $doc=json_encode($doc);
								// $doc=json_decode($doc,true);
								$nu=$leads->get_group_record($group[$doc]["id"]);
								if(!$nu){$nu0=0;}else{$nu0=COUNT($nu);}
								echo "<tr>";
								echo "<th>".$counter++."</th>";
								echo "<td>".$group[$doc]["gname"]."</td>";
								echo "<td><input readonly='readonly' name='color_code' type='color' value='".$group[$doc]['color']."'></td>";
                                echo "<td>".$nu0."</td>";
								echo "<td></td>";
								echo "<td>";
									echo "<i class='btn btn-xs btn-info fa fa-pencil'></i> ";
									echo "<i class='btn btn-xs btn-success fa fa-eye'></i> ";
									echo "<i class='btn btn-xs btn-danger fa fa-trash'></i>";
								echo "</td>";
								echo "</tr>";
							}
							?>
							<tr>
								<th>0</th>
								<td>Uncategorized</td>
								<td><input readonly='readonly' name='color_code' type='color' value='#d8d8d8'></td>
								<td><?php 
								$nu=$leads->get_group_record(0);
								if(!$nu){$nu0=0;}else{$nu0=COUNT($nu);}
								echo $nu0;
								?></td>
								<td>No Group</td>
								<td></td>
							</tr>
						</tbody>
					</table>

</div>
</div>

</div>

</section>

</div>
</div>