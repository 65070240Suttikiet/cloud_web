<?php
// Connect to SQLite database
$db = new SQLite3('../../db/table.db');

// Retrieve parameters from URL
$id = $_GET['id'];
$status = $_GET['status'];

// Update status in the database
$query = "UPDATE Enrollment SET status = :status WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindValue(':status', $status, SQLITE3_INTEGER);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$result = $stmt->execute();

// Close the database connection
$db->close();

// Redirect back to the admin dashboard
header('Location: dashboard.php');
exit();
?>
