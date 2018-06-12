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

    $post->id = isset($_GET['id'])? $_GET['id']: die();
    
    // GET THE DATA FROM POST
    $data = json_decode(file_get_contents("php://input"));
    $post->title       = $data->title;
    $post->body        = $data->body;
    $post->category_id = $data->category_id;
    $post->author      = $data->author;

    if($post->update()) {
        echo json_encode(
            array('message' => 'Post Updated Successfully')
        );
    } else {
        echo json_encode(
            array('message' => 'Post could not be updated')
        );
    }
    

?>