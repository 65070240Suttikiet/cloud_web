<?php
// เชื่อมต่อกับฐานข้อมูล SQLite
$db = new SQLite3('../../db/table.db');

// ตรวจสอบว่ามีการส่งไฟล์ภาพมาหรือไม่
if(isset($_FILES['slipImage']) && $_FILES['slipImage']['error'] === UPLOAD_ERR_OK) {
    // อ่านไฟล์ภาพเข้ามาเพื่อแปลงเป็น binary
    $slipBinary = file_get_contents($_FILES['slipImage']['tmp_name']);
} else {
    // หากไม่มีการส่งไฟล์ภาพมาหรือเกิดข้อผิดพลาดในการอัพโหลด
    die('เกิดข้อผิดพลาดในการอัพโหลดไฟล์ภาพ');
}

// ดึงค่าที่ส่งมาจาก POST
$coursename = $_POST['coursename'];
$username = $_POST['username'];
$status = $_POST['status'];

// ค้นหา ID ของคอร์สจากชื่อ
$stmt = $db->prepare("SELECT id FROM Course WHERE name = :coursename");
$stmt->bindValue(':coursename', $coursename, SQLITE3_TEXT);
$result = $stmt->execute();
$courseRow = $result->fetchArray(SQLITE3_ASSOC);
$course_id = $courseRow['id'];
echo "$course_id";

// ค้นหา ID ของนักเรียนจากชื่อผู้ใช้
$stmt = $db->prepare("SELECT user_id FROM Users WHERE username = :username");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();
$userRow = $result->fetchArray(SQLITE3_ASSOC);
$student_id = $userRow['user_id'];
echo "$student_id";

// เตรียมคำสั่ง SQL เพื่อ insert ข้อมูลลงในตาราง Enrollment
$sql = "INSERT INTO Enrollment (course_id, student_id, status, slip) VALUES (:course_id, :student_id, :status, :slip)";
$stmt = $db->prepare($sql);
$stmt->bindValue(':course_id', $course_id, SQLITE3_INTEGER);
$stmt->bindValue(':student_id', $student_id, SQLITE3_INTEGER);
$stmt->bindValue(':status', $status, SQLITE3_INTEGER);
$stmt->bindValue(':slip', $slipBinary, SQLITE3_BLOB); // นำ binary ของรูปภาพมาเก็บลงในฐานข้อมูล
$result = $stmt->execute();

// ปิดการเชื่อมต่อฐานข้อมูล
$db->close();

// ให้ผู้ใช้ทำการเปลี่ยนเส้นทางหลังจากอัพเดต
header("Location: success.php");
exit();
?>
