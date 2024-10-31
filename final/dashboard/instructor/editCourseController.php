<?php
// เชื่อมต่อกับฐานข้อมูล
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// ตรวจสอบการส่งค่า course_id ผ่าน URL
if (!isset($_GET['course'])) {
    echo "ไม่พบรหัสคอร์ส";
    exit();
}

$course = $_GET['course'];

// เรียกข้อมูลของคอร์สเรียนจากฐานข้อมูล
$sql_select = "SELECT * FROM Course WHERE name = :course";
$stmt_select = $db->prepare($sql_select);
$stmt_select->bindValue(':course', $course, SQLITE3_TEXT);
$result_select = $stmt_select->execute();

$row = $result_select->fetchArray(SQLITE3_ASSOC);

// ตรวจสอบว่าค้นพบข้อมูลหรือไม่
if (!$row) {
    echo "ไม่พบข้อมูลคอร์สเรียน";
    exit();
}

// เก็บชื่อคอร์สเรียน
$course_name = $row['name'];

// ตรวจสอบว่ามีการส่งค่าฟอร์มมาหรือไม่
if (isset($_POST['submit'])) {
    // รับค่าจากฟอร์ม
    $new_course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    // อัปโหลดไฟล์รูปภาพ
    $course_image = file_get_contents($_FILES['course_image']['tmp_name']);

    // เตรียมคำสั่ง SQL UPDATE
    $sql = "UPDATE Course
            SET name = :new_course_name,
                description = :course_description,
                courseimage = :course_image
            WHERE name = :course";

    // เตรียมคำสั่ง SQL และผู้เชื่อมโยงค่า
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':new_course_name', $new_course_name, SQLITE3_TEXT);
    $stmt->bindValue(':course_description', $course_description, SQLITE3_TEXT);
    $stmt->bindValue(':course_image', $course_image, SQLITE3_BLOB);
    $stmt->bindValue(':course', $course, SQLITE3_TEXT);

    // ประมวลผลคำสั่ง SQL
    $result = $stmt->execute();

    // ตรวจสอบการอัปเดตว่าสำเร็จหรือไม่
    if ($result) {
        echo "อัปเดตข้อมูลคอร์สเรียนสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูลคอร์สเรียน";
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $db->close();
}
$next_page = "dashboard.php";
header("Location: $next_page");
exit();


