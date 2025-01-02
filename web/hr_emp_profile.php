<div class="content-wrapper">
	  <div class="container-full">


	  <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Employee Profile</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">HR</li>
								<li class="breadcrumb-item active" aria-current="page">Employee Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			
			<!--- form -->
			
			<?php include('alert.php');?>	
            <div class="box">
                
						<div class="box-header with-border">
						  <h4 class="box-title">Employee Profile</h4>
						</div>

						<div class="box-body">
                            <?php 
                                //basic details
                                $emp=$admin->getone_user($_GET['id']);
                                $profile =$hr->get_emp_profile($_GET['id']);
                            ?>
                            <form name="emp_profile" method="post" action="<?php echo $base_url."index.php?action=hr&query=save_emp_profile";?>">
                                <input type="hidden" name="uid" value="<?php echo $_GET['id'];?>">
                                <input type="hidden" name="uemail" value="<?php echo $emp[0]['uemail'];?>">
                            <table class="table table-bordered">
                                <tr>
                                    <th>User Name</th>
                                    <td><input type="text" class="form-control" name="uname" readonly="readonly" value="<?php echo $emp[0]['uname'];?>"></td>
                                    <th>Password</th>
                                    <td><input type="password" class="form-control" readonly="readonly" name="upass" value="<?php echo $emp[0]['upass'];?>"></td>
                                </tr>    
                                <tr>
                                    <th>Name</th>
                                    <td><input type="text" class="form-control" name="person_name" value="<?php echo $emp[0]['person_name'];?>"></td>
                                    <th>Gender</th>
                                    <td>
                                        <select name="gender" class="form-control" required>
                                            <option disabled="disbaled" selected="selected">--Select--</option>
                                            <option value="Male">Male</option>
                                            <option value="FeMale">FeMale</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Company</th>
                                    <td><input type="text" class="form-control" name="company_now"></td>
                                    <th>Designation</th>
                                    <td>
                                            <select name="utype" class="form-control">
                                            <option>-- Select --</option>
                                            <?php $user = $admin->get_metaname_byvalue('user_type'); 

                                            //	$user = array_unique($user0);
                                            foreach($user as $k=>$value)
                                            {
                                                echo "<option value='".$user[$k]['value2']."' ";
                                                if($emp[0]['utype']==$user[$k]['value2']){echo "selected='selected'";}  
                                                echo ">".$user[$k]['value1']."</option>";
                                            }
                                            ?>
                                            </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone No.</th>
                                    <td><input type="text" class="form-control" name="ucontact" value="<?php echo $emp[0]['ucontact'];?>"></td>
                                    <th>Location</th>
                                    <td><select class="form-control" name="country" id="country" onchange="get_details('country','state','<?php echo $base_url.'index.php?action=leads&query=get_details&type=state&id=';?>')">
									<option disabled="disabled" selected="selected" >-- Select --</option>
									<?php $country=$admin->get_country();
									foreach($country as $r => $v)
									{
										echo "<option value='".$country[$r]['id']."'>".$country[$r]['name']."</option>";
									}?>
								  </select></td>
                                </tr>
                                <tr>
                                    <th>State</th>
									 <td>
                                     <select class="form-control" name="state" id="state" onchange="get_details('state','city','<?php echo $base_url.'index.php?action=leads&query=get_details&type=city&id=';?>')"></select>
                                     <span id="msgstate"></span> 
                                     </td>
									  <th>City</th>
									  <td><select class="form-control" name="city" id="city"></td>
                                </tr>      
                                
                                <tr>
                                    <th>Date of Birth</th>
                                    <td><input type="date" class="form-control" name="dob" value=""></td>
                                    <th>Family Linkage</th>
                                    <td><input type="text" class="form-control" name="family_linkage" value=""></td>
                                </tr>
                                <tr>
                                    <th>Religon</th>
                                    <td>
                                            <select name="religion" class="form-control">
                                            <option>-- Select --</option>
                                            <?php $religion = $admin->get_metaname_byvalue('religion'); 

                                            //	$user = array_unique($user0);
                                            foreach($religion as $k=>$value)
                                            {
                                            if($religion[$k]['meta_value2']=='1'){continue;}
                                            echo "<option value='".$religion[$k]['value1']."'>".$religion[$k]['value1']."</option>";
                                            }
                                            ?>
                                            </select>
                                    </td>
                                    <th>Goals</th>
                                    <td><input type="text" class="form-control" name="goal" value=""></td>
                                </tr>
                                <tr>
                                    <th>Pain Point / Challanges</th>
                                    <td colspan="3"><input type="text" class="form-control" name="point" value=""></td>
                                </tr>
                                <tr>
                                    <th>Boying Motivations</th>
                                    <td colspan="3"><input type="text" class="form-control" name="motivation" value=""></td>
                                </tr>
                                <tr>
                                    <th>Prefered Channel Of Communication</th>
                                    <td colspan="3"><input type="text" class="form-control" name="channel" value=""></td>
                                </tr>
                                <tr>
                                    <th>With Current Comapny Since</th>
                                    <td colspan="3"><input type="text" class="form-control" name="current_since" value=""></td>
                                </tr>
                                <tr>
                                    <th colspan="4">History Of Previous Jobs</th>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <table  id="addmore" class="table">
                                            <tr>
                                                <th>Company</th>
                                                <th>Designation</th>
                                                <th>From</th>
                                                <th>To</th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="company[]"></td>
                                                <td><input type="text" class="form-control" name="designation[]"></td>
                                                <td><input type="date" class="form-control" name="from[]"></td>
                                                <td><input type="date" class="form-control" name="to[]"></td>
                                            </tr>
                                            
                                        </table>
                                        <input type="button" name="addmore" id="addmore_btn" class="btn btn-info btn-xs" value="Add More Previous Jobs">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="submit" value="Save Profile" class="btn btn-md btn-success"></input></td>
                                </tr>
                            </table>
</form>
                        </div>            

            </div>    
        
        </section>     
        
    </div>        

</div>    



<script type="text/javascript">

$(document).ready(function() {

var max_fields      = 50; //maximum input boxes allowed
var wrapper         =  $("#addmore"); //Fields wrapper
var add_button      =  $("#addmore_btn"); //Add button ID
var x = 1; //initlal text box count
        

$(add_button).click(function(e)
{ //on add input button click
    e.preventDefault();
    if(x < max_fields){ 
        x++; 
		
    $(wrapper).append('<tr id="addmore_tr'+x+'"><td><input type="text" class="form-control" name="company[]"></td><td><input type="text" class="form-control" name="designation[]"></td><td><input type="date" class="form-control" name="from[]"></td><td><input type="date" class="form-control" name="to[]"></td></tr>'); 

        
        }
      
    
    else
    {alert("Sorry, you can add only 50 Items in this segment");}

});



});


function removeme(x)
{
  //alert(x);
  $('#addmore_tr'+x).remove();
    //get_subtotal(x);
}  
</script>