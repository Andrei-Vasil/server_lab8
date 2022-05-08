<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once 'connection/credentials.php';

    if ($_SERVER['REQUEST_METHOD'] != 'PUT' && $_SERVER['REQUEST_METHOD'] != 'OPTIONS' ) { 
        http_response_code(403);    
        exit(1);
    }

    $requestBodyAsStr = file_get_contents('php://input');
    $requestBody = json_decode($requestBodyAsStr, TRUE);

    $id = $requestBody["id"];
    $author = $requestBody["author"];
    $title = $requestBody["title"];
    $genre = $requestBody["genre"];

    $sql = "UPDATE book SET author='$author', title='$title', genre='$genre' WHERE id='$id';";
    $conn = new mysqli($server, $user, $password, $db);
    $result = $conn->query($sql);
    if (!$result) {
        http_response_code(500);    
        exit(1);
    }
    $conn->close();

    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT");
    header("Access-Control-Allow-Origin: *");
    echo json_encode($id);
    exit(0);
?>