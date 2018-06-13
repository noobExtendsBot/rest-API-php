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

        $category->id = $data->id;

        if($category->delete()) {
            echo json_encode(
                array('message' => 'Resource Deleted')
            );
        } else {
            echo json_encode(
                array('message' => 'Resource Could Not Be Deleted')
            );
        }
?>