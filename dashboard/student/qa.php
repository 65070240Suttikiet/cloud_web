<?php
session_start();
$coursename = $_GET['course'];
$ch = $_GET['ch'];

// เชื่อมต่อฐานข้อมูล
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}
$sql = "SELECT creator_id, id FROM Course WHERE name = :coursename";

// เตรียมคำสั่ง SQL และผู้เชื่อมโยงค่า
$stmt = $db->prepare($sql);
$stmt->bindValue(':coursename', $coursename, SQLITE3_TEXT);

// ประมวลผลคำสั่ง SQL
$result = $stmt->execute();

// ดึงข้อมูล instructor_id และ course_id จากผลลัพธ์
$row = $result->fetchArray(SQLITE3_ASSOC);
$instructor_id = $row['creator_id'];
$course_id = $row['id'];


$username = $_SESSION['username'];
// ค้นหา userid จาก username ในตาราง Users
$username = $_SESSION['username'];
$sql_userid = "SELECT user_id FROM Users WHERE username = :username";
$stmt_userid = $db->prepare($sql_userid);
$stmt_userid->bindValue(':username', $username, SQLITE3_TEXT);
$result_userid = $stmt_userid->execute();
$row_userid = $result_userid->fetchArray(SQLITE3_ASSOC);
$student_id = $row_userid['user_id'];

// ตรวจสอบว่ามีการส่งคำถามผ่านฟอร์มหรือไม่
if (isset($_POST['add_comment'])) {
    // รับค่าคำถามจากฟอร์ม
    $question_text = $_POST['comment_box'];

    // เตรียมคำสั่ง SQL สำหรับ insert คำถามลงในตาราง QnA
    $sql = "INSERT INTO QnA (instructor_id, student_id, question_text, course_id, creation_date) 
            VALUES (:instructor_id, :student_id, :question_text, :course_id, datetime('now'))";

    // เตรียมคำสั่ง SQL และผู้เชื่อมโยงค่า
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':instructor_id', $instructor_id, SQLITE3_INTEGER);
    $stmt->bindValue(':student_id', $student_id, SQLITE3_INTEGER);
    $stmt->bindValue(':question_text', $question_text, SQLITE3_TEXT);
    $stmt->bindValue(':course_id', $course_id, SQLITE3_INTEGER);

    // ประมวลผลคำสั่ง SQL
    $result = $stmt->execute();

    // ตรวจสอบการ insert ว่าสำเร็จหรือไม่
    if ($result) {
        echo "คำถามถูกเพิ่มเข้าสู่ระบบแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มคำถามลงในระบบ";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $db->close();
    header("Location: chapter.php?course=$coursename&ch=$ch");
    exit();
}
?>
