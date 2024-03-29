<?php
// include database and object files
include_once '../../config/database.php';
include_once '../../models/cachorro.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$cachorro = new Cachorro($db);
 
// query products
$stmt = $cachorro->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
 
    // products array
    $cachorros_arr=array();
    $cachorros_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $cachorro_item=array(
            "id" => $id,
            "raza" => $raza,
            "id" => $id,
            "nombres" => $nombres,
            "origen" => $origen,
            "tamanio" => $tamanio,
            "img" => $img,
            
        );
 
        array_push($cachorros_arr["records"], $cachorro_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($cachorros_arr);
} else {
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No cachorros found.")
    );
}

?>