<?php
session_start();
include('db_connection.php'); // Include your database connection
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

// Fetch job categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

echo "<h2>Job Categories</h2>";
echo "<div class='categories'>";
foreach ($categories as $category) {
    echo "<button onclick='filterByCategory({$category['id']})'>{$category['name']}</button>";
}
echo "</div>";

echo "<h3>Jobs in this category:</h3>";
// Display jobs based on selected category
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM jobs WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($job = $result->fetch_assoc()) {
        echo "<div class='job-card'>";
        echo "<h3>{$job['title']}</h3>";
        echo "<p>Company: {$job['company']}</p>";
        echo "<button onclick='applyJob({$job['id']})'>Apply</button>";
        echo "</div>";
    }

    $stmt->close();
}

$conn->close();
?>