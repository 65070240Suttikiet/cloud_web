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
        <a href="home.php" class="logo"
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
    <section class="courses">
      <div class="btnbox">
        <h1 class="heading">คอร์สเรียนของฉัน</h1>
        <!-- <a href="t_EditCourses.html" class="inline-btn">แก้ไขคอร์สเรียน</a> -->
        <a href="#popup1" class="inline-btn">เพิ่มคอร์สเรียน</a>
      </div>
      <br />
      <br />
      <br />
      <div class="box-container">
      <?php 
      $db = new SQLite3('../../db/table.db');

      if (!$db) {
          echo $db->lastErrorMsg();
          exit();
      }
      $sql = "SELECT * FROM Course 
        WHERE creator_id = (SELECT user_id FROM Users WHERE username = '$username')
        ORDER BY date_created DESC;"; // เรียงลำดับตามวันที่สร้างล่าสุดขึ้นไป
      $result = $db->query($sql);
      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "
        <div class=\"box\">
            <a class=\"close\" href=\"delCourse.php?course={$row['name']}\">&times;</a>
            <div class=\"tutor\">
                <img src=\"../../images/user.png\" alt=\"\" />
                <div class=\"info\">
                    <h3>$username</h3>
                    <span>{$row['date_created']}</span>
                </div>
            </div>
            <div class=\"thumb\">
                <img src=\"data:image/jpeg;base64," . base64_encode($row['courseimage']) . "\" alt=\"\" />
            </div>
            <a href=\"chapter.php?course={$row['name']}\"><h3 class=\"title\">{$row['name']}</h3></a>
        </div>";
      }        
      ?>

        <div id="popup1" class="overlay">
        <div class="popup">
          <h3>เพิ่มคอร์สเรียน</h3>
          <a class="close" href="">&times;</a>
          <div class="content">
            <div class="form-container">
              <form action="addCourseController.php" method="post" enctype="multipart/form-data">
                <p>เลือกภาพหน้าปก</p>
                <input type="file" name="course-image" accept="image/*" class="box" />

                <p>ชื่อคอร์สเรียน</p>
                <input type="text" name="course-name" placeholder="" class="box" />
                <p>คำบรรยาย</p>
                <textarea name="description" class="box" cols="5" rows="5"></textarea>
                <p>ตั้งราคา</p>
                <input type="number" name="price"class="box" />
                <!-- <a href="t_courses.html" class="inline-btn">Back</a> -->
                <input
                  type="submit"
                  value="เพิ่มคอร์สเรียน"
                  name="submit"
                  class="ans-btn"
                />
              </form>
            </div>
          </div>
        </div>
      </div>

      
    </section>
    <!-- Section Course Start -->
    <!-- Section Course End -->

    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
