<?php

$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "job_app"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Extract and sanitize input
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $password = $data['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        exit();
    }

    // Check if email already exists in the database
    $checkEmailStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email is already registered.']);
        $checkEmailStmt->close();
        $conn->close();
        exit();
    }
    $checkEmailStmt->close();

    // Hash the password for secure storage
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error preparing the statement: ' . $conn->error]);
        $conn->close();
        exit();
    }

    $stmt->bind_param("ss", $email, $hashedPassword);

    if ($stmt->execute()) {

        echo json_encode(['success' => true, 'message' => 'Registration successful!']);
    } else {
    
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }


    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No data received.']);
}
?>
