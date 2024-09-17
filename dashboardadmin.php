<?php
session_start();
require("function.php");

verifyAdmin(true);

// Daftar peserta (biasanya ini diambil dari database)


$dataLomba = query("SELECT 
data_lomba.id_user, 
data_lomba.id_data_lomba, 
user.nama_user, 
lomba.nama_lomba, 
lomba.kategori, 
data_lomba.status
FROM data_lomba
LEFT JOIN user ON data_lomba.id_user = user.id_user
LEFT JOIN lomba ON data_lomba.id_lomba = lomba.id_lomba
");


// Fungsi untuk menangani aksi tombol
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];
        
    if ($action == 'hapus') {
      $queryL = "DELETE FROM data_lomba WHERE id_data_lomba = '$id'";
      query($queryL);
      header("location: " . $_SERVER["PHP_SELF"]);
    } elseif ($action == 'pemenang') {
      $queryL = "UPDATE data_lomba SET status = 'menang' WHERE id_data_lomba = '$id'";
      query($queryL);
      header("location: " . $_SERVER["PHP_SELF"]);

    } elseif ($action == 'kalah') {
      $queryL = "UPDATE data_lomba SET status = 'kalah' WHERE id_data_lomba = '$id'";
      query($queryL);
      header("location: " . $_SERVER["PHP_SELF"]);

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pitoelast</title>
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
    /* CSS untuk header */
    .header {
        background-color: maroon;  /* Latar belakang maroon */
        color: white;              /* Teks putih */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);  /* Tambahan bayangan */
        padding: 10px 0; /* Padding pada header */
    }

    .header .navmenu {
        display: flex;
        align-items: center;
    }

    .header .navmenu a {
        color: maroon; /* Teks maroon pada item menu default */
        background-color: white; /* Latar belakang putih untuk semua item menu */
        padding: 10px 20px; /* Padding untuk memperbesar area klik */
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

    .container {
        padding-top: 80px; /* Memberikan ruang untuk header yang fixed */
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

    .table td button {
        margin-right: 5px; /* Jarak antar tombol */
    }
  </style>
</head>
<body class="index-page">

  <!-- Header -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Pitoelast</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <a class="btn-getstarted" href="index.php#home">Home</a>
        <?php if(isset($_SESSION['admin_name'])) : ?>
      <div class="" style="display:flex; ">
        <a href="logoutAdmin.php" class="btn-getstarted">Logout</a>
      </div>

  
    <?php endif; ?>
    
 

  
 
      </nav>
     

    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="mt-5">
      <h2 class="mb-4">Tarik Tambang</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $num=0; foreach($dataLomba as $peserta) :
              if($peserta['nama_lomba'] == "Tarik Tambang") :
              $bg = "bg-secondary";
              switch ($peserta['status']) {
                case 'kalah':
                  $bg = "bg-danger";
                  break;
                case 'menang':
                  $bg = "bg-success";
                  break;
                default:
                  $bg = "bg-secondary";
                  break;
              }
               $num++ ?>
            <tr>
              <th scope="row"><?= $num ?></th>
              <td><?= $peserta['nama_user'] ?></td>
              <td><?= $peserta['nama_lomba'] ?></td>
              <td><span class="badge <?= $bg ?>"><?= $peserta['status'] ?></span></td>
              <td class="d-flex">
                <form action="" method="POST" class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="hapus">
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="pemenang">
                  <button class="btn btn-success btn-sm">Pemenang</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="kalah">
                  <button class="btn btn-secondary btn-sm">Kalah</button>

                </form>
              </td>
            </tr>
            <?php endif; endforeach; ?>
            
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-5">
      <h2 class="mb-4">Makan Kerupuk</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $num=0; foreach($dataLomba as $peserta) :
              if($peserta['nama_lomba'] == "Makan Kerupuk") :
              $bg = "bg-secondary";
              switch ($peserta['status']) {
                case 'kalah':
                  $bg = "bg-danger";
                  break;
                case 'menang':
                  $bg = "bg-success";
                  break;
                default:
                  $bg = "bg-secondary";
                  break;
              }
               $num++ ?>
            <tr>
              <th scope="row"><?= $num ?></th>
              <td><?= $peserta['nama_user'] ?></td>
              <td><?= $peserta['nama_lomba'] ?></td>
              <td><span class="badge <?= $bg ?>"><?= $peserta['status'] ?></span></td>
              <td class="d-flex">
                <form action="" method="POST" class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="hapus">
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="pemenang">
                  <button class="btn btn-success btn-sm">Pemenang</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="kalah">
                  <button class="btn btn-secondary btn-sm">Kalah</button>

                </form>
              </td>
            </tr>
            <?php endif; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-5">
      <h2 class="mb-4">Eggrang</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $num=0; foreach($dataLomba as $peserta) :
              if($peserta['nama_lomba'] == "Eggrang") :
              $bg = "bg-secondary";
              switch ($peserta['status']) {
                case 'kalah':
                  $bg = "bg-danger";
                  break;
                case 'menang':
                  $bg = "bg-success";
                  break;
                default:
                  $bg = "bg-secondary";
                  break;
              }
               $num++ ?>
            <tr>
              <th scope="row"><?= $num ?></th>
              <td><?= $peserta['nama_user'] ?></td>
              <td><?= $peserta['nama_lomba'] ?></td>
              <td><span class="badge <?= $bg ?>"><?= $peserta['status'] ?></span></td>
              <td class="d-flex">
                <form action="" method="POST" class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="hapus">
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="pemenang">
                  <button class="btn btn-success btn-sm">Pemenang</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="kalah">
                  <button class="btn btn-secondary btn-sm">Kalah</button>

                </form>
              </td>
            </tr>
            <?php endif; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-5">
      <h2 class="mb-4">Pensil Dalam Botol</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $num=0; foreach($dataLomba as $peserta) :
              if($peserta['nama_lomba'] == "Pensil Dalam Botol") :
              $bg = "bg-secondary";
              switch ($peserta['status']) {
                case 'kalah':
                  $bg = "bg-danger";
                  break;
                case 'menang':
                  $bg = "bg-success";
                  break;
                default:
                  $bg = "bg-secondary";
                  break;
              }
               $num++ ?>
            <tr>
              <th scope="row"><?= $num ?></th>
              <td><?= $peserta['nama_user'] ?></td>
              <td><?= $peserta['nama_lomba'] ?></td>
              <td><span class="badge <?= $bg ?>"><?= $peserta['status'] ?></span></td>
              <td class="d-flex">
                <form action="" method="POST" class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="hapus">
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="pemenang">
                  <button class="btn btn-success btn-sm">Pemenang</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="kalah">
                  <button class="btn btn-secondary btn-sm">Kalah</button>

                </form>
              </td>
            </tr>
            <?php endif; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-5">
      <h2 class="mb-4">Makan Kerupuk</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $num=0; foreach($dataLomba as $peserta) :
              if($peserta['nama_lomba'] == "Makan Kerupuk") :
              $bg = "bg-secondary";
              switch ($peserta['status']) {
                case 'kalah':
                  $bg = "bg-danger";
                  break;
                case 'menang':
                  $bg = "bg-success";
                  break;
                default:
                  $bg = "bg-secondary";
                  break;
              }
               $num++ ?>
            <tr>
              <th scope="row"><?= $num ?></th>
              <td><?= $peserta['nama_user'] ?></td>
              <td><?= $peserta['nama_lomba'] ?></td>
              <td><span class="badge <?= $bg ?>"><?= $peserta['status'] ?></span></td>
              <td class="d-flex">
                <form action="" method="POST" class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="hapus">
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="pemenang">
                  <button class="btn btn-success btn-sm">Pemenang</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="kalah">
                  <button class="btn btn-secondary btn-sm">Kalah</button>

                </form>
              </td>
            </tr>
            <?php endif; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-5">
      <h2 class="mb-4">Balap Karung</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $num=0; foreach($dataLomba as $peserta) :
              if($peserta['nama_lomba'] == "Balap Karung") :
              $bg = "bg-secondary";
              switch ($peserta['status']) {
                case 'kalah':
                  $bg = "bg-danger";
                  break;
                case 'menang':
                  $bg = "bg-success";
                  break;
                default:
                  $bg = "bg-secondary";
                  break;
              }
               $num++ ?>
            <tr>
              <th scope="row"><?= $num ?></th>
              <td><?= $peserta['nama_user'] ?></td>
              <td><?= $peserta['nama_lomba'] ?></td>
              <td><span class="badge <?= $bg ?>"><?= $peserta['status'] ?></span></td>
              <td class="d-flex">
                <form action="" method="POST" class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="hapus">
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="pemenang">
                  <button class="btn btn-success btn-sm">Pemenang</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="kalah">
                  <button class="btn btn-secondary btn-sm">Kalah</button>

                </form>
              </td>
            </tr>
            <?php endif; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-5">
      <h2 class="mb-4">Panjat Pinang</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Perlombaan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $num=0; foreach($dataLomba as $peserta) :
              if($peserta['nama_lomba'] == "Panjat Pinang") :
              $bg = "bg-secondary";
              switch ($peserta['status']) {
                case 'kalah':
                  $bg = "bg-danger";
                  break;
                case 'menang':
                  $bg = "bg-success";
                  break;
                default:
                  $bg = "bg-secondary";
                  break;
              }
               $num++ ?>
            <tr>
              <th scope="row"><?= $num ?></th>
              <td><?= $peserta['nama_user'] ?></td>
              <td><?= $peserta['nama_lomba'] ?></td>
              <td><span class="badge <?= $bg ?>"><?= $peserta['status'] ?></span></td>
              <td class="d-flex">
                <form action="" method="POST" class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="hapus">
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="pemenang">
                  <button class="btn btn-success btn-sm">Pemenang</button>
                </form>
                <form action="" method="POST"  class="w-fit" >
                  <input type="hidden" name="id" value="<?= $peserta['id_data_lomba'] ?>">
                  <input type="hidden" name="action" value="kalah">
                  <button class="btn btn-secondary btn-sm">Kalah</button>

                </form>
              </td>
            </tr>
            <?php endif; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-1L2Tn7F9s6iP0cK1oVZB3bV7l5RU0wnOq5HusF0sRa9B9Rr5G9KwH/61oS6i7tRr" crossorigin="anonymous"></script>

</body>
</html>
