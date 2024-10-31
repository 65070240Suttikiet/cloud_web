<?php
// เริ่ม session
session_start();

// ลบทุก session variable
session_unset();

// ทำลาย session
session_destroy();

// Redirect ไปหน้าอื่นหรือทำอะไรต่อได้ตามที่ต้องการ
header("Location: ../../index.php");
exit();
?>
