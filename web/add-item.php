<div class="content-wrapper">
	  <div class="container-full">
    	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title"><?php if(isset($_GET['edit'])){ echo "Edit";}else{echo "Add";}?> Store Item</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item">Store</li>
								<li class="breadcrumb-item" >Item</li>
                                <li class="breadcrumb-item active" aria-current="page">Add New</li>
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
			    	

					<?php include('alert.php');?>

					
				

                    <form name="product" action="index.php?action=store&query=add-item" method="post" enctype="multipart/form-data">
                   	
                       <!-- row 1-->
                         <div class="form-group row">
                           
                           <div class="col-sm-3">
                           <label class="col-form-label">Item Name <span class="mendetory">*</span></label>
                             <input type="text" value="" class="form-control form-control-sm" name="product_name"  required>
                           </div>
                           
                           <div class="col-sm-3">
                           <label class="col-form-label">HSN Code <span class="mendetory">*</span></label>
                             <input type="text" value="" class="form-control form-control-sm" name="hsn_code"  required>
                           </div>
  
                           <div class="col-sm-3">
                           <label class="col-form-label">Category <span class="mendetory">*</span></label>
                             <select class="form-control form-control-sm" name="cat" onchange="get_subcat('subcat',this.value,'store')"  required>
                              <option disabled='disabled' selected='selected'>-Select-</option>
                              <?php 
                              $cat=$store->get_cat();
                              foreach($cat as $k=>$value)
                              {
                                echo "<option value='".$cat[$k]['id']."'>".$cat[$k]['cat']."</option>";
                              }
                              ?>  
                            
                            </select>
                           </div>
  
                           <div class="col-sm-3">
                           <label class="col-form-label">Sub Category <span class="mendetory">*</span></label>
                           <select class="form-control form-control-sm" id="subcat" name="subcat"  required>
                             </select>
                           </div>
  
                           <div class="col-sm-3">
                           <label class="col-form-label">Unit <span class="mendetory">*</span></label>
                           <select class="form-control form-control-sm" name="unit"   required>
                              <option disabled='disabled' selected='selected'>-Select-</option>
                              <?php 
                              $unit=$store->get_unit();
                              foreach($unit as $k=>$value)
                              {
                                echo "<option value='".$unit[$k]['id']."'>".$unit[$k]['unit']."</option>";
                              }
                              ?>  
                            
                            </select>
                           </div>
                           
                           <div class="col-sm-3">
                           <label class="col-form-label">Image <span class="mendetory">*</span></label>
                             <input type="file" value="" class="form-control form-control-sm" name="pic"   accept=".jpg, .jpeg, .png" required>
                           </div>
  
                           <div class="col-sm-2"><br>
                           
                           <input type="submit" name="submit" class="btn btn-success" value="Submit"/>
                           
                        </div>
                        
           </div>
                             
                    </form> 

                
         </div>
        </div>

   


</div>
</div>
</div>
</div>