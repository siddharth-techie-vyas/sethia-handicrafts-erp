<?php 
require_once ("DBController.php");

class Inventory {

private $db_handle;
   
    function __construct() {
        $this->db_handle = new DBController();
    }

    function successResponse($res)
    {
        $succResp = new stdClass();
        $succResp->success = true;
        $succResp->error = false;
        $succResp->response = $res;
        return $succResp;
    }

    function errorResponse($res)
    {
        $errorResp = new stdClass();
        $errorResp->success = false;
        $errorResp->error = true;
        $errorResp->response = $res;
        return $errorResp;
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
        $query = "insert into products(sku,productname,cat)VALUES(?,?,?)";
        $paramType = "sss";
        $paramValue = array($sku,$name,$cat);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        //-- get maxid and return
        $sql = "SELECT MAX(id) AS maxid FROM products";
        $result = $this->db_handle->runBaseQuery($sql);
        $maxid=$result[0]['maxid'];

        //-- create gallery row 
        $insert0 = "insert into products_gallery(pid,pic)Values('$maxid','$file')";
        $insert =$this->db_handle->update($insert0);

        return $maxid;
    }

    function getall_temp()
	{
		$sql = "SELECT * FROM temp_products ORDER BY id ASC";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
	}
	function save($group_name,$productname,$sku,$design_nu,$cat,$wcm,$dcm,$hcm,$winch,$dinch,$hinch,$logistics,$cbm,$desc,$material_all,$finish_all,$usd,$tags)
    {

        $usd = number_format((float)$usd, 2, '.', '');
        $query = "INSERT INTO products(group_name,productname,sku,design_nu,cat,wcm,dcm,hcm,winch,dinch,hinch,logistics,cbm,descs,material_all,finish_all,usd,tags)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $paramType = "ssssssssssssssssss";
        $paramValue = array($group_name,$productname,$sku,$design_nu,$cat,$wcm,$dcm,$hcm,$winch,$dinch,$hinch,$logistics,$cbm,$desc,$material_all,$finish_all,$usd,$tags);
        
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

    function update($group_name,$productname,$sku,$design_nu,$cat,$wcm,$dcm,$hcm,$winch,$dinch,$hinch,$logistics,$cbm,$desc,$material_all,$finish_all,$usd,$tags,$pid)
    {
        $usd = number_format((float)$usd, 2, '.', '');
        $query = "update products SET group_name='$group_name',productname='$productname',sku='$sku',design_nu='$design_nu',cat='$cat',wcm='$wcm',dcm='$dcm',hcm='$hcm',winch='$winch',dinch='$dinch',hinch='$hinch',logistics='$logistics',cbm='$cbm',descs='$desc',material_all='$material_all',finish_all='$finish_all',usd='$usd',tags='$tags' where id='$pid' ";
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
         $sql = "select *  FROM products_gallery where pid = '$id' ";
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
        echo $sql = "SELECT * FROM products_material where material_type='$type' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function get_finish_type($type)
    {
         $sql = "SELECT * FROM products_finish where finish_material='$type' ";
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
    function add_material($mname,$mid,$mtype,$pic,$labuour_inr,$uom,$capability,$hsn)
    {
        $query = "INSERT INTO products_material(material_name,mid,material_type,pic,labour_inr,uom,capabilities,hsn)VALUES (?,?,?,?,?,?,?,?)";
        $paramType = "ssssssss";
        $paramValue = array($mname,$mid,$mtype,$pic,$labuour_inr,$uom,$capability,$hsn);
        $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function add_finish($finish_name,$coating_system,$finish_material,$distressing,$inhouse,$labour_inr,$pic,$lead_free,$low_voc)
    {
        $query = "INSERT INTO products_finish(finish_name,coating_system,finish_material,distressing,inhouse,labour_inr,image,lead_free,low_voc)VALUES (?,?,?,?,?,?,?,?,?)";
        $paramType = "sssssssss";
        $paramValue = array($finish_name,$coating_system,$finish_material,$distressing,$inhouse,$labour_inr,$pic,$lead_free,$low_voc);
        $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function add_logistics($logistics_name,$assembly_req,$no_of_case,$no_of_item)
    {
        $query = "INSERT INTO products_logistics(logistics_name,assembly_req,no_of_case,no_of_item)VALUES (?,?,?,?)";
        $paramType = "ssss";
        $paramValue = array($logistics_name,$assembly_req,$no_of_case,$no_of_item);
        $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function add_packing($packing_name,$weight_category,$remark,$pic,$labour_inr,$uom)
    {
        $query = "INSERT INTO products_packing(packing_name,weight_category,remark,image,labour_inr,uom)VALUES (?,?,?,?,?,?)";
        $paramType = "ssssss";
        $paramValue = array($packing_name,$weight_category,$remark,$pic,$labour_inr,$uom);
        $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function add_category($cat_name,$cat_code,$desc,$room)
    {
        $query = "INSERT INTO product_category(cat,cat_code,remark,room)VALUES (?,?,?,?)";
        $paramType = "ssss";
        $paramValue = array($cat_name,$cat_code,$desc,$room);
        $this->db_handle->insert($query, $paramType, $paramValue);
    }
    function get_material()
    {
        $sql = "SELECT * FROM products_material  ORDER BY material_name ASC ";
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

    //--catalogue
    function get_catalogue($tags)
    {
        $sql = "SELECT * FROM products where tags LIKE '%$tags%'";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result; 
        
    }

    //-- capability
    function get_capability()
    {
        $sql = "SELECT * FROM products_capability ORDER BY id ASC";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result; 
        
    }
    function get_capability_byid($id)
    {
        $sql = "SELECT * FROM products_capability where id='$id' ";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result; 
        
    }


    //---------------- api
    function wordpress_product($key)
    {
        $data=array();
        $query="select * from products where tags LIKE '%$key%'";
        $result = $this->db_handle->runBaseQuery($query);
        if($result)
                        {
                            // foreach($result as $r=>$v)
                            // {
                            //     //-- get city name 
                            //     $city = $this->admin->get_city($result[$r]['city']);

                            //     $returnObj = new stdClass();
                            // $returnObj->city = $city[0]['name'];
                            
                            // }
                    
                            //     $result1 = $this->successResponse($data);
                            //     echo json_encode($result1);

                            foreach($result as $k=>$v)
                            {
                                $returnObj = new stdClass();
                                $returnObj->product_name = $result[$k]['productname'];
                                $returnObj->height = $result[$k]['hcm'];
                                $returnObj->width = $result[$k]['wcm'];
                                $returnObj->depth = $result[$k]['dcm'];
                                
                                $gallery=$this->getone_gallery($result[$k]['id']);
                                $returnObj->featured_image = $gallery[0]['pic'];
                                array_push($data, $returnObj);
                                
                            }
                                $result1 = $this->successResponse($data);
                                echo json_encode($result1);
                                
                        }  
                        else
                        {
                            $returnObj = new stdClass();
                            $returnObj->msg = "No Product Found";   
                            $result1 = $this->errorResponse($returnObj);
                            echo json_encode($result1);
        
                        }
    }
}
?>

