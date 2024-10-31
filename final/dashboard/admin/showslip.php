<?php
// Connect to SQLite database
$db = new SQLite3('../../db/table.db');

// Check if the ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Get the enrollment ID from the URL
    $enrollmentId = $_GET['id'];

    // Retrieve the slip data from the database based on the enrollment ID
    $stmt = $db->prepare("SELECT slip FROM Enrollment WHERE id = :enrollmentId");
    $stmt->bindValue(':enrollmentId', $enrollmentId, SQLITE3_INTEGER);
    $result = $stmt->execute();

    // Fetch the slip data
    $row = $result->fetchArray();

    // Check if the slip data is found
    if($row) {
        // Output the slip image
        header('Content-Type: image/jpeg');
        echo $row['slip'];
    } else {
        // Slip data not found, display an error message
        echo "Slip image not found.";
    }
} else {
    // ID parameter not provided, display an error message
    echo "Enrollment ID not provided.";
}
?>
