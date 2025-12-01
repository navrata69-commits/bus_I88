<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IND'S 88 TRANS</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/styles.css">
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
                    <li class="nav-item"><a class="nav-link active" href="/paket-wisata">Paket Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="/booking-bus">Booking Bus</a></li>
                    <li class="nav-item"><a class="nav-link" href="/booking-wisata">Booking Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="/promo">Promo</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tentang-kami">Tentang Kami</a></li>
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
<section class="py-5 bg-light" id="paket-wisata">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Paket <span class="text-danger">Wisata Indonesia</span></h2>
      <p>Jelajahi keindahan Indonesia dengan paket wisata lengkap. Transport, hotel, makan, dan tour guide sudah termasuk!</p>
    </div>

    <div class="row g-4">
  <?php if (!empty($pakets) && count($pakets) > 0): ?>
    <?php foreach ($pakets as $paket): ?>
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="position-relative">
            <?php if (!empty($paket['image'])): ?>
              <img src="data:image/jpeg;base64,<?= base64_encode($paket['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($paket['name']) ?>">
            <?php else: ?>
              <img src="assets/img/destinations.jpg" class="card-img-top" alt="Default">
            <?php endif; ?>

            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
              <?= $paket['duration_days'] ?> Hari <?= ($paket['duration_days'] - 1) ?> Malam
            </span>

            <span class="badge bg-success position-absolute top-0 end-0 m-2">
              <?= htmlspecialchars($paket['fixed_capacity']) ?> Orang
            </span>
          </div>

          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div>
                <h5 class="fw-bold mb-0"><?= htmlspecialchars($paket['name']) ?></h5>
              </div>
              <div class="d-flex align-items-center">
                <i class="bi bi-star-fill text-warning me-1"></i>
                <p class="mb-0">
                  <?= $paket['avg_rating'] ? number_format($paket['avg_rating'], 0) : '-' ?> 
                  (<?= $paket['rating_count'] ?> ulasan)
                </p>
              </div>
            </div>

            <p class="small text-muted mb-2">
              <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($paket['destination_name']) ?> |
              <i class="bi bi-clock"></i> <?= $paket['duration_days'] ?>H<?= $paket['duration_days'] - 1 ?>M
            </p>

            <div class="d-flex flex-wrap gap-2 small mb-2">
              <?php 
                $tourPlaces = explode(',', $paket['tours'] ?? '');
                foreach ($tourPlaces as $place): 
                  if (trim($place) !== ''):
              ?>
                <span class="badge bg-light text-dark border"><?= htmlspecialchars(trim($place)) ?></span>
              <?php endif; endforeach; ?>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-bold text-danger fs-5">
                  Rp <?= number_format($paket['fixed_price'], 0, ',', '.') ?>
                </span>
                <?php if (!empty($paket['discount_price']) && $paket['discount_price'] < $paket['fixed_price']): ?>
                  <span class="text-muted text-decoration-line-through small ms-1">
                    Rp <?= number_format($paket['fixed_price'], 0, ',', '.') ?>
                  </span>
                <?php endif; ?>
              </div>

              <a href="/booking-wisata" class="btn btn-danger btn-sm px-3">
                Booking Sekarang <i class="bi bi-arrow-right"></i>
              </a>
            </div>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12 text-center py-5">
      <h5 class="fw-bold text-muted">Paket wisata tidak ditemukan</h5>
  <?php endif; ?>
</div>


  <div class="text-center mt-5 py-5">
    <h3 class="fw-bold mb-3">Paket Custom Sesuai Keinginan?</h3>
    <p>Kami bisa buatkan paket wisata sesuai budget dan destinasi impian anda.</p>
    <div class="d-flex justify-content-center gap-3 mt-4">
      <a href="https://wa.me/+62" class="btn btn-danger px-4"><i class="bi bi-telephone me-2"></i>Konsultasi Gratis</a>
      <a href="/armada-bus" class="btn btn-dark px-4">Lihat Armada Bus →</a>
    </div>
  </div>
</section>


<!-- Footer -->
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

  <!-- Bootstrap JS -->
  <script src="assets/js/scripts.js"></script>
</body>
</html>
