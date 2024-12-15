<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// SQL query to fetch saved jobs
$sql = "SELECT job_title AS title, company_name AS company, application_date AS date FROM job_applications WHERE user_id = ?";
$stmt = $conn->prepare($sql);

$user_id = 1; // Assume user ID is 1 for this example
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$applications = [];

// Fetch results into an array
while ($row = $result->fetch_assoc()) {
    $applications[] = $row;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return JSON-encoded data
echo json_encode($applications);
?>
