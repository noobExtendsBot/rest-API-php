<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: apllication/json');

    require_once '../../config/Database.php';
    require_once '../../models/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Post($db);

    // Blog post result
    $result = $post->read();
    // Get row count
    $row_count = $result->rowCount();

    // Check if there is any posts or not
    if($row_count > 0) {
        // Post array

        $posts_arr = array();
        $posts_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );
            
            // Push to 'data'
            array_push($posts_arr['data'], $post_item);
            }
            // Turn to JSON and output
            
            echo json_encode($posts_arr);
        } else {
            // No Posts
            echo json_encode(
                array('message' => 'No Posts Found')
            );
        }
?>