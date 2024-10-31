<?php
class MyDB extends SQLite3 {
   function __construct() {
      $this->open('../db/table.db');
   }
   
} 

$db = new MyDB();
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

echo $username." ".$password;
$sql = "SELECT * FROM Users WHERE username = '$username' AND password = '$password';";

// เรียกใช้คิวรี่ SQL
$result = $db->query($sql);
$row = $result->fetchArray(SQLITE3_ASSOC);
print_r($row);

if ($row['username'] == $username && $row['password'] == $password){
    echo "ล็อคอินสำเร็จ";
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['email'] = $row['email'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['contact'] = $row['contact_info']; 
    $next_page = "../dashboard/dashboardController.php";
    header("Location: $next_page");
    exit();
}else {
    session_start();
    $_SESSION['error'] = true;
    $next_page = "login.php";
    header("Location: $next_page");
    exit();
}

$db->close();