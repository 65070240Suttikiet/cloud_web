<?php
    $db = new SQLite3('../../db/table.db');
    if (!$db) {
    echo $db->lastErrorMsg();
    exit();
    }
    $name = $_GET['course']; // สมมติว่าค่า name มาจาก GET request
    $sql = "DELETE FROM Course WHERE name = :name";
    // เตรียมคำสั่ง SQL และผู้เชื่อมโยงค่า
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    // ประมวลผลคำสั่ง SQL
    $result = $stmt->execute();
if ($result) {
    echo "ลบคอร์ส $name เรียบร้อยแล้ว";
} else {
    echo "เกิดข้อผิดพลาดในการลบคอร์ส $name";
}
$next_page = "dashboard.php";
header("Location: $next_page");
exit();