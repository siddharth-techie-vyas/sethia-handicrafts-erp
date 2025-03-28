<div class="content-wrapper">
	  <div class="container-full">
    	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Finish Registration</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item">Inventory</li>
								<li class="breadcrumb-item" >Request For</li>
                                <li class="breadcrumb-item active" aria-current="page">Finish</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<div class="col-12">
			  <div class="box box-default">
				
				<!-- /.box-header -->
				<div class="box-body">
					<!-- Nav tabs -->
			    	<h3 id="steps-uid-0-h-0" tabindex="-1" class="title current">Add New Finish</h3>


                        <form>
                            <div class="row g-3">
                                <!-- First Row -->
                                <div class="col-md-3">
                                    <label class="form-label">Finish Name</label>
                                    <input type="text" class="form-control" name="cat_name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Finish Material</label>
                                    <select class="form-control" name="finish_material">
                                        <option disabled="disabled" selected="selected">-Select-</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Labour Cost (INR)</label>
                                    <input type="text" class="form-control" name="labour_inr">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">UOM</label>
                                    <select class="form-control" name="uom">
                                        <option disabled="disabled" selected="selected">-Select-</option>
                                        <option>Sq. Feet</option>
                                        <option>Sq. Meter</option>
                                        <option>Sq. Inches</option>
                                    </select>
                                </div>
                                <div class="col-md-3"><br>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success btn-sm">
                                </div>
                            </div>    
                    </form>

                </div>
         </div>
        </div>


<!-- Main content -->
<div class="col-12">
			  <div class="box box-default">
				
				<!-- /.box-header -->
				<div class="box-body">
					<!-- Nav tabs -->
			    	<h3 id="steps-uid-0-h-0" tabindex="-1" class="title current">View All Finish</h3>
                </div>

                <div class="table-responsive">
					  <table id="example" class="table table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Finish Name</th>
								<th>Material</th>
                                <th>Labour Cost</th>
								<th>Utility</th>
							</tr>
						</thead>
						<tbody>
                            <?php 
                            $counter=1;
                            $all = $product->get_finish();
                            foreach($all as $r=>$v)
                            {
                            ?>  
                                <tr>
                                    <th><?php echo $counter++;?></th>
                                    <td><?php echo $all[$r]['finish_name'];?></td>
                                    <td><?php $material = $product->get_material_byid($all[$r]['finish_material']); 
                                    echo $material[0]['material_name'];?></td>
                                    <td><?php echo $all[$r]['labour_inr'].' / '.$all[$r]['uom'];?></td>
                                    <td>
                                        <i class='fa fa-eye btn btn-xs btn-info'></i>
                                        <i class='fa fa-pencil btn btn-xs btn-warning'></i>
                                        <i class='fa fa-trash btn btn-xs btn-danger'></i>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                        </table> 
                    </div>
</div>
</div>              


</div>
</div>
</div>
</div>