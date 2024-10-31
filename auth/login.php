<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="1.detail.css"> -->
    <title>User : Log in</title>
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
        <a href="unauth.php"><i class="fas fa-home"></i><span>หน้าหลักผู้ใช้</span></a>
        <a href="unauth.php"
          ><i class="fas fa-graduation-cap"></i><span>คอร์สของเรา</span></a>
      </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Section Course Start -->

    <!-- Section Course End -->

    <section class="form-container">
      <form id="login-form" action="auth.php" method="post" enctype="multipart/form-data">
        <h3>เข้าสู่ระบบ</h3>
        <p>ชื่อผู้ใช้:</p>
        <input
          type="text"
          name="username"
          placeholder="Enter your username"
          class="box"
          required
        />

        <p>รหัสผ่าน:</p>
        <input
          type="password"
          name="password"
          placeholder="Enter your Password"
          class="box"
          required
        />

        <div class="buttom">
          <button>เข้าสู่ระบบ</button>
        <p>ยังไม่มีบัญชี ? <a href="register.php"><span>ลงทะเบียน</span></a></p>
      </div>
        
      </form>
    </section>
    <script src="../js/scripts.js"></script>
  </body>
</html>

<?php
if(isset($_SESSION['error']) && $_SESSION['error'] == 1) {
    echo '<script>
    const loginContainer = document.getElementById("login-form");
    const errorMessage = document.createElement("h2");
    errorMessage.textContent = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    loginContainer.appendChild(errorMessage);
    </script>';
    // หลังจากแสดงข้อความแล้ว ควรลบตัวแปร session ข้อผิดพลาดออก
    unset($_SESSION['error']);
} elseif (isset($_SESSION['error']) && $_SESSION['error'] == 2) {
    echo '<script>
    const loginContainer = document.getElementById("login-form");
    const errorMessage = document.createElement("h2");
    errorMessage.textContent = "ชื่อผู้ใช้มีอยู่แล้วล็อคอินเลย";
    loginContainer.appendChild(errorMessage);
    </script>';
    unset($_SESSION['error']);
}
?>