<?php
  session_start();
  require("function.php");
  $succesAdd = false;
  verifyUser(true);
  $gagalAdd = false;
  if(isset($_POST["event"]) && isset($_POST["category"])){
    $event = $_POST['event'];
    $category = $_POST['category'];
    $lomba = query("SELECT * FROM lomba WHERE nama_lomba = '$event'");
    $lomba = mysqli_fetch_assoc($lomba);
    $idUser = $_SESSION['user_id'];
    $idLomba = $lomba['id_lomba'];

    $result = query("INSERT INTO data_lomba (id_user, id_lomba, status) VALUES ('$idUser', '$idLomba', 'belum')");

    if($result){
      $succesAdd = true;
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    }else{
      $gagalAdd = true;

    }


  }


  $dataLomba = query("SELECT 
    data_lomba.id_user, 
    user.nama_user, 
    lomba.nama_lomba, 
    lomba.kategori, 
    data_lomba.status
FROM data_lomba
LEFT JOIN user ON data_lomba.id_user = user.id_user
LEFT JOIN lomba ON data_lomba.id_lomba = lomba.id_lomba
");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pitoelast Admin Dashboard</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logohutri.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    /* General Layout */
    body {
      font-family: 'Open Sans', sans-serif;
    }

    .header {
      background-color: maroon; /* Latar belakang maroon */
      color: white; /* Teks putih */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Tambahan bayangan */
      padding: 10px 0; /* Padding pada header */
      position: fixed; /* Fixed header */
      width: 100%; /* Full width */
      top: 0; /* Atas halaman */
      z-index: 1000; /* Pastikan di atas elemen lain */
    }

    .header .logo {
      color: white; /* Teks logo putih */
    }

    .header .logo h1 {
      margin: 0; /* Menghilangkan margin */
    }

    .header .navmenu {
      display: flex;
      align-items: center;
      justify-content: flex-end; /* Pastikan tombol navigasi di sebelah kanan */
    }

    .header .navmenu a {
      color: maroon; /* Teks maroon pada item menu default */
      background-color: white; /* Latar belakang putih untuk semua item menu */
      padding: 15px 20px; /* Padding untuk memperbesar area klik */
      border-radius: 5px; /* Sudut membulat */
      text-decoration: none; /* Menghilangkan underline */
      font-weight: 500; /* Menebalkan font */
      transition: background-color 0.3s, color 0.3s; /* Transisi halus saat hover */
      margin-right: 10px; /* Jarak antar item menu */
    }

    .header .navmenu a.active {
      background-color: white; /* Latar belakang putih untuk item aktif */
      color: black; /* Teks hitam untuk item aktif */
      border: 2px solid black; /* Border hitam untuk item aktif */
    }

    .header .navmenu a:hover {
      background-color: #f0f0f0; /* Warna latar belakang saat hover */
      color: black; /* Teks hitam saat hover */
    }

    .main-content {
      margin-top: 80px; /* Memberikan ruang untuk header yang fixed */
      padding: 20px;
    }

    .table thead th {
      background-color: maroon; /* Latar belakang header tabel */
      color: white; /* Teks header tabel */
    }

    .btn-getstarted {
      background-color: white;
      color: black;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s, color 0.3s;
    }

    .btn-getstarted:hover {
      background-color: #f0f0f0;
      color: black;
    }
  </style>
</head>
<body class="index-page">

  <!-- Header -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-1">
        <h1 class="sitename">Pitoelast</h1><span>.</span>
      </a>
      <nav id="navmenu" class="navmenu">
        <a class="btn-getstarted" href="index.php#home">Home</a>
      </nav>
    </div>
  </header>
    <?php
      if($succesAdd) :
    ?>
      <script>
        alert("berhasil mengikuti lomba");
      </script>
      <?php
      endif;
    ?>
    <?php
      if($gagalAdd) :
    ?>
      <script>
        alert("gagal mengikuti lomba");
      </script>
    <?php
      endif;
    ?>
  <!-- Main Content -->
  <div class="main-content">
    <div class="container mt-5">
      <h2 class="mb-4">Tarik Tambang</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i= 0;
              foreach($dataLomba as $lomba) :
                if($lomba['nama_lomba'] == "Tarik Tambang") :
              $i++;
            ?>
            <tr>
              
              <th scope="row"><?= $i; ?></th>
              <td><?= $lomba['nama_user']; ?></td>
              <td><?= $lomba['nama_lomba']; ?></td>
              <td><span class="badge bg-success"><?= $lomba['status']; ?></span></td>
            </tr>
            <?php
                endif;
              endforeach;
            ?>
            
          </tbody>
        </table>
      </div>
    </div>

    <div class="container mt-5">
      <h2 class="mb-4">Makan Kerupuk</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $i= 0;
              foreach($dataLomba as $lomba) :
                if($lomba['nama_lomba'] == "Makan Kerupuk") :
              $i++;
            ?>
            <tr>
              
              <th scope="row"><?= $i; ?></th>
              <td><?= $lomba['nama_user']; ?></td>
              <td><?= $lomba['nama_lomba']; ?></td>
              <td><span class="badge bg-success"><?= $lomba['status']; ?></span></td>
            </tr>
            <?php
                endif;
              endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="container mt-5">
      <h2 class="mb-4">Eggrang</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $i= 0;
              foreach($dataLomba as $lomba) :
                if($lomba['nama_lomba'] == "Eggrang") :
              $i++;
            ?>
            <tr>
              
              <th scope="row"><?= $i; ?></th>
              <td><?= $lomba['nama_user']; ?></td>
              <td><?= $lomba['nama_lomba']; ?></td>
              <td><span class="badge bg-success"><?= $lomba['status']; ?></span></td>
            </tr>
            <?php
                endif;
              endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="container mt-5">
      <h2 class="mb-4">Balap Karung</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $i= 0;
              foreach($dataLomba as $lomba) :
                if($lomba['nama_lomba'] == "Balap Karung") :
              $i++;
            ?>
            <tr>
              
              <th scope="row"><?= $i; ?></th>
              <td><?= $lomba['nama_user']; ?></td>
              <td><?= $lomba['nama_lomba']; ?></td>
              <td><span class="badge bg-success"><?= $lomba['status']; ?></span></td>
            </tr>
            <?php
                endif;
              endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="container mt-5">
      <h2 class="mb-4">Panjat Pinang</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $i= 0;
              foreach($dataLomba as $lomba) :
                if($lomba['nama_lomba'] == "Panjat Pinang") :
              $i++;
            ?>
            <tr>
              
              <th scope="row"><?= $i; ?></th>
              <td><?= $lomba['nama_user']; ?></td>
              <td><?= $lomba['nama_lomba']; ?></td>
              <td><span class="badge bg-success"><?= $lomba['status']; ?></span></td>
            </tr>
            <?php
                endif;
              endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="container mt-5">
      <h2 class="mb-4">Pensil Dalam Botol</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $i= 0;
              foreach($dataLomba as $lomba) :
                if($lomba['nama_lomba'] == "Pensil Dalam Botol") :
              $i++;
            ?>
            <tr>
              
              <th scope="row"><?= $i; ?></th>
              <td><?= $lomba['nama_user']; ?></td>
              <td><?= $lomba['nama_lomba']; ?></td>
              <td><span class="badge bg-success"><?= $lomba['status']; ?></span></td>
            </tr>
            <?php
                endif;
              endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>
