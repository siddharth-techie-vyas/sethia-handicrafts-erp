<?php 
require_once ("DBController.php");

class Inventory {

private $db_handle;
   
    function __construct() {
        $this->db_handle = new DBController();
    }

    function add_group($group_name,$group_code,$desc)
    {
        $query = "insert into products_group (group_name,group_code,descs)VALUES(?,?,?)";
        $paramType = "sss";
        $paramValue = array($group_name,$group_code,$desc);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    function tempsave($sku,$file,$name,$cat)
    {
        $query = "insert into temp_products(sku,file,product_name,cat)VALUES(?,?,?,?)";
        $paramType = "sssi";
        $paramValue = array($sku,$file,$name,$cat);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        //-- get maxid and return
        $sql = "SELECT MAX(id) AS maxid FROM temp_products";
        $result = $this->db_handle->runBaseQuery($sql);
        $maxid=$result[0]['maxid'];
        return $maxid;
    }

    function getall_temp()
	{
		$sql = "SELECT * FROM temp_products ORDER BY id ASC";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}
	function save($group_name,$productname,$sku,$design_nu,$cat,$wcm,$dcm,$hcm,$winch,$dinch,$hinch,$logistics,$cbm,$desc,$material_all,$finish_all,$usd)
    {

        $usd = number_format((float)$usd, 2, '.', '');
        $query = "INSERT INTO products(group_name,productname,sku,design_nu,cat,wcm,dcm,hcm,winch,dinch,hinch,logistics,cbm,descs,material_all,finish_all,usd)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $paramType = "sssssssssssssssss";
        $paramValue = array($group_name,$productname,$sku,$design_nu,$cat,$wcm,$dcm,$hcm,$winch,$dinch,$hinch,$logistics,$cbm,$desc,$material_all,$finish_all,$usd);
        
        $this->db_handle->insert($query, $paramType, $paramValue);

        

        //-- get maxid and return
        $sql = "SELECT MAX(id) AS maxid FROM products";
        $result = $this->db_handle->runBaseQuery($sql);
        $maxid=$result[0]['maxid'];

        //-- create gallery row 
        $insert0 = "insert into products_gallery(pid)Values($maxid)";
        $insert =$this->db_handle->update($insert0);

        return $maxid;
    }

    function update($group_name,$productname,$sku,$design_nu,$cat,$wcm,$dcm,$hcm,$winch,$dinch,$hinch,$logistics,$cbm,$desc,$material_all,$finish_all,$usd,$pid)
    {
        $usd = number_format((float)$usd, 2, '.', '');
        $query = "update products SET group_name='$group_name',productname='$productname',sku='$sku',design_nu='$design_nu',cat='$cat',wcm='$wcm',dcm='$dcm',hcm='$hcm',winch='$winch',dinch='$dinch',hinch='$hinch',logistics='$logistics',cbm='$cbm',descs='$desc',material_all='$material_all',finish_all='$finish_all',usd='$usd' where id='$pid' ";
        $insert =$this->db_handle->update($query);
        return $insert;
    }

    function save_gallery($id,$pic,$gallery_img)
    {
         $query = "update products_gallery SET pic='$pic',gallery_img='$gallery_img' where pid='$id'";
        $insert =$this->db_handle->update($query);
        return $insert;
    }
	
	function getall()
	{
		$sql = "SELECT * FROM products ORDER BY id ASC";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function getall_group()
    {
        $sql = "SELECT * FROM products_group ORDER BY id ASC";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
	
	function delete($id)
	{
		$sql = "delete FROM products where id = $id ";
        
        $result = $this->db_handle->runSingleQuery($sql);
        return $result;
	}
	
	function getone($id)
	{
		$sql = "select *  FROM products where id = $id ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function getone_gallery($id)
    {
        $sql = "select *  FROM products_gallery where pid = $id ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getone_temp($id)
	{
		$sql = "select *  FROM temp_products where id = $id ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}
	
	function getone_product_accessories($id)
	{
		 $sql = "select * FROM product_accessories where pid = '$id' ";
        $result = $this->db_handle->runBaseQuery($sql);
        
        return $result;
	}

    function getone_product_details($id)
	{
		$sql = "select * FROM product_details where pid = '$id' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function getone_product_details_bymaterial($id,$material)
    {
        $sql = "select * FROM product_details where pid = '$id' AND material LIKE '%$material%'";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getone_product_details_nomaterial($id)
    {
        $sql = "select * FROM product_details where pid = '$id' AND material NOT LIKE '%cartoon%' AND material NOT LIKE '%wood%' AND material NOT LIKE '%iron%' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getone_product_details_material($id,$material)
	{
		$sql = "select * FROM product_details where pid = '$id' AND material='$material' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}

    function get_product_history($id)
    {
        $sql = "SELECT * FROM product_history ORDER BY id DESC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function add_details($pid,$material,$clength,$cwidth,$cheight,$cbm,$weight_cartoon,$weight_plastic,$weight_wood,$weight_iron,$net_weight,$gross_weight)
    {
        $query = "INSERT INTO product_details(pid,material,clength,cwidth,cheight,cbm,weight_cartoon,weight_plastic,weight_wood,weight_iron,net_weight,gross_weight)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $paramType = "isssssssssss";
        $paramValue = array($pid,$material,$clength,$cwidth,$cheight,$cbm,$weight_cartoon,$weight_plastic,$weight_wood,$weight_iron,$net_weight,$gross_weight);
        
        $this->db_handle->insert($query, $paramType, $paramValue);
    }
	
	
    
    function add_product_details($pid,$acce0,$qty0,$remark0)
    {
        $query = "INSERT INTO product_accessories(pid,acce,qty,remark)VALUES (?,?,?,?)";
        $paramType = "iiis";
        $paramValue = array($pid,$acce0,$qty0,$remark0);
        $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function delete_accesories($id)
    {
        $query = "DELETE FROM product_accessories WHERE id = $id";
        $this->db_handle->update($query);
    }

    function delete_details($id)
    {
        $query = "DELETE FROM product_details WHERE id = $id";
        $this->db_handle->update($query);
    }

    function delete_product($id)
    {
        $query = "DELETE FROM products WHERE id = $id";
        $this->db_handle->update($query);
        
        $query0 = "DELETE FROM product_details WHERE pid = $id";
        $this->db_handle->update($query0);

        $query0 = "DELETE FROM product_accesories WHERE pid = $id";
        $this->db_handle->update($query0);

    }

    function update_cbm($pid)
    {
        $sum="select SUM(cbm) AS cbm_f from product_details where pid = '$pid' ";
        $sum=$this->db_handle->runBaseQuery($sum);
        $cbm_f=$sum[0]['cbm_f'];
        //-- update sum
        $update="update products SET gross_cbm='$cbm_f' where id='$pid' ";
        $update = $this->db_handle->update($update);
    	return $update;
    }

    //-- cat and subcatregory
    function get_products_cat()
    {
        $sql = "SELECT * FROM product_category ORDER BY cat ASC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_category_one($id)
    {
        $sql = "SELECT * FROM product_category where id='$id' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_category_all()
    {
        $sql = "SELECT DISTINCT(cat),id FROM product_category where cat NOT REGEXP '^[0-9]+$' ORDER BY cat ASC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_subcategory_all($cat)
    {
        $sql = "SELECT * FROM product_category where cat='$cat' ORDER BY subcat ASC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    

    function get_finish()
    {
        $sql = "SELECT * FROM products_finish ORDER BY id ASC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_logistics()
    {
        $sql = "SELECT * FROM products_logistics ORDER BY id ASC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }


    function get_packing()
    {
        $sql = "SELECT * FROM products_packing ORDER BY id ASC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }


    function get_material_byid($id)
    {
        $sql = "SELECT * FROM products_material where id='$id' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_material_byname($name)
    {
        $sql = "SELECT * FROM products_material where material_name='$name' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_material_bytype($type)
    {
        $sql = "SELECT * FROM products_material where material_type='$type' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_finish_type($type)
    {
       echo  $sql = "SELECT * FROM products_finish where finish_material='$type' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_finish_byid($id)
    {
        $sql = "SELECT * FROM products_finish where id='$id' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_partlist($pid)
    {
        $sql = "SELECT * FROM product_cuttinglist_items where pid='$pid' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }


    //=============material master
    function add_material($mname,$mid,$mtype,$pic,$labuour_inr,$uom)
    {
        $query = "INSERT INTO products_material(material_name,mid,material_type,pic,labour_inr,uom)VALUES (?,?,?,?,?,?)";
        $paramType = "ssssss";
        $paramValue = array($mname,$mid,$mtype,$pic,$labuour_inr,$uom);
        $this->db_handle->insert($query, $paramType, $paramValue);
    }
    function get_material()
    {
        $sql = "SELECT * FROM products_material where mid = '0' ORDER BY material_name ASC ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_material_sub($mid)
    {
        $sql = "SELECT * FROM products_material where mid = '$mid'";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_material_unique()
    {
        $sql = "SELECT DISTINCT(material_type) FROM products_material  ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>

