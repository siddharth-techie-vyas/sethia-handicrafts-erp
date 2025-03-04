<?php 
$view=$sales->get_rfq_one($_GET['id']);
?>

<div class="content-wrapper">
	  <div class="container-full">
    	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Prospect Registration</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item">Sales</li>
								<li class="breadcrumb-item" >Request For</li>
                                <li class="breadcrumb-item active" aria-current="page">Proposal</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<div class="col-12">
        <?php include('alert.php');?>
			  <div class="box box-default">
				
				<!-- /.box-header -->
				<div class="box-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs justify-content-center" role="tablist">
						<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home12" role="tab" aria-selected="true"><span><i class="ion-home"></i></span> <span class="hidden-xs-down ml-15">0 - Items<br>Details</span></a> </li>
                        <?php if($view[0]['step'] > 0){?>
						 <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile12" role="tab" aria-selected="false"><span><i class="ion-person"></i></span> <span class="hidden-xs-down ml-15">0.1 - Custom<br>Details</span></a> </li>
                         <?php }if($view[0]['step'] > 0.5){?>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages12" role="tab" aria-selected="false"><span><i class="fa fa-inr"></i></span> <span class="hidden-xs-down ml-15">0.2 - Price<br>Review</span></a> </li>
                        <?php }if($view[0]['step'] > 0.8){?>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#setting12" role="tab" aria-selected="false"><span><i class="fa fa-file-excel-o"></i></span> <span class="hidden-xs-down ml-15">1 - Prepare<br>Line Sheet</span></a> </li>
                        <?php }if($view[0]['step'] > 1){?>
						<li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#about12" role="tab" aria-selected="false"><span><i class="fa fa-pencil"></i></span><span class="hidden-xs-down ml-15">2 - Update<br>Line Sheet</span></a> </li>
                        <?php }if($view[0]['step'] > 2){?>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#contact12" role="tab"><span><i class="fa fa-file"></i></span> <span class="hidden-xs-down ml-15">3- T&C<br>Accept</span></a> </li>
                        <?php }if($view[0]['step'] > 3){?>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#business" role="tab"><span><i class="fa fa-users"></i></span> <span class="hidden-xs-down ml-15">4- Business<br>Potential</span></a> </li>
                        <?php }if($view[0]['step'] > 4){?>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#review_linesheet" role="tab"><span><i class="fa fa-search"></i></span> <span class="hidden-xs-down ml-15">5- Review<br>Line Sheet</span></a> </li>
						<?php }if($view[0]['step'] > 5){?>
						<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#submit_linesheet" role="tab"><span><i class="fa fa-users"></i></span> <span class="hidden-xs-down ml-15">6- Final<br>Step</span></a> </li>
                        <?php }?>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content tabcontent-border">
						<div class="tab-pane active" id="home12" role="tabpanel">
                            <div class="p-15">
								<h3 id="steps-uid-0-h-0" tabindex="-1" class="title current">Client & Product(s) Information</h3>
								<?php include('sales_rfq_step0_edit.php');?>
							</div>
						</div>
						<!----- more details  ----------->
						<div class="tab-pane" id="profile12" role="tabpanel">
							<div class="p-15">
							<h3>Custom Details</h3>
                            <?php include('sales_sku-custom-details.php');?>
							</div>
						</div>
						<!-- t&c---->
						<div class="tab-pane" id="messages12" role="tabpanel">
							<div class="p-15">
                            <h3>Price Review</h3>
                            <?php include('sales_sku-price-review.php');?>
							</div>
						</div>
						<div class="tab-pane" id="setting12" role="tabpanel">
							<div class="p-15">
							<?php include('sales_line-sheet.php');?>
							</div>
						</div>
						<div class="tab-pane " id="about12" role="tabpanel">
							<div class="p-15">
                                <?php include('sales_rfq_update_line_sheet.php');?>
							</div>
						</div>
						<div class="tab-pane" id="contact12" role="tabpanel">
							<div class="p-15">
								<style>.tc_disable{}</style>
								<?php 
								$pro1= $sales->get_baneficiery($view[0]['prospect']);
								$tandc=$sales->get_prospect_tandc($pro1[0]['id']);
								include('sales_rfq_tandc.php');?>
							</div>
						</div>
						<div class="tab-pane " id="business" role="tabpanel">
							<div class="p-15">
                                <?php include('sales_rfq_business-potentials.php');?>
							</div>
						</div>
						<div class="tab-pane " id="review_linesheet" role="tabpanel">
							<div class="p-15">
                                <?php include('sales_rfq-review-linesheet.php');?>
							</div>
						</div>
						<div class="tab-pane " id="submit_linesheet" role="tabpanel">
							<div class="p-15">
                                <?php include('sales_rfq_final.php');?>
							</div>
						</div>

					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div>
</div>

