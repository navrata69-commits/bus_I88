<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promo Menarik | IND'S 88 TRANS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/css/styles.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
 <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"> <img src="assets/img/inds88-logo.png" alt="Logo" width="40" class="me-2"> IND'S 88 TRANS </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/armada-bus">Armada Bus</a></li>
                    <li class="nav-item"><a class="nav-link" href="/paket-wisata">Paket Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="/booking-bus">Booking Bus</a></li>
                    <li class="nav-item"><a class="nav-link" href="/booking-wisata">Booking Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="/promo">Promo</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/tentang-kami">Tentang Kami</a></li>
                </ul> 
                <?php
                use bus\Project\core\Session;

                if (!empty(Session::get('user'))) :
                ?>
                <a href="/profile" 
                        class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 40px; height: 40px;">
                          <i class="bi bi-person fs-5"></i>
                      </a>
                <a href="/pesanan-saya-bus" 
                class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center me-3"
                style="width: 40px; height: 40px;">
                    <i class="bi bi-cart fs-5"></i>
                </a>
                <a href="/logout" class="btn btn-danger">Logout</a>
                <?php else :?>
                    <a href="/login" class="gradient-button btn ms-lg-3">Booking Sekarang</a> </div>
                <?php endif; ?>

        </div>
    </nav>

<!-- Bagian Hero / Intro -->
<section class="py-5 text-center" style="background-color: #ffecec;">
  <div class="container">
    <h2 class="fw-bold text-dark mb-2">
      Tentang <span class="text-danger">IND'S 88 TRANS</span>
    </h2>
    <p class="text-muted mb-5">
      Perusahaan bus wisata terpercaya dengan pengalaman lebih dari 12 tahun melayani perjalanan wisata ke seluruh Indonesia
    </p>

    <div class="row g-4 justify-content-center">
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
          <div class="mb-3">
            <i class="bi bi-people-fill fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold text-dark mb-1">10,000+</h5>
          <p class="text-muted mb-0">Pelanggan Puas</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
          <div class="mb-3">
            <i class="bi bi-geo-alt-fill fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold text-dark mb-1">50+</h5>
          <p class="text-muted mb-0">Destinasi Wisata</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
          <div class="mb-3">
            <i class="bi bi-shield-check fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold text-dark mb-1">12</h5>
          <p class="text-muted mb-0">Tahun Pengalaman</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
          <div class="mb-3">
            <i class="bi bi-award-fill fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold text-dark mb-1">98%</h5>
          <p class="text-muted mb-0">Rating Kepuasan</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Perjalanan Dimulai dari Mimpi -->
<section class="py-5">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <h3 class="fw-bold text-dark mb-3">
          Perjalanan Dimulai dari <span class="text-danger">Mimpi</span>
        </h3>
        <p class="text-muted mb-3">
          IND'S 88 TRANS didirikan pada tahun 2012 dengan visi sederhana namun mulia: 
          <em>“Menghubungkan setiap orang dengan keindahan Indonesia melalui perjalanan yang aman dan berkesan.”</em>
        </p>
        <p class="text-muted mb-3">
          Dimulai dari 2 unit bus dan tim kecil yang penuh semangat, kini kami telah berkembang menjadi perusahaan bus wisata terdepan 
          dengan armada modern dan jaringan destinasi yang luas di seluruh nusantara.
        </p>
        <p class="text-muted">
          Setiap perjalanan bukan hanya sekadar berpindah tempat, tetapi menciptakan pengalaman dan kenangan indah 
          yang akan diingat selamanya. Itulah yang membuat kami terus berinovasi dan memberikan yang terbaik.
        </p>
      </div>

      <div class="col-lg-6 position-relative">
        <img src="assets/img/bus-fleet.jpg" alt="Bus IND'S 88 TRANS" class="img-fluid rounded-4 shadow">
        <div class="position-absolute bottom-0 start-0 bg-danger text-white rounded-3 px-3 py-2 ms-3 mb-3 shadow">
          <small>Sejak 2012</small><br>
          <span class="fw-bold fs-5">12+ Tahun</span><br>
          <small>Pengalaman Terpercaya</small>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Nilai-nilai Kami -->
<section class="py-5" style="background-color: #fff;">
  <div class="container text-center">
    <h3 class="fw-bold mb-2">Nilai-nilai <span class="text-danger">Kami</span></h3>
    <p class="text-muted mb-5">Komitmen kami terhadap excellence dalam setiap aspek pelayanan</p>

    <div class="row g-4 justify-content-center">
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <i class="bi bi-shield-fill-check fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold">Keamanan Terjamin</h5>
          <p class="text-muted mb-0">
            Semua bus dilengkapi asuransi perjalanan dan driver berpengalaman dengan sertifikat resmi.
          </p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <i class="bi bi-heart-fill fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold">Pelayanan Terbaik</h5>
          <p class="text-muted mb-0">
            Customer service 24 jam siap membantu dan memastikan perjalanan Anda berjalan lancar.
          </p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <i class="bi bi-star-fill fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold">Kualitas Prima</h5>
          <p class="text-muted mb-0">
            Armada bus terawat dengan fasilitas modern untuk kenyamanan maksimal.
          </p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <i class="bi bi-bullseye fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold">Tepat Waktu</h5>
          <p class="text-muted mb-0">
            Komitmen punctuality dengan jaminan tepat waktu atau gratis perjalanan berikutnya.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Armada Modern -->
<section class="py-5" style="background-color: #fff5f5;">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <img src="assets/img/bus-interior.jpg" alt="Interior Bus" class="img-fluid rounded-4 shadow">
      </div>
      <div class="col-lg-6">
        <h3 class="fw-bold text-dark mb-3">
          Armada <span class="text-danger">Modern</span> & Terawat
        </h3>
        <p class="text-muted mb-4">
          Seluruh armada kami menggunakan teknologi terkini dan dirawat secara berkala untuk memastikan keamanan dan kenyamanan perjalanan Anda.
        </p>

        <ul class="list-unstyled text-muted mb-4">
          <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>AC full blast dengan filter udara bersih</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>Kursi reclining dengan bantal & selimut</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>WiFi gratis & charging port di setiap kursi</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>Entertainment system & sound system premium</li>
          <li><i class="bi bi-check-circle-fill text-danger me-2"></i>Toilet bersih & air mineral gratis</li>
        </ul>

        <a href="/armada-bus" class="btn btn-danger fw-semibold px-4 py-2 shadow-sm">
          Lihat Armada Lengkap
        </a>
      </div>
    </div>
  </div>
</section>
<!-- Pencapaian & Pengakuan -->
<section class="py-5" style="background-color: #fff5f5;">
  <div class="container text-center">
    <h3 class="fw-bold mb-2">Pencapaian & <span class="text-danger">Pengakuan</span></h3>
    <p class="text-muted mb-5">
      Hasil dari dedikasi dan komitmen terhadap pelayanan terbaik
    </p>

    <div class="row g-4 justify-content-center">
      <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100 text-start p-3">
          <p class="mb-0"><span class="text-danger me-2">•</span>Penghargaan 'Best Travel Service' 2023</p>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100 text-start p-3">
          <p class="mb-0"><span class="text-danger me-2">•</span>Sertifikat ISO 9001:2015 untuk Quality Management</p>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100 text-start p-3">
          <p class="mb-0"><span class="text-danger me-2">•</span>Member resmi ASITA (Association of Indonesian Tours & Travel)</p>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100 text-start p-3">
          <p class="mb-0"><span class="text-danger me-2">•</span>Rating 4.8/5 dari 10.000+ ulasan pelanggan</p>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100 text-start p-3">
          <p class="mb-0"><span class="text-danger me-2">•</span>Zero accident record dalam 5 tahun terakhir</p>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100 text-start p-3">
          <p class="mb-0"><span class="text-danger me-2">•</span>Partnership dengan 200+ hotel dan destinasi wisata</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Siap Memulai Perjalanan -->
<section class="py-5 text-center">
  <div class="container">
    <h3 class="fw-bold text-dark mb-3">Siap Memulai Perjalanan Bersama Kami?</h3>
    <p class="text-muted mb-4">
      Tim customer service kami siap membantu merencanakan perjalanan impian Anda
    </p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="/booking-bus" class="btn gradient-button text-white">Mulai Booking →</a>
        <a href="https://wa.me/+6282230725758" class="btn gradient-button-2 text-white"><i class="bi bi-telephone me-2"></i>Hubungi Kami</a>
    </div>
  </div>
</section>

<footer class="bg-danger text-white pt-5 pb-3">
  <div class="container"> 
    <div class="row gy-4">
      <!-- Kolom 1 -->
      <div class="col-md-5">
        <div class="d-flex align-items-center mb-3">
          <img src="assets/img/inds88-logo.png" alt="Logo" width="40" class="me-2">
          <div>
            <h5 class="mb-0 fw-bold">IND'S 88 TRANS</h5>
            <small>Travel Indonesia</small>
          </div>
        </div>
        <p class="small">
          Perusahaan bus wisata terpercaya dengan lebih dari 10 tahun pengalaman. 
          Kami berkomitmen memberikan layanan perjalanan yang aman, nyaman, dan berkesan 
          ke seluruh destinasi wisata di Indonesia.
        </p>
        <div class="d-flex gap-3 fs-5">
          <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-white"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>

      <!-- Kolom 2 -->
      <div class="col-md-3">
        <h6 class="fw-bold">Menu Utama</h6>
        <ul class="list-unstyled small">
          <li><a href="/" class="text-white text-decoration-none">Beranda</a></li>
          <li><a href="/armada-bus" class="text-white text-decoration-none">Armada Bus</a></li>
          <li><a href="/paket-wisata" class="text-white text-decoration-none">Paket Wisata</a></li>
          <li><a href="/booking-bus" class="text-white text-decoration-none">Booking</a></li>
          <li><a href="/booking-wisata" class="text-white text-decoration-none">Promo</a></li>
          <li><a href="/tentang-kami" class="text-white text-decoration-none">Tentang Kami</a></li>
        </ul>
      </div>

      <!-- Kolom 3 -->
      <div class="col-md-4">
        <h6 class="fw-bold">Kontak Kami</h6>
        <ul class="list-unstyled small">
          <li class="mb-2">
            <i class="bi bi-telephone me-2"></i>
            +62 812-3456-7890<br>
            <small class="ms-4">24 Jam Customer Service</small>
          </li>
          <li class="mb-2">
            <i class="bi bi-envelope me-2"></i>
            info@inds88trans.com<br>
            <small class="ms-4">Booking & Informasi</small>
          </li>
          <li>
            <i class="bi bi-geo-alt me-2"></i>
            Jakarta, Indonesia<br>
            <small class="ms-4">Kantor Pusat</small>
          </li>
        </ul>
      </div>
    </div>
    <hr class="border-light mt-4">
    <div class="text-center small">
      © 2024 IND'S 88 TRANS Travel Indonesia. Semua hak cipta dilindungi.
    </div>
  </div>
</footer>

</body>
</html>

<!-- Kontak Kami Page -->

