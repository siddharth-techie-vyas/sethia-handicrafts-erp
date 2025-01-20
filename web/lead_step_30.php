<div class="box box-default">
    <div class="row">
        <div class="col-md-12">
            <div class="box-body">
                <form name="likedin" action="<?php echo $base_url.'index.php?action=leads&query=step_30';?>" method="post">
                    <input type="hidden" name="next_step" value="20">
                    <input type="hidden" name="lid" value="<?php echo $_GET['id'];?>"/>
            <table class="table table-bordered" id="addmore">
                    <tr>
                        <th>Contact Person Name</th>
                        <th>Contact Number</th>
                        <th>Decision Maker</th>
                        <th>Linkedin Profile</th>
                        <th>Meeting Date</th>
                        <th>Meeting Status</th>

                    </tr>
                    <?php 
                    $linkedin_con=array();
                        $get_details_comp = $leads->get_company_more_details('12',$_GET['id']);
                        foreach ($get_details_comp as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" name="id[]" value="<?php echo $get_details_comp[$key]['id'];?>"/>
                            <?php echo $get_details_comp[$key]['value1'];?>
                        </td>
                        <td><?php echo $get_details_comp[$key]['value2'];?></td>
                        <td><?php echo $get_details_comp[$key]['value3'];?></td>
                        <td><?php echo $get_details_comp[$key]['value4'];?></td>
                        <td><input type="date" value="<?php echo $get_details_comp[$key]['meeting_date'];?>" class="form-control" name="meeting_date"></td>
                        <td><?php echo $get_details_comp[$key]['meeting_status'];?></td>
                    </tr>
                    <?PHP }?>
                   <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update" class="btn btn-info btn-md">
                    </td>
                   </tr>
                </table>
                </form>

                <?php if(count($linkedin_con)>0){?>
                <table class="table table-bordered">
                    <tr>                    
                        <td colspan="2">
                            <span id="msgstep30"></span>
                            <form name="step30" id="step30" action="<?php echo $base_url.'index.php?action=leads&query=step_16to20';?>" method="post">
                                <input type="hidden" name="lid" value="<?php echo $_GET['id'];?>">
                                <input type="hidden" name="step" value="30">
                                <input type="button" onclick="form_submit_alert('step30')" name="submit" value="Schedule A Meeting First Meeting" class="btn btn-warning btn-md">
                            </form>
                        </td>
                    </tr>
                </table>
                <?php }?>        
            </div>
        </div>
    </div>
</div>        

