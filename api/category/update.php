<?php 
    // necessary headers

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: apllication/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');
    
    require_once "../config/Database.php";
    require_once "../objects/Category.php";

    // create a databse INSTANCE

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    // GET THE DATA FROM POST
    $data = json_decode(file_get_contents("php://input"));
    $category->name           = $data->name;
    $category->id             = $data->id;

    if($category->update()) {
        echo json_encode(
            array('message' => 'Category Updated Successfully')
        );
    } else {
        echo json_encode(
            array('message' => 'Category could not be updated')
        );
    }

?>