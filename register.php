<?php
include 'connection.php'; // Sertakan file connection.php untuk koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    echo "Nama: " . $nama . "<br>";
    echo "Role: " . $role . "<br>";

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (nama_user, password, role) VALUES ('$nama', '$hashed_password', 'peserta')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil!";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Register Form</title>
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
        <img src="assets/img/loginn.jpg" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="">
          <!-- Nama input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Nama</label>
            <input type="text" id="form3Example3" name="nama" class="form-control form-control-lg"
              placeholder="Namamu" required />
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Buat Password</label>
            <input type="password" id="form3Example4" name="password" class="form-control form-control-lg"
              placeholder="Masukkan Password" required />
          </div>

          <!-- Konfirmasi Password -->
          <div data-mdb-input-init class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Konfirmasi Password</label>
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Masukkan Password" required />
          </div>

          <!-- Dropdown Role -->
         
          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Ingatkan Saya
              </label>
            </div>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">
              Register
            </button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Kembali ke halaman utama <a href="index.php" class="link-danger">Home</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-danger">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2024. Kelompok Sahara.
    </div>
    <!-- Right -->
  </div>
</section>

<style>
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
