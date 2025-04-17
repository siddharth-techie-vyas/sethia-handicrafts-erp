<div class="content-wrapper">
	  <div class="container-full">
    	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Material Registration</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item">Inventory</li>
								<li class="breadcrumb-item" >Request For</li>
                                <li class="breadcrumb-item active" aria-current="page">Material</li>
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
			    	<h3 id="steps-uid-0-h-0" tabindex="-1" class="title current">Add New Material</h3>

                    <?php include('alert.php');?>

                        <form method="post" action="<?php echo $base_url.'index.php?action=product&query=add_material';?>" name="addmaterial" enctype="multipart/form-data">
                            <div class="row g-3">
                                <!-- First Row -->
                                <div class="col-md-3">
                                    <label class="form-label">Material Name</label>
                                    <input type="text" class="form-control" name="mname" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Parent Material</label>
                                    <select class="form-control" name="mid">
                                        <option value="" disbaled="disabled">Select Parent Material</option>
                                        <?php 
                                        $mlist=$product->get_material();
                                        foreach($mlist as $r=>$v){?>
                                        <option value="<?php echo $mlist[$r]['id'];?>" ><?php echo $mlist[$r]['material_name'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Material Type</label>
                                    <select name="mtype" class="form-control" required>
                                        <option value="" disbaled="disabled">Select Material Type</option>
                                        <?php $material_type=$admin->get_metaname_byvalue('material_type'); foreach($material_type as $mtype => $value){?>
                                        <option value="<?php echo $material_type[$mtype]['value1'];?>"><?php echo strtoupper($material_type[$mtype]['value1']);?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Labour Cost</label>
                                    <input type="text" name="labour_inr" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Labour Cost UOM</label>
                                    <select name="uom" class="form-control">
                                        <option value="" disbaled="disabled">Select Labpour Cost UOM</option>
                                        <?php $labour_uom=$admin->get_metaname_byvalue('labour_uom'); foreach($labour_uom as $mtype => $value){?>
                                        <option value="<?php echo $labour_uom[$mtype]['value1'];?>"><?php echo strtoupper($labour_uom[$mtype]['value1']);?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Reference Image</label>
                                    <input type="file" name="pic" class="form-control">
                                </div>
                                <div class="col-md-2"><br>
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
			    	<h3 id="steps-uid-0-h-0" tabindex="-1" class="title current">View All Material</h3>
                </div>

                <div class="table-responsive">
					  <table id="example" class="table table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>#</th>
                                <th>Image</th>
								<th>Material Name</th>
                                <th>Parent Material</th>
								<th>Type</th>
                                <th>Labour Cost</th>
								<th>Utility</th>
							</tr>
						</thead>
						<tbody>
                            <?php 
                            $counter=1;
                            $all = $product->get_material();
                            foreach($all as $r=>$v)
                            {
                            ?>  
                                <tr>
                                    <th><?php echo $counter++;?></th>
                                    <td><?php if($all[$r]['pic'] != ''){echo "<img src=".$base_url."images/".$all[$r]['pic']." width='50px' height='50px'>";$all[$r]['pic'];}?></td>
                                    <td><?php echo $all[$r]['material_name'];?></td>
                                    <td><?php if($all[$r]['mid'] != 0){echo $all[$r]['mid'];}?></td>
                                    <td><?php echo $all[$r]['material_type'];?></td>
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