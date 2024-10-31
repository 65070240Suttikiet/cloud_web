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
$coursename = $_GET['course'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $coursename; ?></title>

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
          <h3 class="name"></h3>
          <p class="role">นักเรียน</p>
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
    <?php 
    $chapterNo = $_GET['ch'];
    $coursename = $_GET['course'];
    $db = new SQLite3('../../db/table.db');
    if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}
    $sql = "SELECT Chapter.* FROM `Chapter` JOIN `Course` ON Chapter.course_id = Course.id WHERE Course.name = '$coursename' AND Chapter.chapterNo = $chapterNo";
    $result = $db->query($sql);
    $row = $result->fetchArray(SQLITE3_ASSOC);
    ?>



    <section class="watch-video">
    <h3 style="font-size: 3rem; font-weight: 600; text-transform: capitalize; color: black; text-align: center;"><?php echo "$coursename : บทเรียนที่ {$row['chapterNo']}" ?></h3><br>
    <div class="video-container">
        <div class="video">
        <iframe width="1124" height="633" src="<?php echo "{$row['link']}"; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <h3 class="title" style="font-size: 25px;"><?php echo "$coursename : {$row['chapterNo']}" ?></h3>
        <div class="info">
           <p class="date"><i class="fas fa-calendar"></i><span>22-10-2022</span></p>
        </div>
        <div class="tutor">
        <a href="material.php?<?php echo"course=$coursename&ch=$chapterNo"; ?>" target="_blank">
        <div>
        <h3 style="font-weight: 500;">เอกสารประกอบการสอน</h3>
        </div>
              </a>
        </div>
    </section>


    <section class="comments">

        <h1 class="heading">ความคิดเห็น</h1>
     
        <form action="qa.php?<?php echo "course=$coursename&ch=$chapterNo"; ?>"  method="post" class="add-comment">
           <h3>ถามคำถาม</h3>
           <textarea name="comment_box" placeholder="พิมพ์คำถามที่สงสัยได้เลย!" required maxlength="1000" cols="30" rows="10"></textarea>
           <input type="submit" value="ถามคำถาม" class="inline-btn" name="add_comment">
        </form>

     
     </section>
    <!-- Section Course End -->
    
    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
