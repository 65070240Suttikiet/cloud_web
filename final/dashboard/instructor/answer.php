<?php
session_start();
$username = $_SESSION['username'];
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}
include("../../class/instructor.php");
$password = $_SESSION['password'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$contact = $_SESSION['contact'] ; 
$current_user = new Instructor($username, $email, $password, $role, $contact);


// เชื่อมต่อฐานข้อมูล
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// รับค่า qa_id จาก URL parameters
$qa_id = $_GET['qaid'];

// คำสั่ง SQL เพื่อดึงข้อมูลคำถามและชื่อผู้เรียน
$sql = "SELECT Q.*, U.username AS student_name 
        FROM QnA AS Q 
        INNER JOIN Users AS U ON Q.student_id = U.user_id 
        WHERE qa_id = :qa_id";

// เตรียมคำสั่ง SQL และผู้เชื่อมโยงค่า
$stmt = $db->prepare($sql);
$stmt->bindValue(':qa_id', $qa_id, SQLITE3_INTEGER);

// ประมวลผลคำสั่ง SQL
$result = $stmt->execute();
$row = $result->fetchArray(SQLITE3_ASSOC);

// ตรวจสอบว่าพบข้อมูลหรือไม่
if (!$row) {
    echo "ไม่พบข้อมูลคำถาม";
    exit();
}

// ดึงข้อมูลจากแถวที่ค้นหาได้
$question_text = $row['question_text'];
$student_name = $row['student_name'];

// ปิดการเชื่อมต่อฐานข้อมูล
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ผู้สอน : ตอบคำถาม</title>

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
        <a href="" class="logo"
          ><i class="fa-solid fa-book-open"></i> EdVenture</a
        >

        <div class="icons">
          <div id="menu-btn" class="fas fa-bars" onclick="MenuClick()"></div>
          <div id="user-btn" class="fas fa-user" onclick="ProfileClick()"></div>
        </div>

        <div class="profile">
          <h3 class="name"><?php echo $username; ?></h3>
          <p class="role">ผู้สอน</p>
          <div class="flex-btn">
          <a href="signoutHandle.php" class="option-btn">ออกจากระบบ</a>
          </div>
        </div>>
      </section>
    </header>
    <!-- Header End -->

    <!-- Sidebar Start -->
    <div class="side-bar">
      <div class="profile">
        <img src="../../images/user.png" class="image" alt="" />
        <a href="profile.html"><h3 class="name"><?php echo $current_user->getUsername();?></h3></a>
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

    <!-- Section Answer Start -->
    <section class="questions">
      <h1 class="heading">Q&A : ตอบคำถาม</h1>

      <div class="box-container">
        <div class="box">
          <div class="user">
            <img src="../../images/user.png" alt="" />
            <div>
              <h3><?php echo "{$row['student_name']}";?></h3>
              <span><?php echo "{$row['creation_date']}";?></span>
            </div>
          </div>
          <div class="question-box"><?php echo "{$row['question_text']}";?></div>

          <div class="answer">
            <form action="updateAns.php?qaid=<?php echo "$qa_id";?>" method="post" class="add-answer">
              <h3>ตอบคำถาม</h3>
              <textarea
                name="answer_box"
                placeholder=""
                required
                maxlength="1000"
                cols="30"
                rows="10"
              ></textarea>
              <a href="question.php" class="inline-btn">ย้อนกลับ</a>
              <input
                type="submit"
                value="ตอบคำถาม"
                class="ans-btn"
                name="add_answer"
              />
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Section Answer End -->

    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
