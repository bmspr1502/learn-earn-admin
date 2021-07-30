<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin' && isset($_SESSION['admin_id'])) {
  header('Location: admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login to admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Scaffold - v4.3.0
  * Template URL: https://bootstrapmade.com/scaffold-bootstrap-metro-style-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <?php include 'navbar.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="../index.php">Home</a></li>
          <li>Admin</li>
        </ol>
        <h2>Admin Login</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col">
            <p>As of now for production time being<br>Admin_id: 1<br>password: 123456</p>
            <form action="index.php" method="post" id='adminlogin'>
              <div class="form-group">
                <label for="adminid">Admin Id:</label>
                <input type="text" name="admin_id" class="form-control" placeholder="Enter admin_id" id="admin_id">
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" id="password">
              </div>

              <input type="submit" class="btn btn-primary" value="Sign In">
              <p id='aresult'></p>
            </form>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script>
    $(document).ready(function() {
      $('#adminlogin').submit(function(event) {
        event.preventDefault();

        var formValues = $(this).serialize();
        console.log(formValues);

        $.post("api/login_check.php", formValues, function(data) {
          // Display the returned data in browser
          $('#aresult').html(data);
          //alert(data);
        });
      });
    });
  </script>
  <!-- ======= Footer ======= -->

  <?php include 'footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>