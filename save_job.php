<?php
// save_job.php
include('db_connection.php');

// Get data from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$job_id = $data['job_id'];
$user_id = 1; // Ideally, get from session or authentication

// Prepare the SQL statement
$sql = "INSERT INTO saved_jobs (user_id, job_id, saved_at) VALUES (?, ?, NOW())";
$stmt = $pdo->prepare($sql);

// Execute the statement
if ($stmt->execute([$user_id, $job_id])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save job']);
}
?>
