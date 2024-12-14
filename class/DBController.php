<?php

 class DBController {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "sethia-erp";
    private $conn;

	

   function __construct() {
        //$conn = $this->connectDB($database,$uri,$driverOptions);

        $this->conn = $this->connectDB();
         
      error_reporting(0);
    }   
    
    function default_timezone()
    {
                  date_default_timezone_set("Asia/Kolkata");
                  $current_date = date("Y-m-d h:i:sa");
                  return $current_date;

                   //daily_backup();
                  
    }

    function connectDB() {
        
        // $client = new MongoDB\Client($uri, [], $driverOptions);
        // try {

        //     // Ping the server to verify that the connection works
        //     $db = $client->$dbname;
        //     $command = new MongoDB\Driver\Command(['ping' => 1]);
        //     $result = $db->command($command)->toArray();
        //         //echo json_encode($result), PHP_EOL;
        
        // } catch (MongoDB\Driver\Exception\RuntimeException $e) {
        
        //     printf("Failed to ping the MongoDB server: %s\n", $e->getMessage());
        //     exit();
        // }
        
        
        // return $db;

        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }
    
    function runBaseQuery($query) {
        
		$result = $this->conn->query($query);   
        //if($result->num_rows > 0) {
		if (! empty($result)) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
		else {$resultset=0;}
        return $resultset;
    }
    
    
    function runSingleQuery($tablename,$array) {
        $collection = (new MongoDB\Client)->$db->$tablename;
        echo $tablename;
        // $col1=$collection->findOne(["uname" => $uname, "upass" => $upass]);
        // $result = json_encode($col1);            
    }
	
    function runQuery($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }
    
    function insert($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $insertId = $sql->insert_id;
        return $insertId;
    }
    
    // function update($query, $param_type, $param_value_array) {
    //     $sql = $this->conn->prepare($query);
    //     $this->bindQueryParams($sql, $param_type, $param_value_array);
    //     $sql->execute();
    // }
	
    function update($query) {
        $result = $this->conn->query($query);   
        //$user = mysqli_fetch_array($result);
		return $result;
    }	
	
}
?>

