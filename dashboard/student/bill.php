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
$username = $_GET['user'];
$price = $_GET['price'];
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
    <div class="container-qr">
    <h1>กรุณาชำระเงินผ่าน QR Code</h1>
    <div class="qr-code">
      <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=YOUR_PAYMENT_DATA_HERE" alt="QR Code" />
    </div>
    <br>
    <div class="payment-details">
      <h2>รายละเอียดการชำระเงิน</h2>
      <ul>
        <li>ชื่อบันชี: <strong>Edventure</strong></li>
        <li>ยอดชำระ: <strong><?php echo $price?> บาท</strong></li>
        <li>รหัสคำสั่งซื้อ: <strong>1234567890</strong></li>
      </ul>
    </div>


    <div class="container-slip">
  <form action="updateEnroll.php" method="POST" enctype="multipart/form-data" id="uploadForm">
    <br />
    <div class="form-group-slip">
      <label for="slipImage">อัพโหลดสลิปใบเสร็จ:</label>
      <!-- แก้ไขชื่อองค์ประกอบของฟอร์มให้ตรงกับการใช้งาน -->
      <input type="hidden" id="coursename" name="coursename" value="<?php echo $coursename; ?>"/>
      <!-- แก้ไขชื่อองค์ประกอบของฟอร์มให้ตรงกับการใช้งาน -->
      <input type="hidden" id="username" name="username" value="<?php echo $current_user->getUsername(); ?>"/>
      <!-- แก้ไขชื่อองค์ประกอบของฟอร์มให้ตรงกับการใช้งาน -->
      <input type="hidden" id="status" name="status" value="0"/>
      <!-- ปุ่มยืนยันต้องอยู่ภายใน tag form -->
      <input type="file" id="slipImage" name="slipImage" accept="image/*" required />
    </div>
    <!-- ย้ายปุ่มยืนยันไปอยู่ใน tag form -->
    <br>
    <input type="submit" value="ยืนยัน" name="submit" class="ans-btn-detail" />
  </form>

  <div class="preview-slip">
    <img src="#" alt="Slip Preview" id="imagePreview" style="display: none" />
  </div>
</div>
  <section class="courses"></section>
    <!-- Section Course End -->
    
    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
