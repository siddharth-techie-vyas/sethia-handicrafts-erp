                    <!--- form starts--->
                    <span id="msgform<?php echo $_GET['pid'];?>"></span>

                    <form name="form<?php echo $_GET['pid'];?>" id="form<?php echo $_GET['pid'];?>" action="<?php echo $base_url.'index.php?action=sales&query=rfq_step05_edit_material';?>" method="post">

                    <input type="hidden"  name="pid" value="<?php echo $_GET['pid']; ?>"/>
                    <input type="hidden"  name="sid" value="<?php echo $_GET['sid'];?>"/>

                    <table class="table table-bordered" id="table<?php echo $_GET['pid'];?>">
                        <tr>
                            <th>Part</th>
                            <th>Material</th>
                            <th>Finish</th>
                        </tr>
                        <!-- check list id available-->
                         
                    </table> 
<hr>
                    <input type="button" class="btn btn-xs btn-warning" name="btn" value="Add More" class="add_btn" id="addmore_btn<?php echo $_GET['pid'];?>" />
                    <input type="button" onclick="form_submit('form<?php echo $_GET['pid'];?>')" class="btn btn-xs btn-info" value="Save">
                    </form>
                    <!-- form ends--->

<?php



$mtype=$product->get_material_unique();

    foreach($mtype as $w=>$v)
    {
        $material.= '<option>'.strtoupper($mtype[$w]['material_type']).'</option>';
    }    
    
?>      
<script type="text/javascript">

$(document).ready(function() {

var max_fields      = 50; //maximum input boxes allowed
var wrapper         =  $("#table<?php echo $_GET['pid'];?>"); //Fields wrapper
var add_button      =  $("#addmore_btn<?php echo $_GET['pid'];?>"); //Add button ID
var x = 1; //initlal text box count
    

$(add_button).click(function(e)
{ //on add input button click
    e.preventDefault();
    if(x < max_fields){ 
        x++; 
    $(wrapper).append('<tr id="addmore_tr'+x+'"><td><select name="part[]" id="mtype'+x+'" onchange="get_mtype('+x+')"><option disabled="disbaled" selected="selected">-Select</option><?php echo $material;?><option value="hardware">Hardware</option></select></td><td><select name="mtype[]" id="material'+x+'" onchange="get_ftype('+x+')"><option disabled="disbaled" selected="selected">-Select-</option></select></td><td><select name="finish[]" id="finish'+x+'"><option disabled="disbaled" selected="selected">-Select-</option></select></td><td><i class="fa fa-trash" onclick="removeme('+x+')"></td></tr>'); 
    $('.select2').select2();
        
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