<?php 
require_once ("DBController.php");

class Leads 
{
    
    function __construct()
    {
        $this->db_handle = new DBController();
    }

    function create_new($company,$company_type,$groupid,$group_remak,$userid,$attachment,$target_date)
    {           
        $query = "insert into leads(company,company_type,group_id,group_remark,handledby,attachment,targetted_date)VALUES(?,?,?,?,?,?,?)";
        $paramType = "ssisiss";
        $paramValue = array($company,$company_type,$groupid,$group_remak,$userid,$attachment,$target_date);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    	return $insertId;        
        

    }

    function edit_lead($name,$phone,$email,$city,$state,$country,$designation,$req,$lp_url,$form_id,$company,$status,$id)
    {
        $update="update leads SET name='$name',phone='$phone',email='$email',city='$city',state='$state',country='$country',designation='$designation',req='$req',lp_url='$lp_url',form_id='$form_id',company='$company', status='$status' where id='$id' ";
        $up = $this->db_handle->update($update);
        return $up;

        // $query = "Update leads SET name=?,phone=?,email=?,city=?,state=?,country=?,designation=?,req=?,lp_url=?,form_id=?,company=? where id=? ";
        // $paramType = "sisiiisssisi";
        // $paramValue = array($name,$phone,$email,$city,$state,$country,$designation,$req,$lp_url,$form_id,$company,$id);
        // $insertId = $this->db_handle->update($query, $paramType, $paramValue);
        // return $insertId;
    }

    function view_all()
    {
        $query="select * from leads ORDER BY id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function view_all_byuser($uid)
    {
        $query="select * from leads where handledby='$uid' ORDER BY id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_lead_one($id)
    {
        $query="select * from leads where id='$id'";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_lead_last_feedback($id)
    {
        $query="select * from lead_feedback where lid='$id' ORDER BY id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_group()
    {
        $query="select * from lead_group where parent_group='0' ORDER BY id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_sub_group($id)
    {
        $query="select * from lead_group where parent_group='$id' ORDER BY id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

function get_group_one($id)
    {
        $query="select * from lead_group where id='$id'  ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function create_group($gname,$parent_group,$lead_confirm_time,$per_day_lead,$color)
    {        
        $query = "insert into lead_group(gname,parent_group,lead_confirm_time,per_day_lead,color)VALUES(?,?,?,?,?)";
        $paramType = "siiis";
        $paramValue = array($gname,$parent_group,$lead_confirm_time,$per_day_lead,$color);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    	return $insertId;    
        
    }

    function get_group_record($groupid)
    {
        $query="select * from leads where group_id='$groupid'";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_leads_bystatus($status)
    { 
        $query="select * from leads where status='$status'";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_leads_bystatus_byuser($status,$uid)
    { 
        $query="select * from leads where status='$status' AND handledby='$uid' ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_leads_qualified($qa)
    {
        $query="select * from leads where lead_qualified='$qa'";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    //-- feedback
    function save_feedback($id,$feedback,$status,$next_feedback_date,$qualified,$feedback_type)
    {
        $query = "insert into lead_feedback(lid,feedback,next_feedback_date,feedback_type)VALUES(?,?,?,?)";
        $paramType = "isss";
        $paramValue = array($id,$feedback,$next_feedback_date,$feedback_type);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    	  

        //-- update lead status to pending 
        $query="select * from leads where id='$id'";
		$result = $this->db_handle->runBaseQuery($query);


        $updated=date('Y-m-d h:i:s');
            if($result[0]['status'] != $status)
            { $query0 = "Update leads SET status='$status', lead_qualified='$qualified', last_updated='$updated' where id='$id' ";}
            else{ $query0 = "Update leads SET last_updated='$updated',lead_qualified='$qualified' where id='$id' ";}
        $insertId0 = $this->db_handle->update($query0);    
        return $insertId0;
       
    }

    function get_feedback_limit_5($id)
    {
        $query="select * from lead_feedback where lid='$id'ORDER by id LIMIT 5 ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function get_feedback_list($id)
    {
        $query="select * from lead_feedback where lid='$id' AND feedback_type != '' ORDER by id  ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function get_feedback_list_sales($id)
    {
        $query="select * from lead_feedback where lid='$id' AND feedback_type = '' ORDER by id  ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function lead_feedback_viewall()
    {
        $query="select * from lead_feedback GROUP BY lid ORDER by id DESC  LIMIT 20";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function save_csv_records($header,$bodyrow)
    {
        $header=preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $header);
        $bodyrow=implode("','",$bodyrow);
        //-- query
        $insert="insert into leads($header)Values('$bodyrow')";
        $result = $this->db_handle->insert_id($insert);
        //-- max id return
        $max= $this->db_handle->get_max_id('leads');
        return $max['MAX'];
    }

    function save_csv_records2($header,$max_id,$type)
    {
        
        //-- col loop
        $col=array();      
        $d=1;
        
        foreach($header as $r)
        {
            array_push($col,'col'.$d);
            $d++;
        }  
        $col_name = implode(",",$col);    


        $header = implode("','", array_map(function ($entry) {            
            return $entry['column_data'];
          }, $header));

        $header=preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $header);


        //-- query
         $insert="insert into leads2($col_name,lid,type)Values('$header','$max_id','$type')";
        $result = $this->db_handle->insert_id($insert);
        //return $result;
    }

    function upload_csv_details($file,$nu_record,$userid,$groupid)
    {
       
        $query = "insert into leads_upload_history(filename,uploadedby,nu_of_records,uploadedto,groupid)VALUES(?,?,?,?,?)";
        $paramType = "siiii";
        $paramValue = array($file,$_SESSION['uid'],$nu_record,$userid,$groupid);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function get_my_uploads_dashboard($uid)
    {
        $query="select * from leads_upload_history where uploadedto='$uid' ORDER by id DESC LIMIT 5 ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }


    function get_my_uploads($uid)
    {
        $query="select * from leads_upload_history where uploadedto='$uid' ORDER by id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function get_all_uploads()
    {
        $query="select * from leads_upload_history  ORDER by id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }


    function get_my_next_follow_dashboard($uid)
    {
        $date=date('Y-m-d');
        $query="SELECT * FROM leads t1 INNER JOIN lead_feedback t2 ON t1.id = t2.lid WHERE t1.handledby = '$uid' AND t2.next_feedback_date='$date' LIMIT 5";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function get_my_next_follow_old_dashboard($uid)
    {
        $date=date('Y-m-d');
        $query="SELECT * FROM leads t1 INNER JOIN lead_feedback t2 ON t1.id = t2.lid WHERE t1.handledby = '$uid' AND t2.next_feedback_date < '$date' LIMIT 5";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function get_leadbystatus_dashboard_month($uid,$month)
    {
        $query="SELECT COUNT('id') AS count,status FROM leads where handledby = '$uid' AND last_updated LIKE '$month%' GROUP BY status ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function get_leadbystatus_dashboard_overall($uid)
    {
        $query="SELECT COUNT('id') AS count,status FROM leads where handledby = '$uid' GROUP BY status ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function get_group_allotedto_data($uid)
    {
        $query="SELECT * FROM leads_upload_history where uploadedto = '$uid' ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    //--- reports function 
    function get_leads_handled_bt_dates($start,$end)
    {
        $query="SELECT * FROM lead_feedback where date_time BETWEEN '$start' AND '$end' ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

    function leads_save_company_details($lid,$details,$subdetails,$remark)
    {
        $query = "insert into lead_compnay_details(lid,details,subdetails,remark) VALUES(?,?,?,?)";
        $paramType = "isss";
        $paramValue = array($lid,$details,$subdetails,$remark); 
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function get_leads_company_details($lid)
    {
        $query="SELECT * FROM lead_compnay_details  where lid='$lid' ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;   
    }
}

