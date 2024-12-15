<?php
// Database configuration
$servername = "localhost";
$username = "root";  // Default XAMPP MySQL username
$password = "";      // Default XAMPP MySQL password is empty
$dbname = "job_app";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read incoming JSON data from the frontend
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is received
if ($data) {
    $email = $data['email'];
    $password = $data['password'];

    // Prepare SQL query to fetch user data by email
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind the email parameter

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $stored_password);
    $stmt->fetch();

    // Check if email exists in the database
    if ($stmt->num_rows > 0) {
        // Verify the password
        if (password_verify($password, $stored_password)) {
            // Successful login
            echo json_encode(['success' => true, 'message' => 'Login successful!']);
        } else {
            // Invalid password
            echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        }
    } else {
        // Email not found
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data received.']);
}
?>
