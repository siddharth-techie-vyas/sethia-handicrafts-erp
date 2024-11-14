<?php 
require_once ("DBController.php");

class Admin 
{
    private $db_handle;

    function __construct()
    {
        $this->db_handle = new DBController();
    }
//========== company
function get_company()
{
        // $get=$db_handle->runSingleQuery('company','');
        // return $get();
}
	
//======== country state city (ALL)
function get_country()
{
    $query = "select * from countries Order by name ASC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
function get_states($country_id)
{
    $query = "select * from states where country_id='$country_id' Order by name ASC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
function get_cities($state_id)
{
    $query = "select * from cities where state_id='$state_id' Order by name ASC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

//======== country state city (single)
function get_country_one($id)
{
    $query = "select * from countries where id='$id'";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
function get_states_one($id)
{
    $query = "select * from states where id='$id'";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
function get_cities_one($id)
{
    $query = "select * from cities where  id='$id'";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}



//================META DATA
	
function get_metaname()
{
    $query = "select * from meta_data GROUP BY meta_name DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function get_metaname_byvalue($meta_name)
{
    $query = "select * from meta_data where meta_name='$meta_name'";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function get_metaname_byvalue2($meta_name,$value2)
{
    $query = "select * from meta_data where meta_name='$meta_name' AND value2='$value2' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function get_metaname_byid($id)
{
    $query = "select * from meta_data where id='$id'";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function create_meta($metaname,$value1,$value2)
{
    $query = "insert into meta_data(meta_name,value1,value2)VALUES(?,?,?)";
    $paramType = "sss";
    $paramValue = array($metaname,$value1,$value2);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
}

function viewall_meta()
{
    $query = "select * from meta_data ORDER BY id DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function delete_meta($id)
{
    $query = "delete from meta_data where id='".$id."' ";   
    $result = $this->db_handle->runSingleQuery($query);
    return $result;
}
}
