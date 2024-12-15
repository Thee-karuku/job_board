<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password is empty
$dbname = "job_app"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from GET request
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare SQL query to fetch jobs based on the search query
$sql = "SELECT * FROM jobs WHERE title LIKE ? OR location LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%$searchQuery%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Return results as JSON
$jobs = [];
while ($row = $result->fetch_assoc()) {
    $jobs[] = $row;
}

echo json_encode($jobs);

// Close the connection
$stmt->close();
$conn->close();
?>
