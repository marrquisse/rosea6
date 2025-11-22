<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 

$filename = 'data.json';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $input = file_get_contents('php://input');
    
   
    $decoded = json_decode($input);
    
    if ($decoded !== null) {
      
        file_put_contents($filename, $input);
        echo json_encode(['status' => 'success', 'message' => 'Дані успішно збережено!']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Помилка: некоректні дані JSON']);
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($filename)) {
        echo file_get_contents($filename);
    } else {
        
        echo json_encode([]);
    }
    exit;
}
?>