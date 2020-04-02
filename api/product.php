<?php

//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: access");

//Include db and object

include_once 'config/database.php';
include_once 'objects/product.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if (isset($_GET['id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        //UPDATE 

        $data = json_decode(file_get_contents("php://input"));
  
        // set ID property of product to be edited
        $product->id = isset($_GET['id']) ? $_GET['id']: die;
          
        // set product property values
        $product->name = $data->name;
        $product->price = $data->price;
        $product->description = $data->description;
        $product->category_id = $data->category_id;

        //update product
        echo $product->update();
        if($product->update()){
            echo '{';
                echo '"message": "Product was updated."';
            echo '}';
        }else{
            echo '{';
                echo '"message": "Unable to update product."';
            echo '}';
        }
       
    }
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        //DELETE        
        echo "Methodnya DELETE\n";
        echo $_SERVER['REQUEST_METHOD'];
        //Get post data
        // get product id
        
        $product->id = isset($_GET['id']) ? $_GET['id']: die;
        // set product id to be deleted
        
        // delete the product
        if($product->delete()){
        
            // set response code - 200 ok
            http_response_code(200);
        
            // tell the user
            echo json_encode(array("message" => "Product was deleted."));
        }
        
        // if unable to delete the product
        else{
        
            // set response code - 503 service unavailable
            http_response_code(503);
        
            // tell the user
            echo json_encode(array("message" => "Unable to delete product."));
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //READ_ONE        
        echo "Methodnya GET\n";
        echo "READ_ONE";
        //Set ID of product to be edited
        $product->id = isset($_GET['id']) ? $_GET['id']: die;

        //Read details of edited product
        $product->readOne();

        //Create array
        $product_arr = array(
            "id" => $product->id,
            "name" => $product->name,
            "description" => $product->description,
            "price" => $product->price,
            "category_id" => $product->category_id,
            "category_name" => $product->category_name
        );

        print_r(json_encode($product_arr));

    }
    
}
else{
    echo "tidak mempunyai id \n";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //CREATE
        echo "Methodnya POST\n";
        echo "CREATE";
        // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // make sure data is not empty
    if(
        !empty($data->name) &&
        !empty($data->price) &&
        !empty($data->description) &&
        !empty($data->category_id)
    ){
    
        // set product property values
        $product->name = $data->name;
        $product->price = $data->price;
        $product->description = $data->description;
        $product->category_id = $data->category_id;
        $product->created = date('Y-m-d H:i:s');
    
        // create the product
        if($product->create()){
    
            // set response code - 201 created
            http_response_code(201);
    
            // tell the user
            echo json_encode(array("message" => "Product was created."));
        }
    
        // if unable to create the product, tell the user
        else{
    
            // set response code - 503 service unavailable
            http_response_code(503);
    
            // tell the user
            echo json_encode(array("message" => "Unable to create product."));
        }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //READ
        echo "Methodnya GET\n";
        echo "READ";
        //Query products
        $stmt = $product->read();
        $num = $stmt->rowCount();

        //Check if more than 0 record found
        if($num > 0){

            //products array
            $products_arr = array();
            $products_arr["records"] = array();

            //retrieve table content
            // Difference fetch() vs fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);

                $product_item = array(
                    "id"            =>  $id,
                    "name"          =>  $name,
                    "description"   =>  html_entity_decode($description),
                    "price"         =>  $price,
                    "category_id"   =>  $category_id,
                    "category_name" =>  $category_name
                );

                array_push($products_arr["records"], $product_item);
            }

            echo json_encode($products_arr);
        }else{
            echo json_encode(
                array("messege" => "No products found.")
            );
        }

    }

}