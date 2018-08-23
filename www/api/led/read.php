<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once  __DIR__"/../config/dbconfig.php" ;
include_once __DIR__"/../objects/led.php";

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$led = new Led($db);
 
// query products
$stmt = $led->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $led_arr=array();
    $led_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "id" => $id,
            "status" => $status,
            "time" => $time,
            "date" => $date,
        );
 
        array_push($led_arr["records"], $led_item);
    }
 
    echo json_encode($led_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>
