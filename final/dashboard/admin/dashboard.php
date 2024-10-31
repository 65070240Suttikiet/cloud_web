<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<a href="..\instructor\signoutHandle.php" class="btn btn-danger">Logout</a>
<div class="container mt-5">
    <h1 class="mb-4">Enrollment Management</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Course ID</th>
            <th>Student ID</th>
            <th>Status</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Connect to SQLite database
        $db = new SQLite3('../../db/table.db');

        // Retrieve all data from Enrollment table
        $query = "SELECT * FROM Enrollment";
        $result = $db->query($query);

        // Display data in table
        while ($row = $result->fetchArray()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['course_id'] . "</td>";
            echo "<td>" . $row['student_id'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            // Display image as a link
            echo "<td><a href='showslip.php?id=" . $row['id'] . "' target='_blank'>View Image</a></td>";
            echo "<td>";
            // Update Status Button
            echo "<a href='update_status.php?id=" . $row['id'] . "&status=" . ($row['status'] == 1 ? 0 : 1) . "' class='btn btn-primary btn-sm'>" . ($row['status'] == 1 ? "Deactivate" : "Activate") . "</a>";
            // Delete Row Button
            echo "<a href='delete_enrollment.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm ms-2'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

