<?php
session_start();
require("function.php");
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

if(isset($_POST['logout'])){
  session_destroy();
  unset($_POST);
  header("Location: " . $_SERVER['PHP_SELF']);

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>pitoelastan</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logohutri.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

    <a class="logo d-flex align-items-center me-auto me-xl-0">
      <h1 class="sitename">Pitoelast</h1><span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.php#home" class="active">Home</a></li>
        <li><a href="index.php#portfolio">Daftar Lomba</a></li>
        <li><a href="index.php#lomba">Dashboard Perlombaan</a></li>
       
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <?php if(isset($_SESSION['user_name'])) : ?>
      <div class="" style="display:flex; ">
      <div class="btn-getstarted"><?= $_SESSION['user_name'] ?></div>
        <a href="logout.php" class="btn-getstarted">Logout</a>
      </div>

  
    <?php else : ?>
    <a class="btn-getstarted" href="login.php">Login</a>
    <?php endif; ?>

  </div>
</header>

  <main class="main">

    <!-- Hero Section -->
    <section id="home" class="hero section dark-background">

      <img src="assets/img/bghome.png" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">Selamat Datang di Desa Sahara</h2>
            <p data-aos="fade-up" data-aos-delay="200">Semangat 45! Untuk memeriahkan kegiatan desa</p>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

      <!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">



<!-- Judul Bagian -->
<div class="container section-title" style="text-align: center; padding: 20px;" data-aos="fade-up">
  <h2>Daftar Lomba</h2>
  <p>Ini adalah lomba yang diadakan oleh karang taruna desa Sahara</p>
</div><!-- Akhir Judul Bagian -->

<div class="container">

  <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

    <!-- Lomba Makan Kerupuk -->
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
      <img src="assets/img/lomba/mk.png" style="width: 100%; height: 300px; object-fit: cover;" alt="">
      <div class="portfolio-info" style="text-align: center; padding: 10px;">
        <h4>Makan Kerupuk</h4>
        <p>Kategori: Anak-Anak</p>
        <a href="assets/img/lomba/mk.png" title="untuk tk, sd" data-gallery="portfolio-gallery" class="glightbox preview-link"></a>
        <br>
        <form action="dashboardpeserta.php" method="POST" style="margin-top: 10px;">
          <input type="hidden" name="event" value="Makan Kerupuk">
          <input type="hidden" name="category" value="Anak-Anak">
          <button type="submit" class="btn btn-primary">Daftar Lomba</button>
        </form>
      </div>
    </div><!-- Akhir Portfolio Item -->

    <!-- Lomba Eggrang -->
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
      <img src="assets/img/lomba/egg.png" style="width: 100%; height: 300px; object-fit: cover;" alt="">
      <div class="portfolio-info" style="text-align: center; padding: 10px;">
        <h4>Eggrang</h4>
        <p>Kategori: Remaja</p>
        <a href="assets/img/lomba/egg.png" title="untuk smp" data-gallery="portfolio-gallery" class="glightbox preview-link"></a>
        <br>
        <form action="dashboardpeserta.php" method="POST" style="margin-top: 10px;">
          <input type="hidden" name="event" value="Eggrang">
          <input type="hidden" name="category" value="Remaja">
          <button type="submit" class="btn btn-primary">Daftar Lomba</button>
        </form>
      </div>
    </div><!-- Akhir Portfolio Item -->

    <!-- Lomba Tarik Tambang -->
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
      <img src="assets/img/lomba/tt.png" style="width: 100%; height: 300px; object-fit: cover;" alt="">
      <div class="portfolio-info" style="text-align: center; padding: 10px;">
        <h4>Tarik Tambang</h4>
        <p>Kategori: Dewasa</p>
        <a href="assets/img/lomba/tt.png" title="untuk sma dan ibu/bapak" data-gallery="portfolio-gallery" class="glightbox preview-link"></a>
        <br>
        <form action="dashboardpeserta.php" method="POST" style="margin-top: 10px;">
          <input type="hidden" name="event" value="Tarik Tambang">
          <input type="hidden" name="category" value="Dewasa">
          <button type="submit" class="btn btn-primary">Daftar Lomba</button>
        </form>
      </div>
    </div><!-- Akhir Portfolio Item -->

    <!-- Lomba Pensil Dalam Botol -->
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
      <img src="assets/img/lomba/pdb.png" style="width: 100%; height: 300px; object-fit: cover;" alt="">
      <div class="portfolio-info" style="text-align: center; padding: 10px;">
        <h4>Pensil Dalam Botol</h4>
        <p>Kategori: Anak-Anak</p>
        <a href="assets/img/lomba/pdb.png" title="untuk tk, sd" data-gallery="portfolio-gallery" class="glightbox preview-link"></a>
        <br>
        <form action="dashboardpeserta.php" method="POST" style="margin-top: 10px;">
          <input type="hidden" name="event" value="Pensil Dalam Botol">
          <input type="hidden" name="category" value="Anak-Anak">
          <button type="submit" class="btn btn-primary">Daftar Lomba</button>
        </form>
      </div>
    </div><!-- Akhir Portfolio Item -->

    <!-- Lomba Balap Karung -->
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
      <img src="assets/img/lomba/bk.png" style="width: 100%; height: 300px; object-fit: cover;" alt="">
      <div class="portfolio-info" style="text-align: center; padding: 10px;">
        <h4>Balap Karung</h4>
        <p>Kategori: Remaja</p>
        <a href="assets/img/lomba/bk.png" title="untuk smp" data-gallery="portfolio-gallery" class="glightbox preview-link"></a>
        <br>
        <form action="dashboardpeserta.php" method="POST" style="margin-top: 10px;">
          <input type="hidden" name="event" value="Balap Karung">
          <input type="hidden" name="category" value="Remaja">
          <button type="submit" class="btn btn-primary">Daftar Lomba</button>
        </form>
      </div>
    </div><!-- Akhir Portfolio Item -->

    <!-- Lomba Panjat Pinang -->
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
      <img src="assets/img/lomba/pp.png" style="width: 100%; height: 300px; object-fit: cover;" alt="">
      <div class="portfolio-info" style="text-align: center; padding: 10px;">
        <h4>Panjat Pinang</h4>
        <p>Kategori: Dewasa</p>
        <a href="assets/img/lomba/pp.png" title="untuk sma dan ibu/bapak" data-gallery="portfolio-gallery" class="glightbox preview-link"></a>
        <br>
        <form action="dashboardpeserta.php" method="POST" style="margin-top: 10px;">
          <input type="hidden" name="event" value="Panjat Pinang">
          <input type="hidden" name="category" value="Dewasa">
          <button type="submit" class="btn btn-primary">Daftar Lomba</button>
        </form>
      </div>
    </div><!-- Akhir Portfolio Item -->

  </div>

</div>
</section>

<section id=lomba>
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
      <h2 class="mb-4">Pensil Dalam Botol</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
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
    <div class="container mt-5">
      <h2 class="mb-4">Eggrang</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
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
  </div>
</section>

    
        </div>

      </div>

    </section>

    <!-- <section id="team" class="team section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Kami, Yang membuat website ini :D</p>
      </div>

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="assets/img/team/anin.jpeg" class="img-fluid" alt="">
              
            </div>
            <div class="member-info text-center">
              <h4>Anindya Anjarasti</h4>
              <span>03/XII PPLG 1</span>
            </div>
          </div> End Team Member --><!--

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="200">
            <div class="member-img">
              <img src="assets/img/team/pasya.jpeg" class="img-fluid" alt="">
            
            </div>
            <div class="member-info text-center">
              <h4>Aspasya Salsabila</h4>
              <span>04/XII PPLG 1</span>
            </div>
          </div> End Team Member 

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="300">
            <div class="member-img">
              <img src="assets/img/team/scl.jpeg" class="img-fluid" alt="">
              <div class="social">
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info text-center">
              <h4>Chellondira Septriyansa</h4>
              <span>09/XII PPLG 1</span>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
            <div class="member-img">
              <img src="assets/img/team/eka.jpeg" class="img-fluid" alt="">
             
            </div>
            <div class="member-info text-center">
              <h4>Eka Septiana Dewi</h4>
              <span>12/XII PPLG 1</span>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="500">
            <div class="member-img">
              <img src="assets/img/team/yuma.jpeg" class="img-fluid" alt="">
             
            </div>
            <div class="member-info text-center">
              <h4>Zahra Gilang Yumayahsa</h4>
              <span>33/XII PPLG 1</span>
            </div>
          </div>
          </div>

        </div>
      </div>
    </section> -->
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="sitename">pitoelast</strong> <span>Desa Sahara</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>