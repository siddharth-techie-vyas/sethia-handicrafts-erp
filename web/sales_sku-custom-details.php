<style>
    .form-control-sm{width:90%;}
</style>
<form name="step0_edit" id="step00_edit" action="<?php echo $base_url.'index.php?action=sales&query=rfq_step05_edit'?>" method="post">
<input type="hidden" name="sid" value="<?php echo $_GET['id'];?>">          

<table class="table table-bordered">
    <tr>
        <th>Image</th>
        <th>SKU & Type</th>
        <th width="10%">Length</th>
        <th width="10%">Width</th>
        <th width="10%">Height</th>
        <th colspan="6">Customization</th>
    </tr>
    <tr>
        <td colspan="5"></td>
        <td class="bg-danger"><i class="ti-ruler-alt-2"></i> Wood</td>
        <td class="bg-success"><i class="ti ti-cut"></i> Fitting</td>
        <td class="bg-info"><i class="ti ti-paint-bucket"></i> Finish</td>
        <td class="bg-secondary"><i class="ti  ti-package"></i> Packing</td>
        <td class="bg-primary"><i class="ti ti-dropbox"></i> Branding</td>

    </tr>
    <?php $items=$sales->sales_rfq_items($_GET['id']);
    if($items){
        
    
        $item_count = count($items);
        $counter=1;
        foreach($items as $row=>$v){
        ?>
        
<tr id="<?php echo $items[$row]['id'];?>">
  
  <td></td>
  <td>
  
  <input type="hidden" name="itemid[]" value="<?php echo $items[$row]['id'];?>">
                  
          
          <?php 
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
            <br>
            <small class="text-danger">( 
               <?php if($items[$row]['item_type']=='1'){?>Standard Product<?php }?>
               <?php if($items[$row]['item_type']=='2'){?>Standard Product With Customization (eg: wood / fitting /finish)<?php }?>
               <?php if($items[$row]['item_type']=='3'){?>Standard Product With Size & Design Customization<?php }?>
               <?php if($items[$row]['item_type']=='4'){?>Product To Be Prototype (Client's Design)<?php }?>
               <?php if($items[$row]['item_type']=='5'){?>Product To Be Designed & Prototyped As Per Client's Intent<?php }?>
               <?php if($items[$row]['item_type']=='6'){?>Product To Be Ordered As Per Client Design<?php }?>
            )</small>
    </td>

      <td><input type="number" name="length[]"  class="form-control-sm" value="<?php echo $items[$row]['length'];?>" required="required"></td>
      <td><input type="number" name="width[]"  class="form-control-sm" value="<?php echo $items[$row]['width'];?>" required="required"></td>
      <td><input type="number" name="height[]"  class="form-control-sm" value="<?php echo $items[$row]['height'];?>" required="required"></td>

      <!--- conditional columns--------->
      <?php if($items[$row]['item_type']!='1'){?>
     <td><input type="text" name="wood[]"  class="form-control-sm" value="<?php echo $items[$row]['wood'];?>"/></td>
     <td><input type="text" name="fitting[]"  class="form-control-sm" value="<?php echo $items[$row]['fitting'];?>"/></td>
     <td><input type="text" name="finish[]"  class="form-control-sm" value="<?php echo $items[$row]['finish'];?>"/></td>
     <td><input type="text" name="packing[]"  class="form-control-sm" value="<?php echo $items[$row]['packing'];?>"/></td>
     <td><input type="text" name="branding[]"  class="form-control-sm" value="<?php echo $items[$row]['branding'];?>"/></td>
        <?php } else {?>
            <td><input type="hidden" name="wood[]" value=""/></td>
            <td><input type="hidden" name="fitting[]" value=""/></td>
            <td><input type="hidden" name="finish[]" value=""/></td>
            <td><input type="hidden" name="packing[]" value=""/></td>
            <td><input type="hidden" name="branding[]" value=""/></td>
    <?php }?>

    </tr>
<?php } }?>
    <tr>
        <td colspan="6"></td>
        <td><input type="submit" value="Update and Process"  name="step00_submit" class="btn btn-warning"></td>
    </tr>
</table>
        </form>