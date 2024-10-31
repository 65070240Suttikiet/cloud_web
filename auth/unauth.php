<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gust</title>

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
    <link rel="stylesheet" href="../css/styles.css" />
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
          <h3 class="name">สวัสดี</h3>
          <p class="role">คุณอยู่ในโหมด Gust</p>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">เข้าสู่ระบบ</a>
            <a href="register.php" class="option-btn">ลงทะเบียน</a>
          </div>
        </div>
      </section>
    </header>
    <!-- Header End -->

    <!-- Sidebar Start -->
    <div class="side-bar">
      <div class="profile">
        <img src="../images/user.png" class="image" alt="" />
        <a href="profile.html"><h3 class="name">ผู้ใช้งานนิรนาม</h3></a>
        <p class="role">ผู้ใช้งานนิรนาม</p>
      </div>

      <nav class="navbar">
        <a href="home.php"><i class="fas fa-home"></i><span>หน้าหลักผู้ใช้</span></a>
        <a href="unauth.php"
          ><i class="fas fa-graduation-cap"></i><span>คอร์สของเรา</span></a
        >
      </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Section Course Start -->
    <section class="courses">
      <h1 class="heading">ดูหลักสูตร</h1>
      <div class="box-container">
      <?php
    $db = new SQLite3('../db/table.db');
    if (!$db) {
    echo $db->lastErrorMsg();
    exit();
    }

    $sql = "SELECT Users.username AS instructor_name, Course.date_created AS course_created_time, Course.name AS course_name, Course.description AS course_description, Course.price AS course_price
    FROM Course
    JOIN Users ON Course.creator_id = Users.user_id;"; // เรียงลำดับตามวันที่สร้างล่าสุดขึ้นไป
    $result = $db->query($sql);
    while($row = $result->fetchArray(SQLITE3_ASSOC)){
      echo "
      <div class=\"box\">
        <div class=\"tutor\">
          <img src=\"../images/user.png\" alt=\"\" />
          <div class=\"info\">
            <h3>{$row['instructor_name']}</h3>
            <span>{$row['course_created_time']}</span>
          </div>
        </div>
        <a href=\"login.php\"><h3 class=\"title\">{$row['course_name']}</h3></a>
        <p>
        {$row['course_description']}
        </p>
        <div class=\"info\">
          <span class=\"price\">ราคา : {$row['course_price']} บาท</span>
        </div>

        <div style=\"float: right\">
        <a href=\"login.php\">
          <input
            type=\"submit\"
            value=\"จองคอร์สเรียน\"
            class=\"ans-btn\"
            name=\"booking_course\"
          />
          </a>
        </div>
      </div>
      ";
    }
    ?>
    </div>
    </section>
    <!-- Section Course End -->

    <!-- custom js file link  -->
    <script src="../js/scripts.js"></script>
  </body>
</html>
