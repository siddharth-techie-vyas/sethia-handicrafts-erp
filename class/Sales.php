<?php 
require_once ("DBController.php");

class Sales 
{
    
    function __construct()
    {
        $this->db_handle = new DBController();
    }

//-- dashboard function 

function lead_bystatus($status)
{
    $query="select * from leads where status='$status' ORDER BY id DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function view_all_leads()
{
    $query="select * from leads where status != '0' ORDER BY id DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result; 
}

function save_sales_feedback($id,$feedback,$status,$stage,$outcome,$handledby,$next_feedback_date)
{
    $updated=date('Y-m-d h:i:s');
    $query0 = "Update leads SET last_updated='$updated', sales_handledby='$handledby', sales_status='$status', sales_stage='$stage',sales_outcome='$outcome' where id='$id' ";
    $insertId0 = $this->db_handle->update($query0);    
    

    //-- insert into feedback responses
        $query = "insert into lead_feedback(lid,feedback,next_feedback_date,sales_status,sales_stage,sales_outcome)VALUES(?,?,?,?,?,?)";
        $paramType = "issiis";
        $paramValue = array($id,$feedback,$next_feedback_date,$status,$stage,$outcome);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        return $insertId0;
}

function create_beneficiery($fname,$lname,$phone,$email,$cname,$ctype,$designation,$address,$country,$state,$city,$zipcode,$regtype,$regnu,$btype)
{
    $query = "insert into beneficiery(fname,lname,phone,email,cname,ctype,designation,address,country,state,city,zipcode,regtype,regnu,btype)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $paramType = "ssisssssiiiissi";
    $paramValue = array($fname,$lname,$phone,$email,$cname,$ctype,$designation,$address,$country,$state,$city,$zipcode,$regtype,$regnu,$btype);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

    //-- get max id from beneficiery table
    $max="select MAX(id) AS max_id from beneficiery";
    $result = $this->db_handle->runBaseQuery($max);
    $id=$result[0]['max_id'];

    return $id;
}
function beneficiery_details($bid,$value1,$value2)
{
    $query = "insert into beneficiery_details(bid,value1,value2)VALUES(?,?,?)";
    $paramType = "iss";
    $paramValue = array($bid,$value1,$value2);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
}
function get_baneficiery($id)
{
    $query="select * from beneficiery where id = '$id' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;  
}

function view_all_beneficiery($btype)
{
    $query="select * from beneficiery where btype = '$btype' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;  
}

function get_beneficiery_detail($id)
{
    $query="select * from beneficiery_details where bid = '$id' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;  
}

function sales_prospect_type($id,$type)
{
   echo $update="update beneficiery SET export='$type' where id='$id' ";
    $update = $this->db_handle->update($update);
    return $update;  

}
function get_prospect_tandc($id)
{
    $query="select * from prospect_tandc where pid = '$id' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
function sales_prospect_tandc($pid,$incoterms,$shipping,$shipping_basis,$currency,$liability,$liability_per,$advance,$progress_payment,$stage1,$stage2,$stage3,$stage4,$balance,$credit_period,$retention,$retention_period,$process_payment,$document,$document2,$price_validity,$price_validity_year,$social_audit,$audit0,$audit1,$audit2,$audit3,$audit4,$ctpat,$shipment_penelty,$late_shipment_penelty,$late_shipment_max_per,$late_shipment_duration,$chargeback,$repair_labour_rate,$repair_labour_rate_after,$repair_labour_limit,$commissionable,$commision_to,$commision_name,$commision_per,$sample,$sample_qty,$photography,$photography_qty,$packing,$special_notes,$product_testing,$product_testing_paid,$product_testing_1,$product_testing_frequency,$packing_testing1,$packing_testing_frequency,$packing_testing_paid,$fsc,$fsc_years,$fsc_yes0,$fsc_yes1,$fsc_yes2,$branding,$branding_req)
{
    $query = "insert into prospect_tandc(pid,incoterms,shipping,shipping_basis,currency,liability,liability_per,advance,progress_payment,stage1,stage2,stage3,stage4,balance,credit_period,retention,retention_period,process_payment,document,document2,price_validity,price_validity_year,social_audit,audit0,audit1,audit2,audit3,audit4,ctpat,shipment_penelty,late_shipment_penelty,late_shipment_max_per,late_shipment_duration,chargeback,repair_labour_rate,repair_labour_rate_after,repair_labour_limit,commissionable,commision_to,commision_name,commision_per,sample,sample_qty,photography,photography_qty,packing,special_notes,product_testing,product_testing_paid,product_testing_1,product_testing_frequency,packing_testing1,packing_testing_frequency,packing_testing_paid,fsc,fsc_years,fsc_yes0,fsc_yes1,fsc_yes2,branding,branding_req)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $paramType = "issssssssssssssssssssssssssssssssssssssssssssssssssssssssssss";
    $paramValue = array($pid,$incoterms,$shipping,$shipping_basis,$currency,$liability,$liability_per,$advance,$progress_payment,$stage1,$stage2,$stage3,$stage4,$balance,$credit_period,$retention,$retention_period,$process_payment,$document,$document2,$price_validity,$price_validity_year,$social_audit,$audit0,$audit1,$audit2,$audit3,$audit4,$ctpat,$shipment_penelty,$late_shipment_penelty,$late_shipment_max_per,$late_shipment_duration,$chargeback,$repair_labour_rate,$repair_labour_rate_after,$repair_labour_limit,$commissionable,$commision_to,$commision_name,$commision_per,$sample,$sample_qty,$photography,$photography_qty,$packing,$special_notes,$product_testing,$product_testing_paid,$product_testing_1,$product_testing_frequency,$packing_testing1,$packing_testing_frequency,$packing_testing_paid,$fsc,$fsc_years,$fsc_yes0,$fsc_yes1,$fsc_yes2,$branding,$branding_req);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
}

//=============rfq
function rfq_step0($prospect,$rfq_number,$date_of_rfq,$created_date,$created_by)
{
    $query = "insert into sales_rfq(prospect,rfq_number,date_of_rfq,created_date,created_by,step)VALUES(?,?,?,?,?,?)";
    $paramType = "isssii";
    $paramValue = array($prospect,$rfq_number,$date_of_rfq,$created_date,$created_by,'0.5');
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

    $max="select MAX(id) AS max_id from sales_rfq";
    $result = $this->db_handle->runBaseQuery($max);
    $id=$result[0]['max_id'];

    return $id;
}

function rfq_items($sku,$item_type,$sid)
{
    $query = "insert into sales_rfq_items(pid,item_type,sid)VALUES(?,?,?)";
    $paramType = "iii";
    $paramValue = array($sku,$item_type,$sid);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
}

function view_all_rfq()
{
    $query="select * from sales_rfq  ORDER BY id DESC ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result; 
}

function get_rfq_one($id)
{
    $query="select * from sales_rfq where id = '$id' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function sales_rfq_items($sid)
{
    $query="select * from sales_rfq_items where sid = '$sid' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function rfq_step0_edit($prospect,$rfq_number,$date_of_rfq,$created_date,$id)
{
    $update="update sales_rfq SET prospect='$prospect',rfq_number='$rfq_number',date_of_rfq='$date_of_rfq',created_date='$created_date' where id='$id' ";
    $update = $this->db_handle->update($update);
    return $update;
}

function rfq_items_edit($sku,$item_type,$itemid)
{
    $update="update sales_rfq_items SET pid='$sku',item_type='$item_type' where id='$itemid' ";
    $update = $this->db_handle->update($update);
    return $update;
}

function rfq_items_2($sku,$item_type,$sid,$file)
{
    $query = "insert into sales_rfq_items(pid,item_type,sid,file)VALUES(?,?,?,?)";
    $paramType = "iiis";
    $paramValue = array($sku,$item_type,$sid,$file);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
}

function delete_rfq_item($id)
{
    $update="delete from sales_rfq_items where id='$id' ";
    $update = $this->db_handle->update($update);
    return $update;
}

function rfq_step0_5_update($itemid_single,$length_single,$width_single,$height_single,$sid,$wood_single,$fitting_single,$finish_single,$packing_single,$branding_single)
{
    $update="update sales_rfq_items SET length='$length_single',width='$width_single',height='$height_single',wood='$wood_single',fitting='$fitting_single',finish='$finish_single',packing='$packing_single',branding='$branding_single' where id='$itemid_single' ";
    $update = $this->db_handle->update($update);

    //--update step id 0
    $update0="update sales_rfq SET step='0.8' where id='$sid' ";
    $update0 = $this->db_handle->update($update0);


    return $update;
}

function rfq_step0_8_update($itemid_single,$price_single,$sprice_single,$bom_single,$filename,$sid)
{
    $update="update sales_rfq_items SET price='$price_single',sprice='$sprice_single',bom='$bom_single',sfile='$filename' where id='$itemid_single' ";
    $update = $this->db_handle->update($update);

    //--update step id 0
     $update0="update sales_rfq SET step='1.0' where id='$sid' ";
    $update0 = $this->db_handle->update($update0);

    return $update;
}

function rfq_step1_edit($sid)
{
    //--update step id 0
    $update0="update sales_rfq SET step='2.0' where id='$sid' ";
    $update0 = $this->db_handle->update($update0);
    return $update;
}

function rfq_step2_update($itemid_single,$price_single,$moq_single,$repeat_pa_single,$plc_single,$sid)
{
    $update="update sales_rfq_items SET price='$price_single',moq='$moq_single',repeat_pa='$repeat_pa_single',plc='$plc_single' where id='$itemid_single' ";
    $update = $this->db_handle->update($update);

    //--update step id 0
     $update0="update sales_rfq SET step='3.0' where id='$sid' ";
    $update0 = $this->db_handle->update($update0);

    return $update;
}

function rfq_step3_edit($sid)
{
    //--update step id 0
    $update0="update sales_rfq SET step='4.0' where id='$sid' ";
    $update0 = $this->db_handle->update($update0);
    return $update;

    
}

function rfq_step4_discount($itemid_single,$discount_single,$discount_amt_single)
{
  echo  $update="update sales_rfq_items SET discount_per='$discount_single',discount_amt='$discount_amt_single' where id='$itemid_single' ";
    $update = $this->db_handle->update($update);
    return $update;
}

function rfq_step4_edit($sid)
{
    //--update step id 0
    $update0="update sales_rfq SET step='5.0' where id='$sid' ";
    $update0 = $this->db_handle->update($update0);
    return $update;
    
}

function rfq_step5_edit($sid)
{
    //--update step id 0
    $update0="update sales_rfq SET step='6.0' where id='$sid' ";
    $update0 = $this->db_handle->update($update0);
    return $update;
    
}


function delete_moredetails_prospect($id)
{
    $delete="delete from beneficiery_details where id='$id' ";
    $delete = $this->db_handle->update($delete);
    return $delete;
}
//=========== end 
}?>