<?php
session_start();

// เชื่อมต่อฐานข้อมูล SQLite
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// รับค่า coursename และ chapterno จาก URL
$coursename = $_GET['course'];
$chapterno = $_GET['ch'];

// ลบบทเรียนจากตาราง Chapter
$sql = "DELETE FROM Chapter WHERE course_id = (SELECT id FROM Course WHERE name = '$coursename') AND chapterNo = $chapterno";
$result = $db->exec($sql);

if ($result) {
    echo "ลบบทเรียนเรียบร้อยแล้ว";
} else {
    echo "เกิดข้อผิดพลาดในการลบบทเรียน: " . $db->lastErrorMsg();
}

// ปิดการเชื่อมต่อฐานข้อมูล
$db->close();
header("Location: chapter.php?course=$coursename");
exit;
