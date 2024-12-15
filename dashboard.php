<?php
session_start();
include('db_connection.php'); // Include your database connection
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch recommended jobs
$sql = "SELECT * FROM jobs WHERE isRecommended = 1";
$result = $conn->query($sql);
$jobs = [];

while ($row = $result->fetch_assoc()) {
    $jobs[] = $row;
}

echo "<h2>Welcome to your Dashboard</h2>";
echo "<p>Here are some recommended jobs for you:</p>";
foreach ($jobs as $job) {
    echo "<div class='job-card'>";
    echo "<h3>{$job['title']}</h3>";
    echo "<p>Company: {$job['company']}</p>";
    echo "<p>Location: {$job['location']}</p>";
    echo "<button onclick='applyJob({$job['id']})'>Apply</button>";
    echo "</div>";
}

$conn->close();
?>
