<?php
// ตรวจสอบว่ามีการส่งค่าฟอร์มมาหรือไม่
if (isset($_POST['submit'])) {
    // เชื่อมต่อกับฐานข้อมูล
    $db = new SQLite3('../../db/table.db');
    if (!$db) {
        echo $db->lastErrorMsg();
        exit();
    }

    // ตรวจสอบการส่งค่า course และ ch ผ่าน URL
    if (!isset($_GET['course']) || !isset($_GET['ch'])) {
        echo "ไม่พบรหัสคอร์สหรือบทเรียน";
        exit();
    }

    $coursename = $_GET['course'];
    $ch = $_GET['ch'];

    // รับค่าจากฟอร์ม
    $chapter_name = $_POST['Chapname'];
    $video_link = $_POST['LinkVideo'];
    $description = $_POST['description'];

    // อัปโหลดไฟล์รูปภาพ
    if ($_FILES['file']['size'] > 0) {
        $file_content = file_get_contents($_FILES['file']['tmp_name']);
    } else {
        // หากไม่มีการอัปโหลดไฟล์ ให้เป็นค่าว่าง
        $file_content = null;
    }

    // เตรียมคำสั่ง SQL UPDATE
    $sql = "UPDATE Chapter
            SET name = :chapter_name,
                link = :video_link,
                description = :description,
                file_content = :file_content
            WHERE chapterNo = :chapter_number";

    // เตรียมคำสั่ง SQL และผู้เชื่อมโยงค่า
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':chapter_name', $chapter_name, SQLITE3_TEXT);
    $stmt->bindValue(':video_link', $video_link, SQLITE3_TEXT);
    $stmt->bindValue(':description', $description, SQLITE3_TEXT);
    $stmt->bindValue(':file_content', $file_content, SQLITE3_BLOB);
    $stmt->bindValue(':course_name', $coursename, SQLITE3_TEXT);
    $stmt->bindValue(':chapter_number', $ch, SQLITE3_INTEGER);

    // ประมวลผลคำสั่ง SQL
    $result = $stmt->execute();

    // ปิดการเชื่อมต่อกับฐานข้อมูล

}
header("Location: chapter.php?course=$coursename");
exit; // ต้องใส่ exit เพื่อหยุดการทำงานของสคริปต์หลังจากการ 
