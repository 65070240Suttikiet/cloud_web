<?php
session_start();
include("../../class/instructor.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$contact = $_SESSION['contact'] ; 

$current_user = new Instructor($username, $email, $password, $role, $contact);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ผู้สอน</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    />
    <!-- <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet"
    /> -->

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../css/styles.css" />
  </head>
  <body>
    <!-- Header Start -->
    <header class="header">
      <section class="flex">
        <a href="profile.php" class="logo"
          ><i class="fa-solid fa-book-open"></i> EdVenture</a
        >

        <div class="icons">
          <div id="menu-btn" class="fas fa-bars" onclick="MenuClick()"></div>
          <div id="user-btn" class="fas fa-user" onclick="ProfileClick()"></div>
        </div>

        <div class="profile">
          <h3 class="name"></h3>
          <p class="role">ผู้สอน</p>
          <div class="flex-btn">
          <a href="signoutHandle.php" class="option-btn">ออกจากระบบ</a>
          </div>
        </div>
      </section>
    </header>
    <!-- Header End -->

    <!-- Sidebar Start -->
    <div class="side-bar">
      <div class="profile">
        <img src="../../images/user.png" class="image" alt="" />
        <a href="profile.php"><h3 class="name"><?php echo $current_user->getUsername();?></h3></a>
        <p class="role">ผู้สอน</p>
      </div>

      <nav class="navbar">
        <a href="profile.php"><i class="fas fa-home"></i><span>หน้าหลัก</span></a>
        <a href="dashboard.php"
          ><i class="fas fa-graduation-cap"></i><span>คอร์สของฉัน</span></a
        >
        <a href="question.php"
          ><i class="fa-solid fa-question"></i><span>Q&A</span></a
        >
      </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Section Course Start -->
    <section class="questions">
      <h1 class="heading">Q&A : คำถาม</h1>

    
      <div class="box-container">
      <?php 
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// กำหนดค่าของตัวแปร $username
// เปลี่ยนเป็นชื่อผู้ใช้ที่ต้องการค้นหา

$sql = "SELECT QnA.*, Users.username AS student_username 
        FROM QnA 
        INNER JOIN Users ON QnA.student_id = Users.user_id 
        WHERE QnA.instructor_id = (SELECT user_id FROM Users WHERE username = '$username')";

$result = $db->query($sql);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
  echo "
  <div class=\"box\">
  <div class=\"user\">
    <img src=\"../../images/user.png\" alt=\"\" />
    <div>
      <h3>{$row['student_username']}</h3>
      <span>{$row['creation_date']}</span>
    </div>
  </div>
  <div class=\"question-box\">{$row['question_text']}</div>
  <div class=\"ans-box\">ตอบ : {$row['answer_text']}</div>
  <a href=\"answer.php?qaid={$row['qa_id']}\" class=\"ans-btn\">ตอบคำถาม</a>
</div>
  ";
}

?>

    </section>
    <!-- Section Course End -->

    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
