<?php

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
$first_name = $data['first_name'];
$last_name = $data['last_name'];
$middle_name= $data['middle_name'];
$course = $data['course'];

$conn = new mysqli('localhost', 'root', '', 'students');

$isInserted = $conn->query("INSERT INTO students (first_name, last_name, middle_name, course) values ('$first_name', '$last_name', '$middle_name', '$course')");

if ($isInserted){
    $id = $conn->insert_id;
    $row = $conn->query("SELECT * FROM students where id = $id");
    $response = $row->fetch_assoc();
    var_dump($response);
    
} else
{
    echo json_encode([
        'message'=> 'Failed to insert data',
        'code'=> 422,
    ]);
}
?>