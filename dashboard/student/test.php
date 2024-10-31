<?php
// สร้างการเชื่อมต่อฐานข้อมูล SQLite
session_start();
include("../../class/student.php");
$username = $_SESSION['username'];
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// รับค่า username จากการรับค่าหรือตัวแปรอื่นๆ
// คำสั่ง SQL สำหรับค้นหา user_id จาก username
$sql = "SELECT user_id
        FROM Users
        WHERE username = :username";

// เตรียมคำสั่ง SQL
$stmt = $db->prepare($sql);

// Bind ค่าของ parameter :username
$stmt->bindParam(':username', $username, SQLITE3_TEXT);

// ประมวลผลคำสั่ง SQL
$result = $stmt->execute();

// เก็บผลลัพธ์ไว้ในตัวแปร
$row = $result->fetchArray(SQLITE3_ASSOC);
$user_id = $row['user_id'];

// ปิดการเชื่อมต่อฐานข้อมูล SQLite
$db->close();

// แสดงผลลัพธ์
echo "user_id ของผู้ใช้ {$username} คือ: {$user_id}";
?>
