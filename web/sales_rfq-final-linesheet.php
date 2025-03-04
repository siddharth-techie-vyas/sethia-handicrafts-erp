<?php $items=$sales->sales_rfq_items($_GET['id']);
        $item_count = count($items);
        $counter=1;
       
        //-- beneficiery details
        $bene=$sales->get_baneficiery($view[0]['prospect']);
        ?>

<a href="#" type="button" class='btn btn-info' name="pdf"  type="button" onclick="htmlget('pdfdown','<?php echo 'SHPL-RFQ-'.$_GET['id'];?>')" value="get html" style="display:inline"><i class="fa fa-file-pdf"></i> Download PDF</a>


<form name="step0_edit" id="step00_edit" action="<?php echo $base_url.'index.php?action=sales&query=rfq_step6_edit'?>" method="post" style="display:inline">
<input type="hidden" name="sid" value="<?php echo $_GET['id'];?>">     
<input type="submit" name="step1" value="Submit to Step 7" class="btn btn-warning btn-md">  
</form>

<div id="editor"></div>
<hr>

<div id="pdfdown">
<table class="table table-bordered border-dark">
    <tr>
        <th colspan="7">
        <?php
        $path = $base_url.'/images/'.$_SESSION['logo'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <img src="<?php echo $base64?>" width="auto" height="90"/> 
        
        <!-- <img src="<?php echo $base_url.'/images/'.$_SESSION['logo'];?>"width="165" height="auto"> -->
        <br>
        <small><?php echo $_SESSION['address'];?></small>
        </th>
        <td colspan="7"></td>        
    </tr>
    <tr>
        <th colspan="14" class="text-center bg-secondary">Quotation</th>
    </tr>
    <tr>
        <th colspan="7">Invoice Address</th>
        <th colspan="7">Delivery / Ship To Address</th>
    </tr>
    <tr>
        <td colspan="7"><?php echo $bene[0]['address'];?></td>
        <td colspan="7"></td>
    </tr>
    <tr>
        <th colspan="3">Your Enquiry Ref#</th>
        <td colspan="4"><?php echo $view[0]['rfq_number'];?></td>
        <th colspan="3">SHPL Reference Ref#</th>
        <td colspan="4"><?php echo 'SHPL-RFQ-'.$view[0]['id'];?></td>
</tr>
<tr>    
        <th colspan="3">Your Enuiry Date</th>
        <td colspan="4"><?php echo date('d-m-Y', strtotime($view[0]['date_of_rfq'])); ?></td>
        <th colspan="3">SHPL Ref Date</th>
        <td colspan="4"><?php echo date('d-m-Y', strtotime($view[0]['created_date'])); ?></td>
</tr>
<tr>  
        <th colspan="3">Your Contact person</th>
        <td colspan="4"><?php echo $bene[0]['fname'].' '.$bene[0]['lname'];?></td>
        <th colspan="3">SHPL Contact</th>
        <td colspan="4"><?php ?></td>
</tr>
<tr>
        <th colspan="3">Phone / Email</th>
        <td colspan="4"><?php echo $bene[0]['email'].' / '.$bene[0]['phone'];?></td>
        <th colspan="3">SHPL Contact / Email</th>
        <td colspan="4"></td>
    </tr>

<tr>
    <th>Product Image</th>
    <th>items</th>
    <th>Product Name</th>
    <th>Dimension</th>
    <th>Price USS</th>
    <th>Materials</th>
    <th>Finishes</th>
    <th>CBM</th>
    <th>MOQ<br><small>Per Order</small></th>
    <th>Order Amount</th>
    <th>Discount</th>
    <th>Final Price</th>
    <th>Repeats / PA</th>
    <th>PA Business Estimate</th>
</tr>    
<?php 
$final_price=0;
$final_repeat=0;
$total=0;
$discount =0;
$items=$sales->sales_rfq_items($_GET['id']);
        $item_count = count($items);
        $counter=1;
        foreach($items as $row=>$v){

            $itemtype=$items[$row]['item_type'];
            
        ?>
        <tr>
            <td></td>
            <td><?php 
            if($itemtype=='2' || $itemtype=='3' || $itemtype=='1')
            { 
                $sku=$product->getone($items[$row]['pid']);
                echo $sku[0]['sku'].'<br>';
                
            }else{
                $sku=$product->getone_temp($items[$row]['pid']);
                echo $sku[0]['sku'].'<br>';
                
            }
            ?></td>
            <td><?php echo $sku[0]['product_name'];?></td>
            <td><?php echo $items[$row]['length'].' x '.$items[$row]['width'].' x '.$items[$row]['height'];?></td>
            <td><?php echo $items[$row]['price'];?></td>
            <td><?php echo $items[$row]['material'];?></td>
            <td><?php echo $items[$row]['finish'];?></td>
            <td></td>
            <td><?php echo $items[$row]['moq'];?></td>

            <td><?php echo $price = $items[$row]['moq'] * $items[$row]['price']; $final_price+=$price;?></td>

            <td><?php echo $dis=$items[$row]['discount_amt']; $discount += $dis;?></td>

            <td><?php echo $final_total=$price-$items[$row]['discount_amt']; $total+=$final_total;?></td>

            <td><?php echo $items[$row]['repeat_pa'];?></td>

            <td><?php echo $repeat_pa = $price * $items[$row]['repeat_pa']; $final_repeat+=$repeat_pa;?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="9"></td>
            <th class="bg-secondary"><?php echo $final_price;?></th>
            <td class="bg-primary"><?php echo $discount;?></td>
            <th class="bg-success"><?php echo $total;?></th>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th colspan="14">Terms & Conditions</th>
        </tr>
        <tr>
            <td colspan="14">
                <?php 
                //-- get tandc
                $tandc=$sales->get_prospect_tandc($view[0]['prospect']);
                ?>
                <ol>
                    <li>Incoterms = <em><?php echo $tandc[0]['incoterms'];?></em> </li>
                    <li>Shipping-Quantum = <em><?php echo $tandc[0]['shipping'];?></em> 
                        <ul> <li>-Shipping - Basis = <em><?php echo $tandc[0]['shipping_basis'];?></em></li></ul>
                    </li>
                    <li>Transaction Currency = <em><?php echo $tandc[0]['currency'];?></em></li>
                    <li>Product Liability Insurance = <em><?php echo $tandc[0]['liability'];?></em></li>
                    <li>Payment Terms - Confirmation = <em><?php echo $tandc[0]['liability_per'];?></em>
                        <ul>
                            <li>- Progress Payment = <em><?php echo $tandc[0]['no_advance'];?></em>
                            <li>- Balance Payment = <em><?php echo $tandc[0]['balance'];?></em>
                            <li>- Retention = <em><?php echo $tandc[0]['retention_period'];?></em>
                            <li>- Documentation (non-LC) = <em><?php echo $tandc[0]['progress_payment'];?></em>
                        </ul>
                    
                    </li>
                    <li>Price Validity Considered = <em><?php echo $tandc[0]['price_validity'];?></em>
                    <li>Social Compliance Audit Requirement = <em><?php echo $tandc[0]['audit1'];?></em>
                    <li>CTPAT Audit Requirement = <em><?php echo $tandc[0]['ctpat'];?></em>
                    <li>Late Shipment Penalty = <em><?php echo $tandc[0]['lateshipment_per'];?></em>
                    <li>Defective Product Chargeback = <em><?php echo $tandc[0]['repair_labour_rate'];?></em>
                    <li>Commissionable= <em><?php echo $tandc[0]['repair_labour_rate_limit'];?></em>
                    <li>Development Sample = <em><?php echo $tandc[0]['sample'];?></em>
                    <li>Photography Sample = <em><?php echo $tandc[0]['photography'];?></em>
                    <li>General Packing Standard = <em><?php echo $tandc[0]['packing'];?></em>
                    <li>Product Testing= <em><?php echo $tandc[0]['product_testing'];?></em>
                    <li>Packing Testing= <em><?php echo $tandc[0]['packing_testing'];?></em>
                    <li>FSC Options Required = <em><?php echo $tandc[0]['fsc'];?></em>
                    <li>Client requires own Branding on Product= <em><?php echo $tandc[0]['branding'];?></em>
                </ol>
            </td>
        </tr>
        <tr>
            <th colspan="7">
                Your Sincerly,<br>
                <?php echo $_SESSION['cname'];?><br><br><br><br><br>
                Managing Director
            </th>
            <th colspan="7"></th>
        </tr>
</table>
</div>