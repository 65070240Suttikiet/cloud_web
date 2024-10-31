<?php
session_start();
include("../../class/student.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$contact = $_SESSION['contact'] ; 

$current_user = new Student($username, $email, $password, $role, $contact);
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>นักเรียน</title>

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
        <a href="dashboard.php" class="logo"
          ><i class="fa-solid fa-book-open"></i> EdVenture</a
        >

        <div class="icons">
          <div id="menu-btn" class="fas fa-bars" onclick="MenuClick()"></div>
          <div id="user-btn" class="fas fa-user" onclick="ProfileClick()"></div>
        </div>

        <div class="profile">
          <h3 class="name"></h3>
          <p class="role">นักเรียน</p>
          <div class="flex-btn">
          <a href="signoutHandle.php" class="option-btn">ออกจากระบบ</a>
          </div>
        </div>
      </section>
    </header>
    <!-- Header End -->
 
    <?php
    $coursename = $_GET['course'];
    $sql = "SELECT * FROM Course WHERE name = '$coursename'";
    $result = $db->query($sql);
    $row = $result->fetchArray(SQLITE3_ASSOC);
    ?>
    <!-- Sidebar Start -->
    <div class="side-bar">
      <div class="profile">
        <img src="../../images/user.png" class="image" alt="" />
        <a href="profile.html"><h3 class="name"><?php echo $current_user->getUsername();?></h3></a>
        <p class="role">นักเรียน</p>
      </div>

      <nav class="navbar">
        <a href="profile.php"
          ><i class="fas fa-home"></i><span>หน้าหลัก</span></a
        >
        <a href="dashboard.php"
          ><i class="fa-solid fa-book-bookmark"></i><span>คอร์สเรียน</span></a
        >
        <a href="booking.php"
          ><i class="fas fa-graduation-cap"></i><span>จองคอร์สเรียน</span></a
        >
        <a href="check_demo.php"
          ><i class="fa-solid fa-cart-shopping"></i><span>สรุปรายการ</span></a
        >
        <a href="question.php"
          ><i class="fa-solid fa-question"></i><span>Q&A</span></a
        >
        <a href="review.php"
          ><i class="fa-solid fa-star"></i><span>รีวิว</span></a
        >
      </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Section Course Start -->
    <div class="container">
        <div class="top-detail">
            <h2>รายละเอียดคอร์ส</h2>
            <h3><?php echo $coursename; ?></h3>
        </div>
        <div class="detail">
            <p>
            <?php echo $row['description']; ?></p>
        </div>
        <div class="img">
            <img src=<?php echo "\"data:image/jpeg;base64," . base64_encode($row['courseimage']) . "\""; ?> alt="รูปภาพ">
        </div>
        <div class="details">
            <div>
                <div class="img-leg">
                  <img src="../../images/long.png" alt="รูปภาพ">
                </div>
                <h3>ความยาววิดีโอ</h3>
                <p>32.5 ชม.</p>
            </div>
            <div>
              <div class="img-leg">
                <img src="../../images/hour.png" alt="รูปภาพ">
              </div>
                <h3>ชั่วโมงที่เรียนได้</h3>
                <p>36 ชม.</p>
            </div>
            <div>
              <div class="img-leg">
                <img src="../../images/age.png" alt="รูปภาพ">
              </div>
                <h3>อายุคอร์ส</h3>
                <p>8 เดือน</p>
            </div>
        </div>
        <br>
        <div style="display: flex;
        justify-content: center;">
        <a href="course_transac.php?course=<?php echo $coursename ?>">
          <input
            type="submit"
            value="จองคอร์สเรียน"
            class="ans-btn"
            name="booking_course"
          />
          </a>
        </div>
        <br>
        <br>
        <br>
        <?php
        $sql = "SELECT Users.username, Enrollment.review
        FROM Enrollment
        INNER JOIN Users ON Enrollment.student_id = Users.user_id
        INNER JOIN Course ON Enrollment.course_id = Course.id
        WHERE Course.name = '$coursename';
        ";

        $result = $db->query($sql);
        while($row = $result->fetchArray(SQLITE3_ASSOC)){
          echo "
          <div class=\"review-box\">
          <div class=\"user-name\">รีวิวจากผู้ที่เคยเรียน: {$row['username']}</div>
          <div class=\"review-text\">
              <p>{$row['review']}</p>
          </div>
          ";
        }
        ?>
        <div class="review-box">
            <div class="user-name">รีวิวจากผู้ที่เคยเรียน: มุติง</div>
            <div class="review-text">
                <p>เรียนสนุก เพิ่มความเข้าใจ ไม่ใช่แค่ท่องจำ พร้อมรบทุกสนามสอบ</p>
            </div>
        </div>
        <input type="submit" value="จองคอร์ส" class="ans-btn-two"/>
    </div>
    <!-- Section Course End -->

    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
