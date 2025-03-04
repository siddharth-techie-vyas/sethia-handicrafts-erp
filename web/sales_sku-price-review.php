<form name="step08_edit" id="step08_edit" action="<?php echo $base_url.'index.php?action=sales&query=rfq_step08_edit';?>" method="post">
<input type="hidden" name="sid" value="<?php echo $_GET['id'];?>">          
<?php 
$items=$sales->sales_rfq_items($_GET['id']);
if($items){
   
        $item_count = count($items);
        $counter=1;
        foreach($items as $row=>$v){?>
    <div class="col-md-12">
        <div class="row">
                
                
                <div class="col-sm-3">
                    <input type="hidden" name="itemid[]" value="<?php echo $items[$row]['id'];?>"/>
                    <h5>
                    <?php echo $counter++.')';  
                    $itemtype=$items[$row]['item_type'];
                    if($itemtype=='2' || $itemtype=='3' || $itemtype=='1')
                    { 
                        $sku=$product->getone($items[$row]['pid']);
                        echo $sku[0]['sku'].'<br>';
                        echo '<small class="text-secondary">'.$sku[0]['product_name'].'</small>';
                    }else{
                        $sku=$product->getone_temp($items[$row]['pid']);
                        echo $sku[0]['sku'].'<br>';
                        echo '<small class="text-secondary">'.$sku[0]['product_name'].'</small>';
                    }
                    ?>
                    </h5>
                    <?php if($itemtype != '1'){?>
                    <table border="1">
                        <tr>
                            <th colspan="2">Customization</th>
                        </tr>
                        <tr>
                            <th class="bg-danger">Wood</th><td><?php echo $items[$row]['wood'];?></td>
                        </tr>
                        <tr>
                            <th class="bg-warning">Fitting</th><td><?php echo $items[$row]['fitting'];?></td>
                        </tr>
                        <tr>
                            <th class="bg-info">Packing</th><td><?php echo $items[$row]['packing'];?></td>
                        </tr>
                        <tr>
                            <th class="bg-secondary">Finish</th><td><?php echo $items[$row]['finish'];?></td>
                        </tr>
                        <tr>
                            <th class="bg-primary">Branding</th><td><?php echo $items[$row]['branding'];?></td>
                        </tr>
                        
                    </table>
                    <?php }?>
                </div>
                
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="sku">Client Attachment</label><br>
                        <?php
                         $file=$items[$row]['file'];
                         if(!empty($file))
                         {
                            $ext = pathinfo($file, PATHINFO_EXTENSION);
                            //-- image
                            if($ext=='jpg' || $ext=='avi' || $ext=='jpeg' || $ext=='png' || $ext=='gif' )
                            { echo "<img src='".$base_url."images/".$file."' width='100px' height='auto'>";}
                            else
                            {
                                echo "<a target='_blank' href='".$base_url."images/".$file."' class='btn btn-secondary btn-sm'>View</a>";
                            }
                         }
                         ?>
                    </div>    
                </div>
                <div class="col-sm-3">
                    <h5>Client's Data</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td>Status</td>
                            <td>Remark</td>
                        </tr>
                    </table>
                </div>


                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price[]" value="<?php echo $items[$row]['price'];?>" placeholder="Enter price">

                        <label for="bom">BOM</label>
                        <input type="text" class="form-control" id="bom" name="bom[]" value="<?php echo $items[$row]['bom'];?>"  placeholder="Enter bom">
                    </div> 
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="sitems">Similar Items Price </label>
                        <input type="text" class="form-control" id="sprice" name="sprice[]" value="<?php echo $items[$row]['sprice'];?>"  placeholder="Enter Price">

                        <label for="bom">Similar Items Image</label>
                        <input type="file" class="form-control" id="sfile" name="sfile[]" placeholder="Enter Similar Item Images">
                    </div> 
                </div>

        </div>
        <hr>
    </div>
<?php } } ?>
<div class="col-sm-12">
    <div class="col-sm-3">
        <input type="submit" name="step08_submit" value="Update and Process" class="btn btn-warning">
    </div>
</div>
</form>