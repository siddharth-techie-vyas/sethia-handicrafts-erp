<div class="box box-default">
				<div class="box-header with-border">
				  <h4 class="box-title">Company Research</h4><hr>
                  <i class="badge badge-success">Completed</i>
                  <i class="badge badge-warning">Pending</i>
                  <i class="badge badge-danger">In Completed</i>
                  
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<!-- Nav tabs -->
					<div class="vtabs customvtab">
						<ul class="nav nav-tabs tabs-vertical" role="tablist">
                        <!--- tabs heading -->
                            <?php 
                                $i=1; $j=1;
                                $stage =$admin->get_metaname_byvalue_group('lead_company_info');
                                foreach($stage as $k=>$v)
                                {
                                    //$badge='success';
                                    //-- check data avilable or not in company details
                                    $company_details = $leads->get_leads_company_details_bydetails($_GET['lid'],$stage[$k]['value1']);
                                    if(!$company_details)
                                    {$badge='danger';}
                                    else
                                    {$badge='success'; $j++;}

                                    if($i==$j){$badge='warning';}
                            ?>
							
                            <li class="nav-item"> <a class="nav-link" data-toggle='tab' href="#msg<?php echo $stage[$k]['id'];?>" role="tab" aria-expanded="false" aria-selected="false"><span class="hidden-sm-up"><i class="ion-menu"></i></span> <span class="hidden-xs-down"> <i class="badge badge-<?php echo $badge;?>"><?php echo $i;?></i> <?php echo $stage[$k]['value1'];?></span></a> </li>
							<?php $i++;}?>


                            <li class="nav-item bg-success"> <a class="nav-link" data-toggle="tab" href="#messageslast" role="tab" aria-expanded="false" aria-selected="false"><span class="hidden-sm-up"><i class="ion-menu"></i></span> <span class="hidden-xs-down">View All Research</span></a> </li>
                            
						</ul>





						<!-- Tab panes -->
						<div class="tab-content">

                            <?php  
                            $active='active';
                            foreach($stage as $k=>$v)
                                {
                            ?>
							<div class="tab-pane <?php echo $active; ?>" id="msg<?php echo $stage[$k]['id'];?>" role="tabpanel" aria-expanded="false">
								<div class="p-15">
                                    <h4><?php echo $stage[$k]['value1'];?></h4>
                                    <hr>
                                    <?php 
                                    $form_array=array("/","|","<",">","?","@","&"," ");
                                    $formname=$stage[$k]['id'].str_replace($form_array,"-",$stage[$k]['value1']);?>
                                    <!-- dynamic form -->
                                     <div id="msg<?php echo $formname;?>"></div>
                                     <form name="<?php echo $formname;?>" id="<?php echo $formname;?>" method="post" action="<?php echo $base_url.'index.php?action=leads&query=save_company_details';?>">
                                     <input type="hidden" name="lid" value="<?php echo $_GET['lid'];?>"/>
                                     <input type="hidden" name="details" value="<?php echo $stage[$k]['value1'];?>"/>
                                        <div class="form-group">
                                            
                                            <table class="table">
                                               
                                                <tr>
                                                    
                                                    <td>
                                                    <?php $type = $stage[$k]['value1_input'];
                                                        //------ drop box
                                                        if($type=='radio')
                                                        {?>
                                                            <select id="<?php echo $formname;?>value1" name="value1" class='form-control' onchange="get_details('<?php echo $formname;?>value1','<?php echo $formname;?>value2','<?php echo $base_url.'index.php?action=leads&query=get_company_info&meta_name=lead_company_info&id=';?>')">
                                                        <?php 
                                                            echo "<option disbaled='disbaled' selected='selected'>-Select-</option>";
                                                                $i=1;
                                                                $details0=$admin->get_metaname_byvalue_multi_group($stage[$k]['meta_name'],$stage[$k]['value1'],'value1','value2');
                                                                foreach($details0 as $k=>$v)
                                                                {
                                                                    echo "<option value='".$details0[$k]['value2']."'>".$details0[$k]['value2']."</option>";
                                                                }
                                                            echo "</select>";
                                                        }
                                                        elseif($type=='checkbox')
                                                        {   echo "<table>";
                                                            $details0=$admin->get_metaname_byvalue_multi_group($stage[$k]['meta_name'],$stage[$k]['value1'],'value1','value2');
                                                            foreach($details0 as $k=>$v){
                                                                echo "<tr>";
                                                                
                                                                ?>
                                                                <th>
                                                                    <input type="checkbox" id="<?php echo $details0[$k]['id'];?>text" name="value1[]" value="<?php echo $details0[$k]['value2'];?>" onclick="get_details('<?php echo $details0[$k]['id'];?>text','<?php echo $details0[$k]['id'];?>result','<?php echo $base_url.'index.php?action=leads&query=get_company_info&meta_name=lead_company_info&id=';?>')"/>

                                                                    <label for="<?php echo $details0[$k]['id'];?>text" > <?php echo $details0[$k]['value2'];?></label>
                                                                </th>
                                                                <td id="<?php echo $details0[$k]['id'];?>result"></td>
                                                                <td id="<?php echo str_replace(" ","_",$details0[$k]['value2']);?>result2"></td>
                                                                <?php 
                                                            
                                                                echo "</tr>";
                                                               }   
                                                            echo "</table>";
                                                        }
                                                        elseif($type=='textarea')
                                                        {
                                                            echo "<textarea col='5' row='4' name='value1' class='form-control'></textarea>";
                                                        }
                                                        else
                                                        {
                                                            echo "<textarea col='5' row='4' name='value1' class='form-control'></textarea>";
                                                        }
                                                    ?>
                                                    </td>

                                                    <td id="<?php echo $formname;?>value2"></td>
                                                    <td id="<?php echo $formname;?>value3"></td>
                                                    <!-- <td id="<?php echo $formname;?>remark">
                                                        <input type='text' name='remark' class='form-control'>
                                                    </td> -->
                                                </tr>
                                           
                                            
                                            <tr>
                                            
                                                <td>
                                                    <input type="button" onclick="form_submit('<?php echo $formname;?>')" value="Save & Procees to Next" class="btn btn-secondary btn-md">
                                                </td>
                                            </tr>
                                            </table>
                                        </div>
                                     </form>
								</div>
							</div>
                            <?php  $active=''; }?>
							
                            <div class="tab-pane" id="messageslast" role="tabpanel" aria-expanded="false">
								<div class="p-15">
                                <table class="table table-bordered">
                                                <thead>
                                                <tr>
													<th>#</th>
													<th>Title</th>
													<th>Sub Title</th>
													<th>Category</th>
                                                    <th>Sub Category</th>
												</tr>
                                                </thead>				
												<?php
												$counter=1;
												$company_details_leads=$leads->get_leads_company_details($_GET['lid']);
                                                if(!$company_details_leads)
                                                {
                                                    echo "<tr><td colspan='4'><div class='alert alert-info'>No Data Found</div></td></tr>";
                                                }
                                                else{
												foreach($company_details_leads as $r =>$v)
												{   
                                                    if(is_string($company_details_leads[$r]['value2']))
                                                    {$value2=$company_details_leads[$r]['value2'];}
                                                    else
                                                    {$value21=unserialize($company_details_leads[$r]['value2']);
                                                        foreach($value21 as $r)
                                                        {
                                                            $value2.=$r."<br>";
                                                        }
                                                    } 

                                                    if(is_string($company_details_leads[$r]['value3']))
                                                    {$value3=$company_details_leads[$r]['value3'];}
                                                    else
                                                    {$value31=unserialize($company_details_leads[$r]['value3']);
                                                        foreach($value31 as $r)
                                                        {
                                                            $value3.=$r."<br>";
                                                        }
                                                    } 


													echo "<tr>";
														echo "<th>".$counter++."</th>";
														echo "<td>".$company_details_leads[$r]['details']."</td>";
														echo "<td>".$company_details_leads[$r]['value1']."</td>";
														echo "<td>".$value2."</td>";
                                                        echo "<td>".$value3."</td>";
													echo "</tr>";
												}}
												?>
											</table>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>




              