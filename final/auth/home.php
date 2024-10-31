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
    <link rel="stylesheet" href="css/styles.css" />
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
        <a href=""><i class="fas fa-home"></i><span>หน้าหลักผู้ใช้</span></a>
        <a href="unauth.php"
          ><i class="fas fa-graduation-cap"></i><span>คอร์สของเรา</span></a
        >
      </nav>
    </div>
    <!-- Sidebar End -->
    <!-- Section Course Start -->
    <section class="courses"></section>
    <!-- Section Course End -->

    <!-- custom js file link  -->

    <!-- Slideshow container -->
    <div class="slideshow-container">
      <!-- Full-width images with number and caption text -->
      <div class="mySlides fade">
        <div class="numbertext"></div>
        <img src="images/1.jpg" style="width: 100%" />
      </div>

      <div class="mySlides fade">
        <div class="numbertext"></div>
        <img src="images/2.jpg" style="width: 100%" />
      </div>

      <div class="mySlides fade">
        <div class="numbertext"></div>
        <img src="images/3.jpg" style="width: 100%" />
      </div>

      <div class="mySlides fade">
        <div class="numbertext"></div>
        <img src="images/4.jpg" style="width: 100%" />
      </div>

      <div class="mySlides fade">
        <div class="numbertext"></div>
        <img src="images/5.jpg" style="width: 100%" />
      </div>

      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br />

    <!-- The dots/circles -->
    <div style="text-align: center">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
      <br /><br />
    </div>

    <div class="bannerdetail">
      <h1>เข้ามหาลัยดังต้องที่EdVentureกวดวิชายืนหนึ่ง ที่พึ่งทุกสนามสอบ</h1>
      <br />
      <h2>
        “เก็บคะแนนหมด ไม่สนว่าโจทย์ไหน” ทุกคนทำได้ ถ้ามี“พื้นฐานที่แข็งแรง”<br />
        ได้เวลาเก็บเกรดกับครูเทพ เทคนิคเพียบ ระบบดีไม่มีพื้นฐานก็เข้าใจได้แน่นอน
        <br />
      </h2>
      <br />
      <br />
    </div>
    <div class="image_hover">
      <div class="responsive">
        <div class="gallery">
          <a target="_blank" href="images/6.jpg">
            <img src="images/6.jpg" alt="Cinque Terre" />
          </a>
          <div class="desc">
            <h3>เรียนสดที่สาขา</h3>
          </div>
        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
          <a target="_blank" href="images/7.jpg">
            <img src="images/7.jpg" alt="Forest" />
          </a>
          <div class="desc">
            <h3>Anywhere</h3>
          </div>
        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
          <a target="_blank" href="images/8.jpg">
            <img src="images/8.jpg" alt="Northern Lights" />
          </a>
          <div class="desc">
            <h3>เรียนที่สาขา</h3>
          </div>
        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
          <a target="_blank" href="images/9.jpg">
            <img src="images/9.jpg" alt="Mountains" />
          </a>
          <div class="desc">
            <h3>เรียนออนไลน์</h3>
          </div>
        </div>
      </div>
    </div>
    <!-- Section Course End -->

    <!-- custom js file link  -->
    <script src="js/scripts.js"></script>
  </body>
</html>
