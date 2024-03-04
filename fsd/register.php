<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_mushahidkhan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $social_title = mysqli_real_escape_string($conn, $_POST['social_title']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthdate = $_POST['birthdate'];
    $receive_offers = isset($_POST['receive_offers']) ? 1 : 0;
    $neighbourhood = mysqli_real_escape_string($conn, $_POST['neighbourhood']);
    $business_info = mysqli_real_escape_string($conn, $_POST['business_info']);
    $is_wholeseller = isset($_POST['is_wholeseller']) ? 1 : 0;
    $business_address = mysqli_real_escape_string($conn, $_POST['business_address']);
    $annual_budget = mysqli_real_escape_string($conn, $_POST['annual_budget']);

    $sql = "INSERT INTO users (social_title, first_name, last_name, email, password, birthdate, receive_offers, neighbourhood, business_info, is_wholeseller, business_address, annual_budget) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param('ssssssssssssss', $social_title, $first_name, $last_name, $email, $password, $birthdate, $receive_offers, $neighbourhood, $business_info, $is_wholeseller, $business_address, $annual_budget);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
