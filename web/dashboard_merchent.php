<div class="content-wrapper">

<div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
				<h3 class="page-title text-primary">Welcome <?php echo $_SESSION['person_name'];?></h3>	
				<h4 class="page-title text-info">Dashbaord (Sales / Merchent)</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Dashbaord</li>
								<li class="breadcrumb-item active" aria-current="page">(Sales / Merchent)</li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- <div class="right-title">
					<div class="d-flex mt-10 justify-content-end">s
						<div class="d-lg-flex mr-20 ml-10 d-none">
							<div class="chart-text mr-10">
								<h6 class="mb-0"><small>THIS MONTH</small></h6>
								<h4 class="mt-0 text-primary">$12,125</h4>
							</div>
							<div class="spark-chart">
								<div id="thismonth"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;" width="60" height="35"></canvas></div>
							</div>
						</div>
						<div class="d-lg-flex mr-20 ml-10 d-none">
							<div class="chart-text mr-10">
								<h6 class="mb-0"><small>LAST YEAR</small></h6>
								<h4 class="mt-0 text-danger">$22,754</h4>
							</div>
							<div class="spark-chart">
								<div id="lastyear"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;" width="60" height="35"></canvas></div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			
		
		<!-- 1st row-->
                <div class="box-header with-border">
				  <h4 class="box-title">Lead(s) Countdown</h4>
				</div>

                <div class="row">
                    <div class="col-lg-3 col-6">
					  <a class="box box-link-shadow text-center" href="#">
						<div class="box-body">
							<div class="font-size-24"><?php $unhadled=$sales->lead_bystatus('0'); if($unhadled){echo count($unhadled);}else{echo "0";}?></div>
							<span>Unhandled</span>
						</div>
						<div class="box-body bg-info">
							<p>
								<span class="mdi mdi-ticket-confirmation font-size-30"></span>
							</p>
						</div>
					  </a>
				  </div>
				  <div class="col-lg-3 col-6">
					  <a class="box box-link-shadow text-center" href="<?php echo $base_url.'index.php?action=dashboard&page=sales_lead_viewall&status=2';?>">
						<div class="box-body">
                            <div class="font-size-24"><?php $open=$sales->lead_bystatus('2'); if($open){echo count($open);}else{echo "0";}?></div>
                            <span>Open</span>
						</div>
						<div class="box-body bg-warning">
							<p>
								<span class="mdi mdi-message-reply-text font-size-30"></span>
							</p>
						</div>
					  </a>
				  </div>
				  <div class="col-lg-3 col-6">
					  <a class="box box-link-shadow text-center" href="<?php echo $base_url.'index.php?action=dashboard&page=sales_lead_viewall&status=1';?>">
						<div class="box-body">							
                                <div class="font-size-24"><?php $handled=$sales->lead_bystatus('1'); if($handled){echo count($handled);}else{echo "0";}?></div>
                                <span>Success</span>
						</div>
						<div class="box-body bg-success">
							<p>
								<span class="mdi mdi-thumb-up-outline font-size-30"></span>
							</p>
						</div>
					  </a>
				  </div>
				  <div class="col-lg-3 col-6">
					  <a class="box box-link-shadow text-center" href="<?php echo $base_url.'index.php?action=dashboard&page=sales_lead_viewall&status=3';?>">
						<div class="box-body">
							<div class="font-size-24"><?php $unsuccessfull=$sales->lead_bystatus('3'); if($unsuccessfull){echo count($unsuccessfull);}else{echo "0";}?></div>
							<span>Unsuccessfull</span>
						</div>
						<div class="box-body bg-danger">
							<p>
								<span class="mdi mdi-ticket font-size-30"></span>
							</p>
						</div>
					  </a>
				  </div>


			</div>
            

</section>        


<!-- row 2 -->
 <section class="content">

                <div class="col-xl-6 col-12">
					<div class="box">
						<div class="box-body">
							<h4 class="box-title">Bar Chart</h4>
							<div><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; inset: 0px;"></iframe>
								<canvas id="bar-chart3" height="365" style="display: block; width: 738px; height: 365px;" width="738"></canvas>
							</div>
						</div>
					</div>
				</div>

 </section>