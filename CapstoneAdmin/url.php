<?php
session_set_cookie_params(86400); // 86400 seconds = 24 hours
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acv_db";
$response = ['status' => '', 'message' => ''];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $url = $_POST['url'];
    $dog_id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE dogs_tbl SET url = :url WHERE id = :dog_id");
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':dog_id', $dog_id); 
    $stmt->execute();
    $response['status'] = 'success';
    $response['message'] = 'URL updated successfully';
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $e->getMessage();
}
header('Content-Type: application/json');
echo json_encode($response);
?>
