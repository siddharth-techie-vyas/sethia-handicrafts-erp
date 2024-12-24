<?php 
require_once ("DBController.php");



class Hr
{
    private $db_handle;

    function __construct()
    {
        $this->db_handle = new DBController();
    }

    function edit_profile($gender,$company_now,$location,$religion,$dob,$family_linkage,$goal,$motivation,$channel,$current_since,$uid)
    {
        // $query="select * from hr_profile where uid='$id' ";
        // $result = $this->db_handle->runBaseQuery($query);
        // if($result)
        // {
        $query = "Update hr_profile SET gender='$gender',company_now='$company_now',location='$location',religion='$religion',dob='$dob',family_linkage='$family_linkage',goal='$goal',motivation='$motivation',channel='$channel',current_since='$current_since' where uid='$uid' ";
        $result = $this->db_handle->update($query);
        return $result;	
        // }
        // else
        // {
        //     $query = "insert into gender='$gender',company_now='$company_now',location='$location',religion='$religion',dob='$dob',family_linkage='$family_linkage',goal='$goal',motivation='$motivation',channel='$channel',current_since='$current_since')VALUES(?,?,?,?,?)";
        //     $paramType = "ssssi";
        //     $paramValue = array($gender,$company_now,$location,$religion,$dob,$family_linkage,$goal,$motivation,$channel,$current_since,$uid);
        //     $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        //     return $insertId; 
        // }
    }

    function edit_emp_experience($company,$from,$to,$designation,$uid)
    {
        $query = "insert into hr_emp_experience(company,from_date,to_date,designation,uid)VALUES(?,?,?,?,?)";
        $paramType = "ssssi";
        $paramValue = array($company,$from,$to,$designation,$uid);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;     
    }

    function get_emp_profile($id)
    {
        $query="select * from hr_profile where uid='$id' ";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }
    

}