<form name="step3_edit" id="step03_edit" action="<?php echo $base_url.'index.php?action=sales&query=rfq_step3_edit'?>" method="post">
<input type="hidden" name="sid" value="<?php echo $_GET['id'];?>">     
<input type="submit" name="step1" value="Submit to Step 4" class="btn btn-warning btn-md">     
</form>



<form method="POST" action="<?php echo $base_url.'index.php?action=sales&query=prospect3_1'?>" id="form" name="form">
    <input type="hidden" value="<?php echo $pro1[0]['id'];?>" name="pid">
<table class="table table-bordered table-reponsive">
    <?php 
    if($pro1[0]['export'] !='0'){
    ?>
    <tbody>
        <tr>
            <th colspan="2">TERMS CONDITIONS</th>
            
        </tr>
        <tr>
             <td></td>
            <td>
                 FOR EXPORTS 
            </td>
            <td  >
                 NON-EXPORTS 
            </td>
             
        </tr>
        <tr>
            <td>
                1. Incoterms
            </td>
            <td>
            <select id="export" name="incoterms" class="form-control">
                <option disbaled="disabled">-Select-</option>
                <option <?php if($tandc[0]['incoterms']=='FOB-Mundra/Pipava'){echo "selected='selected'";}?>>FOB-Mundra/Pipava</option>
                <option <?php if($tandc[0]['incoterms']=='CIF'){echo "selected='selected'";}?>>CIF</option>
            </select>    
            
            </td>
            
             
            <td>
                
                <select id="domestic" name="incoterms" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['incoterms']=='Ex Works'){echo "selected='selected'";}?>>Ex Works</option>
                    <option <?php if($tandc[0]['incoterms']=='DPU'){echo "selected='selected'";}?>>DPU</option>
                </select>     
            </td>
           
        </tr>


        <tr>
            <td>
                2. Shipping - Quantum
            </td>
            <td>
                <select id="export" name="shipping" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['shipping']=='FCL'){echo "selected='selected'";}?>>FCL</option>
                    <option <?php if($tandc[0]['shipping']=='FCL/LCL'){echo "selected='selected'";}?>>FCL/LCL</option>
                    <option <?php if($tandc[0]['shipping']=='LCL'){echo "selected='selected'";}?>>LCL</option>
                </select>
                  
            </td>
            
            <td>
             <select id="domestic" name="shipping" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['shipping']=='FTL'){echo "selected='selected'";}?>>FTL</option>
                    <option <?php if($tandc[0]['shipping']=='LTL'){echo "selected='selected'";}?>>LTL</option>
                </select>
                
            </td>             
        </tr>


        <tr>
            <td>
            Shipping - Basis
            </td>
            <td>
            <select id="export" name="shipping-basis" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['shipping-basis']=='Shipper PDA '){echo "selected='selected'";}?>>Shipper PDA</option>
                    <option <?php if($tandc[0]['shipping']=='Liner PDA'){echo "selected='selected'";}?>>Liner PDA</option>
                    
                </select>
                 
            </td>
            <td>
               
            </td>
        </tr>
        
        
        <tr>
            <td>
                3. Transaction Currency
            </td>
            <td>
            <select id="export" name="currency" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['currency']=='USD'){echo "selected='selected'";}?>>USD</option>
                    <option <?php if($tandc[0]['currency']=='EURO'){echo "selected='selected'";}?>>Euro</option>
                </select>
            </td>
            
             
            <td>
            <select id="domestic" name="currency" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['currency']=='INR'){echo "selected='selected'";}?>>INR</option>                    
                </select>
            </td>
             
             
        </tr>
        
        <tr>
            <td>
                4. Product Liability Insurance
            </td>
            <td>
            <select id="export" name="liability" class="form-control" onchange="show_txtbox('Required_Costs')">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['currency']=='No Stated Requirement'){echo "selected='selected'";}?>>No Stated Requirement</option>    
                    <option <?php if($tandc[0]['currency']=='Required Costs %'){echo "selected='selected'";}?>>Required Costs %</option>                
                </select>
                 <div class="allhide" id="Required_Costs">
                    <hr>
                    <label>Required Costs Value (%)</label>
                     <input type="text" name="liability_per" value="<?php echo $tandc[0]['liability_per'];?>" class="form-control-sm">
                 </div>
            </td>
            <td>
                
            </td>
        </tr>

        <tr>
            <td>
                5. Payment Terms - Confirmation
            </td>
            <td colspan="2">
            <select name="advance" class="form-control" onchange="show_txtbox('Advance_30')">
                <option disbaled="disabled">-Select-</option>
                    <option  <?php if($tandc[0]['advance']=='Without Advance'){echo "selected='selected'";}?>>Without Advance</option>    
                    <option  <?php if($tandc[0]['advance']=='Advance (30%)'){echo "selected='selected'";}?>>Advance (30%)</option>    
                    <option  <?php if($tandc[0]['advance']=='LC at Sight'){echo "selected='selected'";}?>>LC at Sight</option>    
                    <option  <?php if($tandc[0]['advance']=='LC Usance'){echo "selected='selected'";}?>>LC Usance</option>                
                </select>

                <div class="allhide" id="Advance_30">
                    <hr>
                    <label>Required Costs Value (%)</label>
                     <input type="text" name="advance_per" value="<?php echo $tandc[0]['advance_per'];?>" class="form-control-sm">
                 </div>
                
            </td>
        </tr>
        
        <tr>
            <td>
                - Progress Payment
            </td>
            
            <td colspan="2">
               
            
                <div id="domestic">
                    <div class="demo-radio-button row">
                        <div class="col-sm-4">
                            <input name="no_advance" type="checkbox" id="radio_1" <?php if($tandc[0]['no_advance']=='1'){echo "checked";}?>>
                            <label for="radio_1">No Progress Payment</label>
                        </div>
                        <div class="col-sm-4">
                            <input name="further_advance_per0" type="checkbox" id="radio_2" value="1" onclick="show_bycheck('radio_2','further_advance_per_val')" <?php if($tandc[0]['further_advance_per0']=='1'){echo "checked"; $further_advance_per0="display:block;";}else{$further_advance_per0="display:none;";}?>>
                            <label for="radio_2">Further Advance %</label>
                            <input type="text" name="further_advance_per_val" value="<?php echo $tandc[0]['further_advance_per_val'];?>" class="form-control-sm" id="further_advance_per_val" style="<?php echo $further_advance_per0;?>">
                        </div>
                        <div class="col-sm-4">    
                            <input name="further_advance" type="checkbox" id="radio_3" value="2" onclick="show_bycheck('radio_3','further_advance_val')" <?php if($tandc[0]['further_advance']=='1'){echo "checked"; $further_advance="display:block;";}else{$further_advance="display:none;";}?>>
                            <label for="radio_3">Further Advance</label>
                            <input type="text" name="further_advance_val" value="<?php echo $tandc[0]['further_advance_val'];?>"  class="form-control-sm" id="further_advance_val" style="<?php echo $further_advance;?>">
                        </div>    
					</div>
                </div>
            </td>
            
        </tr>


        <tr>
            <td>
                - Balance Payment
            </td>
            <td>
                <label>Credit Basis</label>
            <select name="balance" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['balance']=='Handover'){echo "selected='selected'";}?>>Handover</option>  
                    <option <?php if($tandc[0]['balance']=='Incoterm'){echo "selected='selected'";}?>>Incoterm</option>     
                </select>  
                
            </td>
            <td>
                 <label>Credit Period (Days)</label>
                 <input type="number" name="credit_period" value="<?php echo $tandc[0]['credit_period'];?>" class="form-control">
            </td>
        </tr>
        
        
        <tr>
            <td>
                - Retention 
            </td>
            
            <td>
                <label>Retention Period</label>    
                <input type="number" name="retention_period" value="<?php echo $tandc[0]['retention_period'];?>"  class="form-control">
            </td>
            <td>
                <label>Progress Payment</label>
                <input type="number" name="progress_payment" value="<?php echo $tandc[0]['progress_payment'];?>" class="form-control">
            </td>
        </tr>


        <tr>
            <td>
            - Documentation (non-LC)
            </td>
            <td>
                <select  name="document" class="form-control">
                    <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['document']=='FCR'){echo "selected='selected'";}?>>FCR</option>    
                    <option <?php if($tandc[0]['document']=='Bill of Lading'){echo "selected='selected'";}?>>Bill of Lading</option>
                   
                </select>    
            </td>

            <td>    
                <select name="document2" class="form-control">
                <option disbaled="disabled">-Select-</option>
                <option <?php if($tandc[0]['document2']=='TT'){echo "selected='selected'";}?>>TT</option>    
                <option <?php if($tandc[0]['document2']=='Document Against Payment'){echo "selected='selected'";}?>>Document Against Payment</option>
                </select>   
                            
            </td>
        </tr>


       
        <tr>
            <td>
                6. Price Validity Considered
            </td>
            <td>
                <select name="price_validity" class="form-control">
                    <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['price_validity']=='No Agreement'){echo "selected='selected'";}?>>No Agreement</option>    
                    <option <?php if($tandc[0]['price_validity']=='Committed 1 Year'){echo "selected='selected'";}?>>Committed 1 Year</option>
                </select> 
                 
            </td>
            <td>
                
            </td>
        </tr>


        <tr>
            <td>
                7. Social Compliance Audit Requirement
            </td>
            <td colspan="2">
                    <div class="demo-radio-button row">
                        <div class="col-sm-4">
                            <input name="audit1" type="radio" id="radio_r1"  value="Not Required" <?php if($tandc[0]['audit1']=='Not Required'){echo "checked"; }?>>
                            <label for="radio_r1">Not Required</label>
                        </div>
                        <div class="col-sm-4">
                            <input name="audit1" type="radio" id="radio_r2" value="SA8000" <?php if($tandc[0]['audit1']=='SA8000'){echo "checked"; }?>>
                            <label for="radio_r2">SA8000</label>                            
                        </div>
                        <div class="col-sm-4">    
                            <input name="audit1" type="radio" id="radio_r3" value="Existing not acceptable" onclick="show_bycheck('radio_r3','Existing_not_acceptable_val')" <?php if($tandc[0]['audit1']=='Existing not acceptable'){echo "checked"; $Existing="display:block;";}else{$Existing="display:none;";}?>>
                            <label for="radio_r3">Further Advance</label>
                            <input type="text" name="Existing_not_acceptable_val" class="form-control-sm" value="<?php echo $tandc[0]['Existing_not_acceptable_val']; ?>" id="Existing_not_acceptable_val" style="<?php echo $Existing;?>">
                        </div>    
					</div>

                 
            </td>
            
        </tr>


        <tr>
            <td>
                8. CTPAT Audit Requirement
            </td>
            <td colspan="2">
                <select name="ctpat" class="form-control">
                    <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['ctpat']=='Not Required'){echo "selected='selected'";}?>>Not Required</option>    
                    <option <?php if($tandc[0]['ctpat']=='Required'){echo "selected='selected'";}?>>Required</option>
                </select> 
            </td>
          
        </tr>


        <tr>
            <td>
                9. Late Shipment Penalty
            </td>
            <td colspan="2">
                     <div class="demo-radio-button row">
                        <div class="col-sm-4">
                            <label>%</label=>
                            <input name="lateshipment_per" type="number" value="<?php echo $tandc[0]['lateshipment_per']; ?>" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Duration</label> 
                            <select name="lateshipment_duration" class="form-control">
                                <option disbaled="disabled">-Select-</option>
                                <option <?php if($tandc[0]['lateshipment_duration']=='Per Day'){echo "selected='selected'";}?>>Per Day</option>
                                <option <?php if($tandc[0]['lateshipment_duration']=='Per Week'){echo "selected='selected'";}?>>Per Week</option>
                                <option <?php if($tandc[0]['lateshipment_duration']=='Per Month'){echo "selected='selected'";}?>>Per Month</option>
                            </select>                                                     
                        </div>
                        <div class="col-sm-4">    
                            <label>Max %</label>
                            <input name="lateshipment_max_per" type="number" value="<?php echo $tandc[0]['lateshipment_max_per']; ?>" class="form-control">
                        </div>    
					</div>
                
            </td>
           
        </tr>


        <tr>
            <td>
                10. Defective Product Chargeback
            </td>
            <td>
                    <div class="demo-radio-button row">
                        <div class="col-sm-4">
                            <label>Repair Labour Rate per hour</label>
                            <input name="repair_labour_rate" type="number" value="<?php echo $tandc[0]['repair_labour_rate']; ?>" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Limitation Period After Supply</label>   
                            <select name="repair_labour_rate_after" class="form-control">
                                <option disbaled="disabled">-Select-</option>
                                <option <?php if($tandc[0]['repair_labour_rate_after']=='6 Month'){echo "selected='selected'";}?>>6 Month</option>
                                <option <?php if($tandc[0]['repair_labour_rate_after']=='1 Year'){echo "selected='selected'";}?> >1 Year</option>
                                <option <?php if($tandc[0]['repair_labour_rate_after']=='No Such Thing'){echo "selected='selected'";}?>>No Such Thing</option>
                            </select>                                                     
                        </div>
                        <div class="col-sm-4">    
                            <label>Rate Limitation</label>   
                            <select name="repair_labour_rate_limit" class="form-control">
                                <option disbaled="disabled">-Select-</option>
                                <option <?php if($tandc[0]['repair_labour_rate_limit']=='Repair'){echo "selected='selected'";}?>>Repair</option>
                                <option <?php if($tandc[0]['repair_labour_rate_limit']=='Replacement of part or full replacement'){echo "selected='selected'";}?>>Replacement of part or full replacement</option>
                                <option <?php if($tandc[0]['repair_labour_rate_limit']=='No Such Thing'){echo "selected='selected'";}?>>No Such Thing</option>
                            </select>  
                        </div>    
					</div>
                 
            </td>
            
        </tr>


        <tr>
            <td>
                11. Commissionable
            </td>
            <td colspan="2">
                     <div class="demo-radio-button row">
                        <div class="col-sm-4">
                            <label>Commision To</label>   
                            <select name="commission_to" class="form-control">
                                <option disbaled="disabled">-Select-</option>
                                <option <?php if($tandc[0]['repair_labour_rate_limit']=='Buying Agent'){echo "selected='selected'";}?>>Buying Agent</option>
                                <option <?php if($tandc[0]['repair_labour_rate_limit']=='Sales Representative'){echo "selected='selected'";}?>>Sales Representative</option>
                                <option <?php if($tandc[0]['repair_labour_rate_limit']=='Third Party'){echo "selected='selected'";}?>>Third Party</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Name</label>   
                            <input name="commision_name" type="text" value="<?php echo $tandc[0]['commision_name']; ?>" class="form-control">                                                     
                        </div>
                        <div class="col-sm-4">    
                            <label>Commission %</label>   
                            <input name="commision_per" type="number" value="<?php echo $tandc[0]['commision_per']; ?>" class="form-control">      
                        </div>    
					</div>

                </td>
        </tr>
       
        <tr>
            <th colspan="3">
                 COMMERCIAL CONSIDERATIONS REGARDING PRODUCTS 
            </th>
            
        </tr>
        <tr>
            <td>
                12. Development Sample
            </td>
            <td colspan="2">
                    <div class="demo-radio-button row">
                        <div class="col-sm-3">
                            <input name="sample" type="radio" id="radio_c1" value="sample_paid_client" <?php if($tandc[0]['sample']=='sample_paid_client'){echo "checked"; }?>>
                            <label for="radio_c1">Sample & Freight Paid by client</label>
                        </div>
                        <div class="col-sm-3">
                            <input name="sample" type="radio" id="radio_c2" value="sample_paid_foc_freight" <?php if($tandc[0]['sample']=='sample_paid_foc_freight'){echo "checked"; }?>>
                            <label for="radio_c2">Sample Foc Freight paid by client</label>                       
                        </div>
                        <div class="col-sm-3">    
                            <input name="sample" type="radio" id="radio_c3" value="sample_paid_foc" <?php if($tandc[0]['sample']=='sample_paid_foc'){echo "checked"; }?>>
                            <label for="radio_c3">Sample Freight Foc</label>
                        </div>
                        <div class="col-sm-3">    
                            <label>Quantity Required</label>
                            <input name="sample_paid_foc_qty" type="number" value="<?php echo $tandc[0]['sample_paid_foc_qty'];?>" class="form-control">      
                        </div>    
					</div>

                
            </td>
        </tr>
        <tr>
            <td>
                13. Photography Sample
            </td>
            <td colspan="2">
                     <div class="demo-radio-button row">
                        <div class="col-sm-3">
                            <input name="photography" type="radio" id="radio_p1" value="sample_paid_client" <?php if($tandc[0]['photography']=='sample_paid_client'){echo "checked"; }?>>
                            <label for="radio_p1">Sample & Freight Paid by client</label>
                        </div>
                        <div class="col-sm-3">
                            <input name="photography" type="radio" id="radio_p2" value="sample_paid_foc_freight" <?php if($tandc[0]['photography']=='sample_paid_foc_freight'){echo "checked"; }?>>
                            <label for="radio_p2">Sample Foc Freight paid by client</label>                       
                        </div>
                        <div class="col-sm-3">    
                            <input name="photography" type="radio" id="radio_p3" value="sample_paid_foc" <?php if($tandc[0]['photography']=='sample_paid_sample_paid_focfoc'){echo "checked"; }?>>
                            <label for="radio_p3">Sample Freight Foc</label>
                        </div>
                        <div class="col-sm-3">    
                            <label>Quantity Required</label>
                            <input name="photography_qty" type="number" value="<?php echo $tandc[0]['photography_qty'];?>" class="form-control">      
                        </div>    
					</div>
               
            </td>
           
        </tr>
        
        <tr>
            <td>
                14. General Packing Standard
            </td>
            <td colspan="2">
                <select name="packing" class="form-control">
                    <option disbaled="disbaled">-Select-</option>
                    <option <?php if($tandc[0]['packing']=='Nothing specified'){echo "selected='selected'";}?>>Nothing specified</option>
                    <option <?php if($tandc[0]['packing']=='ISTA 3'){echo "selected='selected'";}?>>ISTA 3</option>
                    <option <?php if($tandc[0]['packing']=='Special Notes for Packing'){echo "selected='selected'";}?>>Special Notes for Packing</option>
                </select>
                
            </td>
            
        </tr>

        <tr>
            <td>
                15. Product Testing
            </td>
            <td>
                    <div class="demo-radio-button row">
                        <div class="col-sm-4">
                            <input name="product_testing" type="radio" id="radio_pt1" value="Only Internal" <?php if($tandc[0]['product_testing']=='Only Internal'){echo "checked"; }?>>
                            <label for="radio_pt1">Only Internal Testing Required</label>
                        </div>
                        <div class="col-sm-4">
                            <input name="product_testing" type="radio" id="radio_pt2" value="Laboratory" <?php if($tandc[0]['product_testing']=='Laboratory'){echo "checked"; }?>>
                            <label for="radio_pt2">Laboratory Testing Required</label>                       
                        </div>
                        <div class="col-sm-4">    
                            <input name="product_testing" type="radio" id="radio_pt3" value="Testing" <?php if($tandc[0]['product_testing']=='Testing'){echo "checked"; }?>>
                            <label for="radio_pt3">Testing Frequency - One Time, Annual, Bi-annual</label>
                        </div> 
					</div>
            </td>
            <td>
                <label>Paid by Customer</label>
                <select name="product_testing_paid" class="form-control">
                    <option disbaled="disbaled">-Select-</option>
                    <option <?php if($tandc[0]['product_testing_paid']=='Yes'){echo "selected='selected'";}?>>Yes</option>
                    <option <?php if($tandc[0]['product_testing_paid']=='No'){echo "selected='selected'";}?>>No</option>
                </select>
            </td>
        </tr>


        <tr>
            <td>
                16. Packing Testing
            </td>
            <td>
                <div class="demo-radio-button row">
                    <div class="col-sm-4">
                        <input name="packing_testing" type="radio" id="radio_pc1" value="Only Internal" <?php if($tandc[0]['packing_testing']=='Only Internal'){echo "checked"; }?>>
                        <label for="radio_pc1">Only Internal Testing Required</label>
                    </div>
                    <div class="col-sm-4">
                        <input name="packing_testing" type="radio" id="radio_pc2" value="Laboratory" <?php if($tandc[0]['packing_testing']=='Only Internal'){echo "checked"; }?>>
                        <label for="radio_pc2">Laboratory Testing Required</label>                       
                    </div>
                    <div class="col-sm-4">    
                        <input name="packing_testing" type="radio" id="radio_pc3" value="Testing" <?php if($tandc[0]['packing_testing']=='Only Internal'){echo "checked"; }?>>
                        <label for="radio_pc3">Testing Frequency - One Time, Annual, Bi-annual</label>
                    </div> 
                </div>
            </td>
            <td>
                <label>Paid by Customer</label>
                <select name="packing_testing_paid" class="form-control">
                    <option disbaled="disbaled">-Select-</option>
                    <option <?php if($tandc[0]['packing_testing_paid']=='Yes'){echo "selected='selected'";}?>>Yes</option>
                    <option <?php if($tandc[0]['packing_testing_paid']=='No'){echo "selected='selected'";}?>>No</option>
                </select>
            </td>
        </tr>



        <tr>
            <td>
                17. FSC Options Required
            </td>
            <td>
                    <div class="demo-radio-button row">
                    <div class="col-sm-6">
                            <input name="fsc" type="radio" id="radio_f1" onclick="show_bycheck('radio_f1','fsc_yes')" <?php if($tandc[0]['fsc']=='1'){echo "checked"; $fsc="display:block;";}else{$fsc="display:none;";}?>>
                            <label for="radio_f1">Yes</label>
                            
                            <input name="fsc" type="radio" id="radio_f2" onclick="show_bycheck('radio_f2','fsc_no')" <?php if($tandc[0]['fsc']=='0'){echo "checked"; }?>>
                            <label for="radio_f2">No</label>

                        </div>

                        <div class="col-sm-6">    
                            <input type="text" name="fsc_current" class="form-control" id="fsc_yes" value="<?php echo $tandc[0]['fsc_current'];?>" style="<?php echo $fsc; ?>">
                        </div>  
    
					</div>
                
            </td>
           <td>
                <label>FSC % Target in 1-2 Years</label>   
                <input name="fsc_target" type="number" value="<?php echo $tandc[0]['fsc_target'];?>" class="form-control">      
           </td>
        </tr>
        <tr>
            <td>
                18. Client requires own Branding on Product
            </td>
            <td>
                <div class="demo-radio-button row">
                    <div class="col-sm-6">
                        <input name="branding" type="radio" id="radio_b1" value="1" onclick="show_bycheck('radio_b1','branding_yes')" <?php if($tandc[0]['branding']=='1'){echo "checked"; $branding="display:block;";}else{$branding="display:none;";}?>>
                        <label for="radio_b1">Yes</label>
                        
                        <input name="branding" type="radio" id="radio_b2" value="0" onclick="show_bycheck('radio_b2','branding_no')" <?php if($tandc[0]['branding']=='0'){echo "checked";}?>>
                        <label for="radio_b2">No</label>

                    </div>
                    <div class="col-sm-6">    
                        <select name="branding_req" class="form-control" id="branding_yes" style="<?php echo $branding;?>">
                            <option disbaled="disbaled">-Select-</option>
                            <option <?php if($tandc[0]['branding_req']=='Yes'){echo "selected='selected'";}?>>Yes</option>
                            <option <?php if($tandc[0]['branding_req']=='No'){echo "selected='selected'";}?>>No</option>                    
                        </select>
                    </div>    
                </div>
            </td>
            <td>
                
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="submit" value="Update and Send For Approval" class="btn btn-secondary"></td>
        </tr>
    </tbody>
    <?php }?>
</table>
    </form>