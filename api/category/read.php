<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: apllication/json');

    require_once '../../config/Database.php';
    require_once '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();
    

?>