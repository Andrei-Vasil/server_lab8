<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once 'connection/credentials.php';

    if ($_SERVER['REQUEST_METHOD'] != 'GET') { 
        http_response_code(403);    
        exit(1);
    }

    $data = [];
    
    $sql = "SELECT * FROM book;";
    $conn = new mysqli($server, $user, $password, $db);
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();

    header("Access-Control-Allow-Origin: *");
	echo json_encode($data);

?>