<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// ตรวจสอบว่ามีการส่งคำตอบผ่านฟอร์มหรือไม่
if (isset($_POST['add_answer'])) {
    // รับค่าคำตอบจากฟอร์ม
    $answer_text = $_POST['answer_box'];

    // รับค่า qa_id จากฟอร์ม
    $qa_id = $_GET['qaid'];

    // เตรียมคำสั่ง SQL สำหรับ update คำตอบในตาราง QnA
    $sql = "UPDATE QnA SET answer_text = :answer_text WHERE qa_id = :qa_id";

    // เตรียมคำสั่ง SQL และผู้เชื่อมโยงค่า
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':answer_text', $answer_text, SQLITE3_TEXT);
    $stmt->bindValue(':qa_id', $qa_id, SQLITE3_INTEGER);

    // ประมวลผลคำสั่ง SQL
    $result = $stmt->execute();

    // ตรวจสอบการ update ว่าสำเร็จหรือไม่
    if ($result) {
        echo "คำตอบถูกเพิ่มเข้าสู่ระบบแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มคำตอบลงในระบบ";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $db->close();
}
$next_page = "question.php";
header("Location: $next_page");
exit();
?>
