<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: apllication/json');

    require_once '../config/Database.php';
    require_once '../objects/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Post($db);

    // GET ID 
    $post->id = isset($_GET['id'])? $_GET['id'] : die();
    // Blog post result
    $result = $post->read_single_post();
    // Get row count
    $row_count = $result->rowCount();

    // Check if there is any posts or not
    if($row_count > 0) {
        // Post array
        $row = $result->fetch(PDO::FETCH_ASSOC); 
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body'  => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );
                
        // Turn to JSON and output
        
        echo json_encode($post_item);
        } else {
            // No Posts
            echo json_encode(
                array('message' => 'No Posts Found')
            );
        }
?>