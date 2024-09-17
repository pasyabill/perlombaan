<?php
session_start(); // Memulai session

require("function.php");
verifyAdmin(false);
if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name'])) {
  header("location: dashboardadmin.php");
}
// Koneksi ke database
// Sesuaikan dengan nama database Anda
$WrongPass = false;
$noUserName = false;

// Memproses form login ketika di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    
  

    // Mengambil data user dari database
    $sql = "SELECT * FROM user WHERE nama_user = '$name' AND role = 'admin'";
    $result = query($sql);

    if ($result->num_rows > 0) {
        // Memeriksa password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password cocok, membuat sesi
            $_SESSION['admin_id'] = $row['id_user'];
            $_SESSION['admin_name'] = $row['nama_user'];
            if($_POST['remember']){
              setcookie("admin_name", $row['nama_user'], time() + (7 * 24 * 60 * 60));
              setcookie("admin_pass", $row['password'], time() + (7 * 24 * 60 * 60));
            }
            // Redirect ke halaman dashboard atau halaman lain yang diinginkan
            header("Location: dashboardadmin.php");
            exit();
        } else {
            // Password salah
            $WrongPass = true;
        }
    } else {
        // User tidak ditemukan
       $noUserName = true;
    }
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logohutri.png" rel="icon">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for social icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="assets/img/loginn.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">
          <!--<div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>

            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>-->

          <!--<div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>-->

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Nama</label>
            <input type="text" name="name" id="form3Example3" class="form-control form-control-lg"
              placeholder="Namamu" />
            <?php 
            if($noUserName) :
              ?>

            <p style="color: red">Username Tidak Ditemukan</p>
              <?php
              endif;
              ?>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
          <label class="form-label"  for="form3Example4">Password</label>
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Masukkan Password" />
              <?php 
            if($WrongPass) :
              ?>

            <p style="color: red">Password Salah</p>
              <?php
              endif;
              ?>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="true" name="remember" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Ingatkan Saya
              </label>
            </div>
            
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
  <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-lg"
    style="padding-left: 2.5rem; padding-right: 2.5rem;">
    Login
  </button>
</div>


        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-danger">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2024. Kelompok Sahara.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    
    <!-- Right -->
  </div>
</section>

<style>
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }

  .h-custom {
    height: calc(100% - 73px);
  }

  @media (max-width: 450px) {
    .h-custom {
      height: 100%;
    }
  }
</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
