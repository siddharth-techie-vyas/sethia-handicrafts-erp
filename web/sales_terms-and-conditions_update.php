

<form method="POST" action="<?php echo $base_url.'index.php?action=sales&query=prospect3_1'?>" id="form" name="form">
    <input type="hidden" value="<?php echo $pro1[0]['id'];?>" name="pid">
<table class="table table-bordered table-reponsive">
    <?php 
    if($pro1[0]['export'] !='0'){
    ?>
        <tbody>
        <tr>
            <th colspan="2">TERMS CONDITIONS <span class="text-danger">( UPDATE )</span></th>
        </tr>
        <!-- <tr>
             <td></td>
            <td>
                 FOR EXPORTS 
            </td>
            <td  >
                 NON-EXPORTS 
            </td>
             
        </tr> -->
        <tr>
            <td>
                1. Incoterms
            </td>
            <td>
            <select id="export" name="incoterms" class="form-control">
                <option disbaled="disabled">-Select-</option>
                <option <?php if($tandc[0]['incoterms']=='FOB-Mundra/Pipava'){?>selected='selected'<?php }?>>FOB-Mundra/Pipava</option>
                <option <?php if($tandc[0]['incoterms']=='CIF'){?>selected='selected'<?php }?>>CIF</option>
            </select>    
            
            </td>
            
             
            <td>
                <select id="domestic" name="incoterms" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option  <?php if($tandc[0]['incoterms']=='Ex Works'){?>selected='selected'<?php }?>>Ex Works</option>
                    <option  <?php if($tandc[0]['incoterms']=='DPU'){?>selected='selected'<?php }?>>DPU</option>
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
                    <option  <?php if($tandc[0]['shipping']=='FCL'){?>selected='selected'<?php }?>>FCL</option>
                    <option  <?php if($tandc[0]['shipping']=='FCL/LCL'){?>selected='selected'<?php }?>>FCL/LCL</option>
                    <option  <?php if($tandc[0]['shipping']=='LCL'){?>selected='selected'<?php }?>>LCL</option>
                </select>
                  
            </td>
            
            <td>
             <select id="domestic" name="shipping" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    
                    <option <?php if($tandc[0]['shipping']=='FTL'){?>selected='selected'<?php }?>>FTL</option>
                    <option <?php if($tandc[0]['shipping']=='LTL'){?>selected='selected'<?php }?>>LTL</option>
                </select>
                
            </td>             
        </tr>


        <tr>
            <td>
            Shipping - Basis
            </td>
            <td>
            <select id="export" name="shipping_basis" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option <?php if($tandc[0]['shipping']=='Shipper PDA'){?>selected='selected'<?php }?>>Shipper PDA</option>
                    <option <?php if($tandc[0]['shipping']=='Liner PDA'){?>selected='selected'<?php }?>>Liner PDA</option>
                    
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
                    <option <?php if($tandc[0]['currency']=='USD'){?>selected='selected'<?php }?>>USD</option>
                    <option <?php if($tandc[0]['currency']=='Euro'){?>selected='selected'<?php }?>>Euro</option>
                    <option <?php if($tandc[0]['currency']=='Pound'){?>selected='selected'<?php }?>>Pound</option>
                </select>
            </td>
            
             
            <td>
            <select id="domestic" name="currency" class="form-control">
                
                    <option <?php if($tandc[0]['currency']=='INR'){?>selected='selected'<?php }?>>INR</option>                    
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
                    <option <?php if($tandc[0]['liability']=='No Stated Requirement'){?>selected='selected'<?php }?>>No Stated Requirement</option>    
                    <option <?php if($tandc[0]['liability']=='Required Costs %'){?>selected='selected'<?php }?>>Required Costs %</option>                
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
                    <option  <?php if($tandc[0]['advance']=='Without Advance'){?>selected='selected'<?php }?>>Without Advance</option>    
                    <option  <?php if($tandc[0]['advance']=='Advance (30%)'){?>selected='selected'<?php }?>>Advance (30%)</option>    
                    <option  <?php if($tandc[0]['advance']=='LC at Sight'){?>selected='selected'<?php }?>>LC at Sight</option>    
                    <option  <?php if($tandc[0]['advance']=='LC Usance'){?>selected='selected'<?php }?>>LC Usance</option>                
                    <option  <?php if($tandc[0]['advance']=='100% After ____ days of BC / FCR'){?>selected='selected'<?php }?>>100% After ____ days of BC / FCR</option>
                </select>

                <!-- <div class="allhide" id="Advance_30">
                    <hr>
                    <label>Required Costs Value (%)</label>
                     <input type="text" name="advance_per" class="form-control-sm">
                 </div> -->
                
            </td>
        </tr>
        
        <tr  id="domestic">
            <td>
                - Progress Payment
            </td>
            
            <td colspan="2">
                <!-- <select id="domestic" name="advance_process" class="form-control">
                <option disbaled="disabled">-Select-</option>
                    <option></option>    
                    <option>Progress Stage</option>   
                    <option>Further Advance %</option>    
                    <option>Only in case of domestic</option>              
                </select> -->
            
                
                    <div class="demo-radio-button row">
                        <div class="col-sm-2">
                            <input name="progress_payment" type="radio" id="radio_pp1" value="1" onchange="show_txtbox('progress_payment')" <?php if($tandc[0]['progress_payment']=='1'){echo "checked";}?>>
                            <label for="radio_pp1">Yes</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="progress_payment" type="radio" id="radio_pp2" value="0" onchange="hide_txtbox('progress_payment')" <?php if($tandc[0]['progress_payment']=='0'){echo "checked";}?>>
                            <label for="radio_pp2">No</label>
                        </div>

                        <div id="progress_payment" class="col-sm-8 row" <?php if($tandc[0]['progress_payment']=='1'){$pp_display="block";}else{$pp_display="none";}?>style="display:<?php echo $pp_display;?>;">

                            <div class="col-sm-3">
                                <label for="advance_stage1">Stage 1</label>
                                <input type="text" name="stage1" class="form-control-sm" value="<?php echo $tandc[0]['stage1']?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="advance_stage2">Stage 2</label>
                                <input type="text" name="stage2" class="form-control-sm" value="<?php echo $tandc[0]['stage2']?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="advance_stage3">Stage 3</label>
                                <input type="text" name="stage3" class="form-control-sm" value="<?php echo $tandc[0]['stage3']?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="advance_stage4">Stage 4</label>
                                <input type="text" name="stage4" class="form-control-sm" value="<?php echo $tandc[0]['stage4']?>">
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
                    <option <?php if($tandc[0]['balance']=='Handover'){?>selected='selected'<?php }?>>Handover</option>  
                    <option <?php if($tandc[0]['balance']=='Incoterm'){?>selected='selected'<?php }?>>Incoterm</option>     
                </select>  
                
            </td>
            <td>
                 <label>Credit Period (Days)</label>
                 <input type="number" name="credit_period" value="<?php echo $tandc[0]['credit_period'];?>" class="form-control">
            </td>
        </tr>
        
        
        <tr id="domestic">
            <td>
                - Retention 
            </td>
            
            <td colspan="2">

                <div class="demo-radio-button row">
                        <div class="col-sm-2">
                            <input name="retention" type="radio" id="radio_rt1" value="1" onchange="show_txtbox('retention')" <?php if($tandc[0]['retention']=='1'){echo "checked"; $rdisplay="block";}?>>
                            <label for="radio_rt1">Yes</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="retention" type="radio" id="radio_rt2" value="0" onchange="hide_txtbox('retention')" <?php if($tandc[0]['retention']=='0'){echo "checked"; $rdisplay="none";}?>>
                            <label for="radio_rt2">No</label>
                        </div>

                        <div id="retention" class="col-sm-8 row" style="display:<?php echo $rdisplay;?>;">
                             
                            <div class="col-sm-6">
                                <label>Retention Period</label>    
                                <input type="number" name="retention_period" value="<?php echo $tandc[0]['retention_period'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Process Payment</label>
                                <input type="number" name="process_payment" value="<?php echo $tandc[0]['process_payment'];?>" class="form-control">
                            </div>
                        </div>    

                </div>
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

                <div class="demo-radio-button row">
                        <div class="col-sm-2">
                            <input name="price_validity" type="radio" id="radio_pv1" value="0" onchange="hide_txtbox('Price_Validity')" <?php if($tandc[0]['price_validity']=='0'){echo "checked"; $rdisplay="none";}?>>
                            <label for="radio_pv1">Not Required</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="price_validity" type="radio" id="radio_pv2" value="1" onchange="show_txtbox('Price_Validity')" <?php if($tandc[0]['price_validity']=='1'){echo "checked"; $rdisplay="block";}?>>
                            <label for="radio_pv2">Required</label>
                        </div>

                        <div id="Price_Validity" class="col-sm-8" style="display:none;">
                                <!-- <select name="price_validity_year" class="form-control">
                                    <option disbaled="disabled">-Select-</option>
                                    <option>No Agreement </option>    
                                    <option>Committed 1 Year</option>
                                </select>  -->
                                <label>Nu of Days</label>
                                <input type="number" name="price_validity_year" value="<?php echo $tandc[0]['price_validity_year'];?>"  class="form-control">
                        </div>
                </div>        
                 
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
                        <div class="col-sm-2">
                            <input name="social_audit" type="radio" id="radio_r1" value="0" onchange="hide_txtbox('compliance')"  <?php if($tandc[0]['social_audit']=='0'){echo "checked"; $sdisplay="none";}?>>
                            <label for="radio_r1">Not Required</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="social_audit" type="radio" id="radio_r11" value="1" onchange="show_txtbox('compliance')" <?php if($tandc[0]['social_audit']=='1'){echo "checked"; $sdisplay="block";}?>>
                            <label for="radio_r11">Required</label>
                        </div>

                        <div id="compliance" class="col-sm-8" style="display:<?php echo $sdisplay;?>;">
                        <div class="col-sm-4">
                            <input name="audit0" type="checkbox" id="radio_r2" value="SA8000">
                            <label for="radio_r2">SA8000</label>                            
                        </div>
                        <div class="col-sm-8">    

                          
                        <input name="audit1" type="checkbox" id="radio_r3" value="Existing not acceptable" onclick="show_bycheck('radio_r3','Existing_not_acceptable_val')"> 
                        <label for="radio_r3">Existing not acceptable required</label>      
                            <div id="Existing_not_acceptable_val" style="display:<?php echo $sdisplay;?>;">
                                <label>Option 1</label>    
                                <input type="text" name="audit2" value="<?php echo $tandc[0]['audit2']; ?>" class="form-control-sm"> 
                                <label>Option 2</label>    
                                <input type="text" name="audit3" value="<?php echo $tandc[0]['audit3']; ?>" class="form-control-sm">
                                <label>Option 3</label>    
                                <input type="text" name="audit4" value="<?php echo $tandc[0]['audit4']; ?>" class="form-control-sm">   
                            </div>
                            

                        </div>    
                        </div>
					</div>

                 
            </td>
            
        </tr>


        <tr  id="export"> 
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

                        <div class="col-sm-2">
                            <input name="shipment_penelty" type="radio" id="radio_sh1" value="0" onchange="hide_txtbox('shipment')" <?php if($tandc[0]['shipment_penelty']=='0'){echo "checked"; $shdisplay="none";}?>>
                            <label for="radio_sh1" >Not Discussed</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="shipment_penelty" type="radio" id="radio_sh2" value="1" onchange="show_txtbox('shipment')" <?php if($tandc[0]['shipment_penelty']=='1'){echo "checked"; $shdisplay="block";}?>>
                            <label for="radio_sh2">Discussed</label>
                        </div>

                        <div class="col-sm-8 row" id="shipment" style="display:<?php echo $shdisplay;?>;">

                            <div class="col-sm-4">
                                <label>%</label>
                                <input name="late_shipment_per" type="number" value="<?php echo $tandc[0]['late_shipment_per'];?>" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label>Duration</label> 
                                <select name="late_shipment_duration" class="form-control">
                                    <option disbaled="disabled">-Select-</option>
                                    <option <?php if($tandc[0]['late_shipment_duration']=='Per Day'){echo "selected='selected'";}?>>Per Day</option>
                                    <option <?php if($tandc[0]['late_shipment_duration']=='Per Week'){echo "selected='selected'";}?>>Per Week</option>
                                    <option <?php if($tandc[0]['late_shipment_duration']=='Per Month'){echo "selected='selected'";}?>>Per Month</option>
                                </select>                                                     
                            </div>
                            <div class="col-sm-4">    
                                <label>Max %</label>
                                <input name="late_shipment_max_per" type="number" value="<?php echo $tandc[0]['late_shipment_max_per'];?>" class="form-control">
                            </div>    

                        </div>    


					</div>
                
            </td>
           
        </tr>


        <tr>
            <td>
                10. Defective Product Chargeback
            </td>
            <td colspan="2">
                    <div class="demo-radio-button row">

                    <div class="col-sm-2">
                            <input name="chargeback" type="radio" id="radio_ch1" value="0" onchange="hide_txtbox('Chargeback')" <?php if($tandc[0]['chargeback']=='0'){echo "checked"; $chdisplay="none";}?>>
                            <label for="radio_ch1">Not Discussed</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="chargeback" type="radio" id="radio_ch2" value="1" onchange="show_txtbox('Chargeback')" <?php if($tandc[0]['chargeback']=='1'){echo "checked"; $chdisplay="block";}?>>
                            <label for="radio_ch2">Discussed</label>
                        </div>

                        <div class="col-sm-8 row" id="Chargeback" style="display:<?php echo $chdisplay;?>;">

                            <div class="col-sm-4">
                                <label>Repair Labour Rate per hour</label>
                                <input name="repair_labour_rate" type="number" value="<?php echo $tandc[0]['repair_labour_rate']; ?>" class="form-control">
                            </div>

                            <div class="col-sm-4">
                                <label>Limitation Period After Supply</label>   
                                <select name="repair_labour_rate_after" class="form-control">
                                    <option disbaled="disabled">-Select-</option>
                                    <option <?php if($tandc[0]['repair_labour_rate_after']=='6 Month'){echo "selected='selected'";}?>>6 Month</option>
                                    <option <?php if($tandc[0]['repair_labour_rate_after']=='1 Year'){echo "selected='selected'";}?>>1 Year</option>
                                    <option <?php if($tandc[0]['repair_labour_rate_after']=='No Such Thing'){echo "selected='selected'";}?>>No Such Thing</option>
                                </select>                                                     
                            </div>

                            <div class="col-sm-4">    
                                <label>Rate Limitation</label>   
                                <select name="repair_labour_limit" class="form-control">
                                    <option disbaled="disabled">-Select-</option>
                                    <option <?php if($tandc[0]['repair_labour_rate_after']=='Repair'){echo "selected='selected'";}?>>Repair</option>
                                    <option <?php if($tandc[0]['repair_labour_rate_after']=='Replacement of part or full replacement'){echo "selected='selected'";}?>>Replacement of part or full replacement</option>
                                    <option <?php if($tandc[0]['repair_labour_rate_after']=='No Such Thing'){echo "selected='selected'";}?>>No Such Thing</option>
                                </select>  
                            </div>    

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

                     <div class="col-sm-2">
                            <input name="commissionable" type="radio" id="radio_co1" value="0" onchange="hide_txtbox('Commissionable')" <?php if($tandc[0]['commissionable']=='0'){echo "checked"; $codisplay="none";}?>>
                            <label for="radio_co1">Not Discussed</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="commissionable" type="radio" id="radio_co2" value="1" onchange="show_txtbox('Commissionable')" <?php if($tandc[0]['commissionable']=='1'){echo "checked"; $codisplay="block";}?>>
                            <label for="radio_co2">Discussed</label>
                        </div>

                        <div class="col-sm-8 row" id="Commissionable" style="display:<?php echo $codisplay;?>;">

                                    <div class="col-sm-4">
                                        <label>Commision To</label>   
                                        <select name="commission_to" class="form-control">
                                            <option disbaled="disabled">-Select-</option>
                                            <option <?php if($tandc[0]['commission_to']=='Buying Agent'){echo "selected='selected'";}?>>Buying Agent</option>
                                            <option <?php if($tandc[0]['commission_to']=='Sales Representative'){echo "selected='selected'";}?>>Sales Representative</option>
                                            <option <?php if($tandc[0]['commission_to']=='Third Party'){echo "selected='selected'";}?>>Third Party</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Name</label>   
                                        <input name="commission_name" type="text" value="<?php echo $tandc[0]['commission_name']; ?>" class="form-control">                                                     
                                    </div>
                                    <div class="col-sm-4">    
                                        <label>Commission %</label>   
                                        <input name="commission_per" type="number" value="<?php echo $tandc[0]['commission_per']; ?>" class="form-control">      
                                    </div>    
                        </div>


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
                        <div class="col-sm-2">
                            <input name="sample" type="radio" id="radio_c1" value="sample_paid_client" <?php if($tandc[0]['sample']=='sample_paid_client'){echo "checked"; }?>>
                            <label for="radio_c1">Sample & Freight Paid by client</label>
                        </div>
                        <div class="col-sm-3">
                            <input name="sample" type="radio" id="radio_c2" value="sample_paid_foc_freight" <?php if($tandc[0]['sample']=='sample_paid_foc_freight'){echo "checked"; }?>>
                            <label for="radio_c2">Sample Foc Freight paid by client</label>                       
                        </div>
                        <div class="col-sm-2">    
                            <input name="sample" type="radio" id="radio_c3" value="sample_paid_foc" <?php if($tandc[0]['sample']=='sample_paid_foc'){echo "checked"; }?>>
                            <label for="radio_c3">Sample Freight Foc</label>
                        </div>
                        <div class="col-sm-3">    
                            <input name="sample_qty0" type="checkbox" id="radio_c4" value="0" onclick="show_bycheck('radio_c4','sample_paid_foc_qty')" <?php if($tandc[0]['sample']=='sample_paid_foc'){echo "checked"; $sqdisplay="block";}else{$sqdisplay="none";}?>>
                            <label for="radio_c4">Quantity Required</label>
                            <input name="sample_qty" id="sample_paid_foc_qty" type="number" value="<?php echo $tandc[0]['sample_qty'];?>" class="form-control" style="display:<?php echo $sqdisplay;?>;">      
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
                            <input name="photography" type="radio" id="radio_p1" value="sample_paid_client" onclick="hide_txtbox('photography_qty')" <?php if($tandc[0]['photography']=='sample_paid_client'){echo "checked"; }?>>
                            <label for="radio_p1">Sample & Freight Paid by client</label>
                        </div>
                        <div class="col-sm-3">
                            <input name="photography" type="radio" id="radio_p2" value="sample_paid_foc_freight" onclick="hide_txtbox('photography_qty')" <?php if($tandc[0]['photography']=='sample_paid_foc_freight'){echo "checked"; }?>>
                            <label for="radio_p2">Sample Foc Freight paid by client</label>                       
                        </div>
                        <div class="col-sm-2">    
                            <input name="photography" type="radio" id="radio_p3" value="sample_paid_foc" onclick="hide_txtbox('photography_qty')" <?php if($tandc[0]['photography']=='sample_paid_foc'){echo "checked"; }?>>
                            <label for="radio_p3">Sample Freight Foc</label>
                        </div>
                        <div class="col-sm-2">    
                            <input name="photography" type="checkbox" id="radio_p4" value="quanity_required" onclick="show_bycheck('radio_p4','photography_qty')" <?php if($tandc[0]['photography']=='sample_paid_foc'){echo "checked='checked'"; $podisplay="block";}else{$podisplay="none";}?>>
                            <label for="radio_p4">Quantity Required</label>
                            <input name="photography_qty" id="photography_qty" type="number" value="<?php echo $tandc[0]['photography_qty'];?>" class="form-control" style="display:<?php echo $podisplay;?>;">      
                        </div>  
                        
					</div>
               
            </td>
           
        </tr>
        
        <tr>
            <td>
                14. General Packing Standard
            </td>
            <td>
                <label>Type</label>
                <select name="packing" class="form-control" onchange="show_txtbox('special_notes');">
                    <option disbaled="disbaled">-Select-</option>
                    <option <?php if($tandc[0]['packing']=='Nothing specified'){echo "selected='selected'";}?>>Nothing specified</option>
                    <option <?php if($tandc[0]['packing']=='Container Worthy'){echo "selected='selected'";}?>>Container Worthy</option>
                    <option <?php if($tandc[0]['packing']=='ISTA 2'){echo "selected='selected'";}?>>ISTA 2</option>
                    <option <?php if($tandc[0]['packing']=='ISTA 3'){echo "selected='selected'";}?>>ISTA 3</option>
                    <option <?php if($tandc[0]['packing']=='ISTA 6'){echo "selected='selected'";}?>>ISTA 6</option>
                </select>
            </td>
            <td>
                <label>Special Notes</label>
                <textarea name="special_notes" id="special_notes"  class="form-control"> <?php echo $tandc[0]['special_notes'];?></textarea>
            </td>
        </tr>

        <tr>
            <td>
                15. Product Testing
            </td>
            <td>
                    <div class="demo-radio-button row">
                        <div class="col-sm-4">
                            <input name="product_testing" type="checkbox" id="radio_pt1" value="Only Internal" <?php if($tandc[0]['product_testing']=='Only Internal'){echo "checked='checked'"; }?>>
                            <label for="radio_pt1">Internal Testing Required</label>
                        </div>
                        <div class="col-sm-4">
                            <input name="product_testing1" type="checkbox" id="radio_pt2" value="Laboratory" onclick="show_bycheck('radio_pt2','product_testing');" <?php if($tandc[0]['product_testing']=='Laboratory'){echo "checked='checked'"; $ptdisplay="block";}else{$ptdisplay="none";}?>>
                            <label for="radio_pt2">Laboratory Testing Required</label>                       
                        </div>
                        <div class="col-sm-4" id="product_testing" style="display:<?php echo $ptdisplay;?>;">    
                            <label for="radio_pt3">Testing Frequency</label>
                            <select class="form-control" name="product_testing_frequency" id="product_testing_frequency">
                            <option disbaled="disbaled">-Select-</option>
                            <option>One Time</option>
                            <option>Annual</option>
                            <option>Bi-Annual</option>
                        </select>  
                        </div> 
					</div>
            </td>
            <td>
                <label>Paid by Customer</label>
                <select name="product_testing_paid" class="form-control">
                    <option disbaled="disbaled">-Select-</option>
                    <option <?php if($tandc[0]['product_testing_paid']=='- Yes'){echo "selected='selected'";}?>>- Yes</option>
                    <option <?php if($tandc[0]['product_testing_paid']=='- No'){echo "selected='selected'";}?>>- No</option>
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
                        <input name="packing_testing" type="checkbox" id="radio_pc1" value="Only Internal" onclick="hide_txtbox('packing_testing');" <?php if($tandc[0]['packing_testing']=='Only Internal'){echo "checked='checked'"; }?>>
                        <label for="radio_pc1">Only Internal Testing Required</label>
                    </div>
                    <div class="col-sm-4">
                        <input name="packing_testing1" type="checkbox" id="radio_pc2" value="Laboratory" onclick="show_bycheck('radio_pc2','packing_testing');" <?php if($tandc[0]['packing_testing']=='Laboratory'){echo "checked='checked'"; $pt2display="block";}else{$pt2display="none";}?>>
                        <label for="radio_pc2">Laboratory Testing Required</label>                       
                    </div>
                    <div class="col-sm-4" id="packing_testing_frequency" style="display:<?php echo $pt2display;?>;">    
                        <label for="radio_pc3">Testing Frequency</label>
                        <select class="form-control" name="packing_testing_frequency" id="packing_testing_frequency">
                            <option disbaled="disbaled">-Select-</option>
                            <option <?php if($tandc[0]['packing_testing_frequency']=='One Time'){echo "selected='selected'";}?>>One Time</option>
                            <option <?php if($tandc[0]['packing_testing_frequency']=='Annual'){echo "selected='selected'";}?>>Annual</option>
                            <option <?php if($tandc[0]['packing_testing_frequency']=='Bi-Annual'){echo "selected='selected'";}?>>Bi-Annual</option>
                        </select>    
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
            <td colspan="2">

                    <div class="demo-radio-button row">
                        <div class="col-sm-2">
                            <input name="fsc" type="radio" id="radio_f1" onclick="show_txtbox('fsc_yes'); show_txtbox('fsc_yes0'); show_txtbox('fsc_yes1'); hide_txtbox('fsc_yes2');">
                            <label for="radio_f1">Yes</label>
                        </div>

                        <div class="col-sm-2">    
                            <input name="fsc" type="radio" id="radio_f2" onclick="hide_txtbox('fsc_yes1'); hide_txtbox('fsc_yes0'); show_txtbox('fsc_yes'); show_txtbox('fsc_yes2');">
                            <label for="radio_f2">No</label>

                        </div>

                        <div class="col-sm-2" id="fsc_yes" style="display:none;">    
                            <label>Year(s)</label>
                            <select name="fsc_years" class="form-control">
                                <option disbaled="disbaled">-Select-</option>
                                <option <?php if($tandc[0]['fsc_years']=='1 Year'){echo "selected='selected'";}?>>1 Year</option>
                                <option <?php if($tandc[0]['fsc_years']=='2 Year'){echo "selected='selected'";}?>>2 Year</option>
                                <option <?php if($tandc[0]['fsc_years']=='3 Year'){echo "selected='selected'";}?>>3 Year</option>
                            </select>
                        </div>
                        
                        <div clas="col-sm-2" id="fsc_yes0" style="display:none;">    
                            <label>FSC % Target in 1-2 Years</label>   
                            <input name="fsc_yes0" type="number" value="<?php echo $tandc[0]['fsc_yes0'];?>" class="form-control"> 
                        </div>

                        <div class="col-sm-2" id="fsc_yes1" style="display:none;">    
                            <label>FSC Current</label>
                            <input type="text" name="fsc_yes1" value="<?php echo $tandc[0]['fsc_yes1'];?>" class="form-control"  >
                        </div>

                        <div class="col-sm-2 demo-radio-button" id="fsc_yes2" style="display:none;">    
                            <input name="fsc_yes2" type="checkbox" id="radio_1" value="1" class="form-control" <?php if($tandc[0]['fsc_yes2']=='1'){echo "checked='checked'"; }?>>
                            <label for="fsc_yes2">No Target</label>
                        </div>
    
					</div>
                
            </td>
          
        </tr>
        <tr>
            <td>
                18. Client requires own Branding on Product
            </td>
            <td>
                <div class="demo-radio-button row">
                    <div class="col-sm-6">
                        <input name="branding" type="radio" id="radio_b1" value="1" onclick="show_txtbox('branding_yes')" <?php if($tandc[0]['branding']=='1'){echo "checked"; $cldisplay="display:block;";}?>>
                        <label for="radio_b1">Yes</label>
                        
                        <input name="branding" type="radio" id="radio_b2" value="0" onclick="hide_txtbox('branding_yes')" <?php if($tandc[0]['branding']=='0'){echo "checked"; $cldisplay="display:none;";}?>>
                        <label for="radio_b2">No</label>

                    </div>
                    <div class="col-sm-6" id="branding_yes" style="display:<?php echo $cldisplay;?>;">    
                        <label>Provided By</label>
                        <select name="branding_req" class="form-control" >
                            <option disbaled="disbaled">-Select-</option>
                            <option <?php if($tandc[0]['branding_req']=='Provided By Client'){echo "selected='selected'";}?>>Provided By Client</option>
                            <option <?php if($tandc[0]['branding_req']=='factory Procurement'){echo "selected='selected'";}?>>factory Procurement</option>                    
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