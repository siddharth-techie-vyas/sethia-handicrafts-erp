<div class="box box-default">
    <div class="row">
        <div class="col-md-12">
            <div class="box-body">
                <form name="likedin" action="<?php echo $base_url.'index.php?action=leads&query=step_17';?>" method="post">
                    <input type="hidden" name="next_step" value="18">
                    <input type="hidden" name="lid" value="<?php echo $_GET['id'];?>"/>
            <table class="table table-bordered" id="addmore">
                    <tr>
                        <th>Contact Person Name</th>
                        <th>Contact Number</th>
                        <th>Decision Maker</th>
                        <th>Linkedin Profile</th>
                        <th>Request Send</th>
                        <th>Accepted</th>
                        <th>Follow Up EMail Send</th>
                    </tr>
                    <?php 
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
                        <td>
                        <?php 
                            $req='';
                            if($get_details_comp[$key]['value5']=='1'){$req= "Yes";}
                            if($get_details_comp[$key]['value5']=='0'){$req= "No";}
                            echo $req;
                        
                            if($req=='Yes')
                            {echo ' ('.date('d-m-Y h:i:s',strtotime($get_details_comp[$key]['value6'])).')';}
                        ?>
                        </td>
                        <td>
                            <select name="value7[]" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0" selected='selected'>No</option>
                            </select>   
                            
                        </td>
                        
                        <td>
                            <select name="value8[]" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0" selected='selected'>No</option>
                            </select>   

                            <input type="hidden" name="value9[]" value="0"/>
                            <input type="hidden" name="value10[]" value="0"/>
                        </td>
                    </tr>
                    <?PHP }?>
                   <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Save Details & Process To Next Step" class="btn btn-info btn-md">
                    </td>
                   </tr>
                </table>
                </form>

                
            </div>
        </div>
    </div>
</div>        

