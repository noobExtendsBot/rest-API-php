<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: apllication/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    require_once '../config/Database.php';
    require_once '../objects/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);
    $data = json_decode(file_get_contents("php://input"));

    $category->name = $data->name;

    if($category->create()) {
        echo json_encode(
            array('message' => 'New Category Ceated')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Can Not Be Created')
        );
    }
?>