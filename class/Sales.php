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

}?>