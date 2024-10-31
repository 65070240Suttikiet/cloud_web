Welcome
<?php
// เริ่ม session หากยังไม่เริ่ม
session_start();
include('../class/user.php');

// ตัวอย่างการเช็คค่าใน session
if(isset($_SESSION['username'])) {
    echo 'ค่าของ username ใน session คือ: ' . $_SESSION['username'];
} else {
    echo 'ไม่มีค่าใน session';
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$contact = $_SESSION['contact'] ; 

$current_user = new User($username, $email, $password, $role, $contact);
$current_user->showObjectData();



if ($current_user->getRole() == 'student'){
    header("Location: student/booking.php");
    exit();
}elseif ($current_user->getRole() == 'instructor'){
    header("Location: instructor/dashboard.php");
    exit(); // ใส่ exit() เพื่อให้โปรแกรมหยุดการทำงานทันทีหลังจากส่ง header ไปยังหน้าใหม่
}elseif ($current_user->getRole() == 'admin') {
    header("Location: admin/dashboard.php");
    exit();
}