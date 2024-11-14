<?php 
require_once ("DBController.php");

class Leads 
{
    
    function __construct()
    {
        $this->db_handle = new DBController();
    }

    function create_new($name,$phone,$email,$city,$state,$country,$designation,$req,$lp_url,$form_id,$company)
    {   
        
        // $collection = (new MongoDB\Client)->$db_handle->leads;
        // $insertOneResult = $collection->insertOne([
        //     'name' => $name,
        //     'phone' => $phone,
        //     'email' => $email,
        //     'city' => $city,
        //     'country' => $country,
        //     'designation' => $designation,
        //     'req' => $req,
        //     'lp_url' => $lp_url,
        //     'form_id' => $lp_url
        // ]);
        // printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
        // var_dump($insertOneResult->getInsertedId());

        $query = "insert into leads(name,phone,email,city,state,country,designation,req,lp_url,form_id,company)VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $paramType = "sisiiisssis";
        $paramValue = array($name,$phone,$email,$city,$state,$country,$designation,$req,$lp_url,$form_id,$company);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    	return $insertId;    
        

    }

    function edit_lead($name,$phone,$email,$city,$state,$country,$designation,$req,$lp_url,$form_id,$company,$id)
    {
         $query = "Update leads SET name=?,phone=?,email=?,city=?,state=?,country=?,designation=?,req=?,lp_url=?,form_id=?,company=? where id=? ";
        $paramType = "sisiiisssisi";
        $paramValue = array($name,$phone,$email,$city,$state,$country,$designation,$req,$lp_url,$form_id,$company,$id);
        $insertId = $this->db_handle->update($query, $paramType, $paramValue);
        return $insertId;
    }

    function view_all()
    {
        $query="select * from leads ORDER BY id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_lead_one($id)
    {
        $query="select * from leads where id='$id'";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_group()
    {
        $query="select * from lead_group ORDER BY id DESC";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function create_group($gname,$color)
    {        
        $query = "insert into lead_group(gname,color)VALUES(?,?)";
        $paramType = "ss";
        $paramValue = array($gname,$color);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    	return $insertId;    
        
    }

    function get_group_record($groupid)
    {
        $query="select * from lead_group where id='$groupid'";
		$result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function get_leads_bystatus($status)
    { 
        $query="select * from leads where status='$status'";
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
    function save_feedback($id,$feedback)
    {
        $query = "insert into lead_feedback(lid,feedback)VALUES(?,?)";
        $paramType = "is";
        $paramValue = array($id,$feedback);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    	return $insertId;    
       
    }

    function get_feedback_limit_5($id)
    {
        $query="select * from lead_feedback where lid='$id'ORDER by id LIMIT 5 ";
		$result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }

}

