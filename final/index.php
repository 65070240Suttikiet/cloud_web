<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LMS Home</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">EdVenture</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">หน้าหลัก <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">รีวิว คอร์ส</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">เกี่ยวกับเรา</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">ติตด่อ</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Content -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h2>ยินดีต้นรับเข้าสู่เว็บไซต์ทางการของเรา</h2>
      <p>EdVenture: ผสมผสานคำว่า "Education" และ "Adventure" สื่อถึงการเรียนรู้ที่สนุกสนานและน่าตื่นเต้น</p>
      <a href="auth/home.php" class="btn btn-primary">เริ่มสำรวจกับ Edventure</a>
    </div>
    <div class="col-md-6">
      <!-- You can add an image here -->
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">© 2024 Edventure. All rights reserved.</span>
  </div>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
