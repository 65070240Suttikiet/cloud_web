<?php
session_start(); // เริ่ม session ในไฟล์ทุกไฟล์ที่จำเป็น

if(isset($_POST['submit'])) {
    // ตรวจสอบว่ามี session ชื่อ 'username' หรือไม่
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // เชื่อมต่อกับฐานข้อมูล SQLite
        $db = new SQLite3('../../db/table.db');

        // ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
        if (!$db) {
            echo $db->lastErrorMsg();
            exit();
        }

        // คำสั่ง SQL เพื่อดึง student_id จาก username
        $sql = "SELECT user_id FROM Users WHERE username = '$username';";
        $result = $db->query($sql);
        $row = $result->fetchArray(SQLITE3_ASSOC);
        $student_id = $row['user_id']; // นำ user_id ที่ได้จากฐานข้อมูลไปใช้เป็น student_id

        // รับค่าข้อมูลจากฟอร์ม
        $course_id = $_POST['course'];
        $comment = $_POST['comment']; // รับค่าจาก textarea ที่มีชื่อว่า comment

        // ตรวจสอบว่ามีรีวิวของคอร์สนี้โดยนักเรียนคนนี้อยู่แล้วหรือไม่
        echo $course_id;
        echo $student_id;
        $sql = "UPDATE Enrollment SET review = '$comment' WHERE course_id = 1 AND student_id = 1";
        $result = $db->exec($sql);
    }
}
header("Location: reviewSuccess.php");
exit();     
?>
