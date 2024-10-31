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
    $price = $row['price'];
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
    <section class="form">
      <div class="box-container" style="margin: auto; background-color: var(--white);
      border-radius: 0.5rem;
      padding: 2rem;
      width: 50rem;">
         <h3 style="text-align: center;" class="heading">สรุปรายการ</h1>
          <div class="row">
            <div class="column" style="float: left;
            width: 50%;
            padding: 10px;">
              <h2 style="font-size: 20px;">รายการ</h2>
              <p style="font-size: 15px;"><?php echo $coursename ?></p>
            </div>
            <div class="column" style="text-align: right">
              <h2 style="font-size: 20px;">ราคา</h2>
              <p style="font-size: 15px;"><?php echo $row['price'] ?></p>
            </div>
          </div>

        <div class="box1">
            <p style="font-size: 16px; font-weight: 300;">รายละเอียดผู้จองคอร์ส</p>
            <p><?php echo "Username : $username";?></p>
        </div>
        <br>
            <div class="money" style="float: right; font-size: 18px;">
                <p><?php echo $row['price'] ?></p>
            </div>
<br><br>

        <div class="more-btn">
            <a href="bill.php?<?php echo"course=$coursename&user=$username&price=$price";?>" class="inline-option-btn">ยืนยัน</a>
        </div>
      </div>
        

    </section>
    <!-- Section Course End -->

    <!-- custom js file link  -->
    <script src="../../js/scripts.js"></script>
  </body>
</html>
