<?php 
function arraySearch($foo, $array){ 
                                        $mykeys = array();
                                            foreach($array as $key => $val){
                                                    if($val['assembly']=== $foo){
                                                    array_push($mykeys,$key);
                                                    }
                                                }
                                            return $mykeys;
                                            }
$part2=array();
$items=$sales->sales_rfq_items_item($_GET['id']);
$view=$sales->get_rfq_one($items[0]['sid']);
$itemtype=$items[0]['item_type'];
$part_details = json_decode($items[0]['part']);
$rm_cost_total=0;
$hardware_total=0;
$rm_qty_total=0;
$board_cft = 0;
$rm_qty_mdf_total=0;
$rm_cost_mdf = 0;
$wood_cft = 0;
$rm_qty_wood_total = 0;
$rm_cost_wood = 0;
$compound_polish=0;
?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th colspan="8"></th>
        </tr>
        <tr>
                <th></th>
                <th colspan="3">Size (LxWxH)</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Total</th>
        </tr>
    </thead>
    <tbody>
            <tr>
            <th colspan="8" class="text-info">Wood</th>
            </tr>
            
            
            <?php
            if($part_details !='')
            {
            foreach($part_details as $r=>$v)
                {
                    array_push($part2,$v->assembly);

                     $wood_type = $product->get_material_byid($v->wood);
                    //-- get l,w,h of pillar from materal_yield table on the basis of type and wood
                                            $wood_yield_l = $product->get_wood_yield($v->wood,'L',$v->length); 
                                            $wood_yield_w = $product->get_wood_yield($v->wood,'W',$v->width); 
                                            $wood_yield_h = $product->get_wood_yield($v->wood,'H',$v->height); 
                                            //-- sizes has been float as per the db entries
                                            $pillar_l = number_format((float)$wood_yield_l[0]['thickness'], 1, '.', '');
                                            $pillar_w = number_format((float)$wood_yield_w[0]['thickness'], 0, '.', '');
                                            $pillar_h = number_format((float)$wood_yield_h[0]['thickness'], 2, '.', '');
                                            $pillar_size_converted=$pillar_l."ft x ".$pillar_w."in x ".$pillar_h."in";
                                            //-rm qty
                                            $rm_qty = $v->qty*$wood_yield_l[0]['thickness_stack']*$wood_yield_w[0]['thickness_stack']*$wood_yield_h[0]['thickness_stack'];
                                            $rm_qty_total += $rm_qty;
                                            
                                            //-- rm cft
                                            $rm_group=$product->get_rm_group($v->wood,$wood_yield_l[0]['thickness'],$wood_yield_w[0]['thickness'],$wood_yield_h[0]['thickness']);
                                            $rm_cft = $rm_group[0]['paycft'];
                                            //-- rm rate 
                                            $rm_rate = $product->get_rm_rate($wood_type[0]['material_name'],$rm_group[0]['rate_group']);
                                            $rm_rate_total += $rm_rate;
                                            //-- comp cft 
                                            $comp_cft = $rm_qty*$rm_cft ;
                                            $comp_cft=number_format((float)$comp_cft, 2, '.', '');
                                            //-- rm cost
                                            $rm_cost = $rm_rate*$comp_cft;
                                            //-- check if board / wood
                                                    if (str_contains($wood_yield_h[0]['wood_type'], 'Board')) { 
                                                            $board_cft += $comp_cft;
                                                            $rm_qty_mdf_total += $rm_qty;
                                                            $rm_cost_mdf += $rm_cost;
                                                        }
                                                    else
                                                        {
                                                            $wood_cft += $comp_cft;
                                                            $rm_qty_wood_total += $rm_qty;
                                                            $rm_cost_wood += $rm_cost;
                                                        }
                                            
                                            $rm_cost_total += $rm_cost;
            ?>
            <tr>
                <th><?php echo $wood_type[0]['material_name'].' - '.$pillar_size_converted;?></th>
                <td><?php echo $v->length;?></td>
                <td><?php echo $v->width;?></td>
                <td><?php echo $v->height;?></td>
                <td><?php echo $rm_qty;?></td>
                <td><?php echo $rm_rate;?></td>
                <td><?php echo $rm_cost;?></td>
                <td></td>
            </tr>
            <?php }
            // echo "<tr>";
            // echo "<td></td>";
            // echo "<td></td>";
            // echo "<td></td>";
            // echo "<td></td>";
            // echo "<td>".$rm_qty_total."</td>";
            // echo "<td></td>";
            // echo "<td>".$rm_cost_total."</td>";
            // echo "<td></td>";
            // echo "</tr>";


            echo "<tr>";
            echo "<td colspan='3'></td>";
            echo "<th>Wood</th>";
            echo "<td>".$rm_qty_wood_total."</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<th>".$rm_cost_wood."</th>";
            echo "<tr>";

            echo "<tr>";
            echo "<td colspan='3'></td>";
            echo "<th>MDF / Board</th>";
            echo "<td>".$rm_qty_mdf_total."</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<th>".$rm_cost_mdf."</th>";
            echo "<tr>";
            }else{ echo '<tr><td colspan="8">No Record Found</td></tr>';}?>

            <?php 
            //--------- polish rates
                        $polish = json_decode($items[0]['finish'],true);
                        $part3=array_unique($part2);
                        foreach($part3 as $key=>$c)
                        {
                            $search=arraySearch($c,$polish);
                            echo "<tr style='display:none;'>";
                                echo "<td>".$c."</td>";
                                echo "<td>".$polish[$key]['length'].' x '.$polish[$key]['width'].' x '.$polish[$key]['height']."</td>";
                                echo "<td>";
                                //-- if found in search array
                               $dimension =($polish[$key]['length']/25.4*$polish[$key]['width']/25.4*2)/144;
                               +($polish[$key]['length']/25.4*$polish[$key]['height']/25.4*2)/144+($polish[$key]['width']/25.4*$polish[$key]['height']/25.4*2)/144;
                               echo $dimension = round($dimension,2);
                                echo "</td>";
                                echo "<td>";
                                    echo $compound = $dimension*$polish[$key]['qty'];
                                echo "</td>";
                            echo "</tr>";

                            $compound_polish += $compound;
                            
                        }                
                    ?>

            <tr><th colspan="8" class="text-warning">Hardware & Indirect Material</th></tr>
            <?php $hardware_details=json_decode($items[0]['hardware']);
                        $hcount=1;
                        if($hardware_details !='')
                        {
                            foreach($hardware_details as $h1=>$h)
                                            {
                                                $item = $store->get_item_one($h->hardware);
                                                $cat = $store->get_cat_single($item[0]['cat']);
                        echo "<tr>";
                        echo "<td>".$cat[0]['cat'].' - '.$item[0]['product_name']."</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>".$h->qty."</td>";
                        echo "<td>".$h->price."</td>";                        
                        echo "<td>".$h->total."</td>";
                        $hardware_total += $h->total;
                    echo "</tr>";
                    $hcount++;

                    }
                echo "<tr>";
                echo "<td colspan='6'></td>";
                echo "<th>Total : </th>";
                echo "<td>".$hardware_total."</td>";
                echo "<tr>";
                    }else{echo "<tr><td colspan='8'>No Record Found</td></tr>";}
                ?>

                <tr><th colspan="8" class="text-secondary">Iron Structure</th></tr>
                <?php $iron_details=json_decode($items[0]['iron']);
                        $hcount=1;
                        if($iron_details !='')
                        {
                            foreach($iron_details as $h1=>$h)
                                            {
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>".$h->qty."</td>";
                        echo "<td>".$h->price."</td>";                        
                        echo "<td>".$h->total."</td>";
                        echo "<td>";
                    echo "</tr>";
                    $hcount++;

                    }
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<th>Total : </th>";
                echo "<td></td>";
                echo "<tr>";
                    }else{echo "<tr><td colspan='8'>No Record Found</td></tr>";}
                ?>

                 <tr><th colspan="8" class="text-primary">Labour Charges</th></tr>
                 <tr>
                    <th>Carpentry</th>
                    <td colspan="5"></td>
                    <td><?php echo $carpentry=($rm_qty_wood_total*200)+($rm_qty_mdf_total*10);?></td>
                    <td></td>
                 </tr>
                 <tr>
                    <th>Turning</th>
                    <td colspan="3"></td>
                    <td><input type='number' class='form-control' name='turning_qty' id='turning_qty'></td>
                    <td><input type='number' class='form-control' name='turning_rate' id='turning_rate'></td>
                    <td><input type='number' class='form-control' name='turning_amount' id='turning_amount'></td>
                    <td></td>
                 </tr>
                 <tr>
                    <th>Fitting</th>
                    <td colspan="5"></td>
                    <td><input type='number' class='form-control' name='fitting_amount' id='fitting_amount'></td>
                    <td></td>
                 </tr>
                 <tr class="bg-secondary"><th colspan="6">Cost Of Structure</th><td colspan="2"></td></tr>




                 <tr><th colspan="8" class="text-primary">Polish Material</th></tr>
                 <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $compound_polish;?></td>
                    <td>15</td>
                    <td><?php echo $polish_rate = $compound_polish*15;?></td>
                    <td></td>
                 </tr>
                 <tr>
                    <td>Contigencies @ 10%</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $polish_rate2 = $polish_rate*0.10;?></td>
                    <td><?php  $polish_total = $polish_rate+$polish_rate2;?></td>
                 </tr>
                <tr><th colspan="8" class="text-secodnary">Labour Charges</th></tr>
                <tr>
                    <td>Powder Coating</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                 </tr>
                 <tr>
                    <td>Polish Labour</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $polish_rate;?></td>
                    <td>10</td>
                    <td><?php echo $polish_labour_rate=$polish_rate*0.10;?></td>
                    <td></td>
                 </tr>
                 <tr  class="bg-success"><th colspan="6" >Cost Of Polish</th><td colspan="2"><?php echo $cost_polish = $polish_labour_rate+$polish_total;?></td></tr>



                 <tr><th colspan="8">Packing Material</th></tr>
                  <?php 
                                        $pval=array();
                                        $packing_details = json_decode($items[0]['packing']);
                                        
                                            $pval = array (
                                                "length"=>$packing_details->length,
                                                "width"=>$packing_details->width,
                                                "height"=>$packing_details->height,
                                                "cbm"=>$packing_details->cbm,
                                                "labour_cost"=>$packing_details->labour_cost,
                                                "total"=>$packing_details->total
                                                );
                                       
                                    ?>
                 <tr>
                    <td></td>
                    <td><?php echo $pval['length'];?> (MM)</td> 
                    <td><?php echo $pval['width'];?> (MM)</td> 
                    <td><?php echo $pval['height'];?> (MM)</td> 
                    <td>1</td>
                    <td><input type='number' class='form-control' name='packing_rate' id='packing_rate'></td>
                    <td></td>
                    <td></td>
                 </tr>
                 <tr>
                    <td>Packing Material</td>
                    <td></td>
                    <td></td>
                    <td>
                        <?php  
                        $clength=$pval['length']*0.0393701;
                        $cwidth=$pval['width']*0.0393701;
                        $cheight=$pval['height']*0.0393701;
                        $packing_cost = $clength*$cwidth*$cheight;
                        $packing_cost=$packing_cost/61000;  
                        echo $packing_cost=round($packing_cost,3)?>
                    </td>
                    <td><input type='number' class='form-control' name='cartoon_rate' id='cartoon_rate'></td>
                    <td><input type='number' class='form-control' name='cartoon_amt' id='cartoon_amt'></td>
                    <td></td>
                 </tr>
                 <tr>
                    <td>Mislleneous Items</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type='number' class='form-control' name='mislleneous_amt' id='mislleneous_amt'></td>
                    <td></td>
                 </tr>
                <tr><th colspan="8">Labour Charges</th></tr>
                <tr>
                    <td>Packing Labour</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php  echo $packing_cost; ?></td>
                    <td><input type='number' class='form-control' name='packing_labour_rate' id='packing_labour_rate'></td>
                    <td></td>
                    <td></td>
                 </tr>
                 <tr>
                    <td>Loading Items</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php  echo $packing_cost; ?></td>
                    <td><input type='number' class='form-control' name='packing_laoding_rate' id='packing_laoding_rate'></td>
                    <td></td>
                    <td></td>
                 </tr>

                 <tr class="bg-warning"><th colspan="5">Cost Of Packing and Loading</th><td colspan="3"></td></tr>
                 <tr class="bg-secondary"><th colspan="5">FOB Charges</th><td colspan="3"></td></tr>
                 <tr class="bg-info"><th colspan="5">Cost (INR)</th><td colspan="3"></td></tr>
                 <tr class="bg-primary"><th colspan="5">Cost In USD</th><td colspan="3"></td></tr>
                 <tr class="bg-primary"><th colspan="5">Cost In USD</th><td colspan="3"></td></tr>
                 <tr class="bg-primary"><th colspan="5">Price In USD After 10% Discount</th><td colspan="3"></td></tr>
                 <tr class="bg-primary"><th colspan="5">Cost In USD After 20% Discount</th><td colspan="3"></td></tr>
                 <tr class="bg-primary"><th colspan="5">Cost In USD After 25% Discount</th><td colspan="3"></td></tr>
                 <tr class="bg-danger"><th colspan="5">Loadability</th><td colspan="3"></td></tr>


    
                    
    </tbody>
</table>