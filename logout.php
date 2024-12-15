<?php
// Start the session
session_start();

// Destroy all session variables and destroy the session
session_unset();
session_destroy();

// Return success message
echo json_encode(['success' => true]);
?>
