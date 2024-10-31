<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="1.detail.css"> -->
    <title>Register</title>
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
        <a href="" class="logo"
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
            <a href="register" class="option-btn">ลงทะเบียน</a>
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
        <a href="unauth.php"><i class="fas fa-home"></i><span>หน้าหลักผู้ใช้</span></a>
        <a href="t_courses.html"
          ><i class="fas fa-graduation-cap"></i><span>คอร์สของเรา</span></a
        >
        >
      </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Section Course Start -->

    <!-- Section Course End -->

    <section class="form-container">
            <form id="register-form" action="acc.php" method="post" enctype="multipart/form-data">
              <h3>ฟอร์มสมัครคอร์ส</h3>
              <p>ชื่อผู้ใช้:</p>
              <input type="text" name="username" placeholder="ชื่อผู้ใช้" class="box" required />
  
              <p>รหัสผ่าน:</p>
              <input type="password" name="password" placeholder="รหัสผ่าน" class="box" required />

              <p>อีเมล์:</p>
              <input type="email" name="email" placeholder="อีเมล์" class="box" required/>

              <label>บทบาท:</label><br>
                    <input class="form-check-input" type="radio" name="role" id="instructor" value="instructor">
                    <label class="form-check-label" for="instructor">ผู้สอน</label>
                    <input class="form-check-input" type="radio" name="role" id="student" value="student">
                    <label class="form-check-label" for="student">นักเรียน</label>

              <p>ข้อมูลการติดต่อ:</p>
              <input type="text" name="contact" placeholder="กรอกข้อมูลการติดต่อ" class="box" />

              <button><a href="login.php">กลับไปยังหน้าเข้าสู่ระบบ</a></button>
              <button><input type="submit" value="ยืนยัน" name="submit" class="ans-btn-two"/></button>
              
        </form>
    </section>
    <script src="../js/scripts.js"></script>
  </body>
</html>

<?php
if(isset($_SESSION['error'])) {
    $username = $_SESSION['username'];
    echo '<script>
    const RegisterContainer = document.getElementById("register-form");
    const errorMessage = document.createElement("h1");
    errorMessage.textContent = "เหมือนว่าจะมีชื่อผู้ใช้อยู่แล้วนะ";
    RegisterContainer.appendChild(errorMessage);
    </script>';
    // หลังจากแสดงข้อความแล้ว ควรลบตัวแปร session ข้อผิดพลาดออก
    unset($_SESSION['error']);
}
?>