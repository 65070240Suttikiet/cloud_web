<?php
session_start();
class MyDB extends SQLite3 {
   function __construct() {
      $this->open('../db/table.db');
   }
   
} 


$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];
$contact = $_POST['contact'];


$db = new MyDB();
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// เตรียมคิวรี่ SQL
$sql = "SELECT * FROM Users WHERE username = '$username';";

// เรียกใช้คิวรี่ SQL
$result = $db->query($sql);
$row = $result->fetchArray(SQLITE3_ASSOC);
if ($row['username'] == $username){
    $_SESSION['error'] = 2;
    $next_page = "login.php";
    header("Location: $next_page");
    exit();
}else{

    $sql = "INSERT INTO Users (username, email, password, role, contact_info) VALUES ('$username', '$email', '$password', '$role', '$contact')";    
    // สั่งให้ฐานข้อมูล SQLite3 ทำงานคำสั่ง SQL
    print_r($sql);
    $result = $db->exec($sql);

    // ตรวจสอบว่าคำสั่ง SQL ทำงานสำเร็จหรือไม่
    if($result) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $db->lastErrorMsg();
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล SQLite3
    $db->close();
    
    $next_page = "login.php";
    header("Location: $next_page");
    session_destroy();
    exit();
}
