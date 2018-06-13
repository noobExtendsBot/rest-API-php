<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: apllication/json');

    require_once '../config/Database.php';
    require_once '../objects/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    $result = $category->read();
    $row_count = $result->rowCount();
    if($row_count > 0) {

        $posts_arr = array();
        $posts_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $post_item = array(
                "id" => $id,
                "name" => $name,
                "created_at" => $created_at
            );
            
            // Save each item to array
            array_push($posts_arr['data'], $post_item);
        }
        // output it as json data
        echo json_encode($posts_arr);
    } else {
        echo json_encode(
            array('message' => 'No Data Found')
        );
    }
    

?>