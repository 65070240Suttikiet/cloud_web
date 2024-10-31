<?php
// Connect to SQLite database
$db = new SQLite3('../../db/table.db');

// Retrieve ID parameter from URL
$id = $_GET['id'];

// Delete the row from the database
$query = "DELETE FROM Enrollment WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$result = $stmt->execute();

// Close the database connection
$db->close();

// Redirect back to the admin dashboard
header('Location: dashboard.php');
exit();
?>
