<?php 

    // necessary headers

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: apllication/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');
    
    require_once "../config/Database.php";
    require_once "../objects/Post.php";

    // create a databse INSTANCE

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);

    //GET id from URL

    $post->id = isset($_GET['id'])? $_GET['id']:die();
    if($post->delete()) {
        echo json_encode(
            array('message' => 'Resource has been deleted succesfully')
        );
    } else {
        echo json_encode(
            array('message' => 'Could not delete resource')
        );
    }    
?>