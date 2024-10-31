<?php
session_start();
$username = $_SESSION['username'];
$coursename = $_GET['course'];
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
        <a href="dashboard.php" class="logo"
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
        </div>
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

  <!-- Section Course Start -->
  <?php 
  $db = new SQLite3('../../db/table.db');
  if (!$db) {
  echo $db->lastErrorMsg();
  exit();}

  $coursename = $_GET['course'];
  $sql1 = "SELECT * FROM Course  WHERE Course.name = '$coursename'";
  $result = $db->query($sql1);
  $row = $result->fetchArray(SQLITE3_ASSOC);
  ?>
  <section class="courses">
      <h1 class="heading" style="text-align: center">---<?php echo $coursename;?>---</h1>
      <div class="btnbox">
        <a href="#popup2" class="inline-btn">แก้ไขคอร์สเรียน</a>
        <div style="float: right">
          <a href="#popup1" class="inline-btn">เพิ่มบทเรียน</a>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="column">
          <img
            style="border-radius: 10px; width: 100%"
            <?php echo "src=\"data:image/jpeg;base64," . base64_encode($row['courseimage']) . "\"";?>
            alt="Card image cap"
          />
          <br />
          <br />
          <p style="font-size: 20px; font-weight: 500; color: rgb(35, 33, 63)">
            คำบรรยาย
          </p>
          <br />
          <p style="font-size: 18px; color: rgb(55, 54, 71)">
          <?php echo "{$row['description']}";?>
          </p>
        </div>
        <div class="column">
          <p style="font-size: 26px; font-weight: 400">บทเรียน</p>
          <br />
          <div class="box-container">
          <?php
      $sql = "SELECT Chapter.* FROM Chapter JOIN Course ON Chapter.course_id = Course.id WHERE Course.name = '$coursename' ORDER BY Chapter.ChapterNo";
      $result = $db->query($sql);
      while ($row = $result->fetchArray(SQLITE3_ASSOC)){
        echo "
        <div class=\"box\">
        <a href=\"content.php?course=$coursename&ch={$row['chapterNo']}\"><h3 class=\"title\">- บทเรียนที่ {$row['chapterNo']}</h3></a>
        <a class=\"close\" href=\"delChapter.php?course=$coursename&ch={$row['chapterNo']}\">&times;</a>
        </div>
        ";
    }
      ?>
        </div>
      </div>

      <div id="popup1" class="overlay">
        <div class="popup">
          <h3>เพิ่มบทเรียน</h3>
          <a class="close" href="">&times;</a>
          <div class="content">
            <div class="form-container">
              <form action="addChapter.php?course=<?php echo $coursename ?>" method="post" enctype="multipart/form-data">
                <p>บทที่</p>
                <input type="number" name="ChapNum" placeholder="" class="box" />
                <p>ชื่อบทเรียน</p>
                <input type="text" name="Chapname" placeholder="" class="box" />
                <p>ลิงก์วิดีโอ</p>
                <input
                  type="text"
                  name="LinkVideo"
                  placeholder=""
                  class="box"
                />
                <p>คำบรรยาย</p>
                <textarea name="chapDes" class="box" cols="5" rows="5"></textarea>

                <p>ไฟล์</p>
                <input type="file" name="fileToUpload" class="box" />
                <a href="dashboard.php" class="inline-btn">ย้อนกลับ</a>
                <input
                  type="submit"
                  value="เพิ่มบทเรียน"
                  name="submit"
                  class="ans-btn"
                />
              </form>
            </div>
          </div>
        </div>
      </div>

      <div id="popup2" class="overlay">
        <div class="popup">
          <h3>แก้ไขคอร์สเรียน</h3>
          <a class="close" href="">&times;</a>
          <div class="content">
            <div class="form-container">
            <form action="editCourseController.php?course=<?php echo "$coursename";?>" method="post" enctype="multipart/form-data">
            <p>ภาพหน้าปก</p>
            <input type="file" accept="image/*" name="course_image" class="box" />

            <p>ชื่อคอร์สเรียน</p>
            <input
                type="text"
                name="course_name"
                placeholder="old course name"
                maxlength="50"
                class="box"
            />
            <p>คำบรรยาย</p>
            <textarea
                name="course_description"
                class="box"
                placeholder="old description"
                cols="30"
                rows="5"
            ></textarea>
            <a href="dashboard.php" class="inline-btn">ย้อนกลับ</a>
            <input
                type="submit"
                value="ยืนยัน"
                name="submit"
                class="ans-btn"
            />
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Section Course End -->


    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
