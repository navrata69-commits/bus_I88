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
                    <li class="nav-item"><a class="nav-link active" href="/promo">Promo</a></li>
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

<!-- Section Promo -->
<section class="py-5" style="background-color: #fff5f5;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Promo <span class="text-danger">Menarik</span></h2>
      <p class="text-muted">Dapatkan penawaran terbaik untuk perjalanan wisata impian Anda</p>
    </div>

    <div class="row g-4">
      <?php foreach ($promos as $promo): ?>
        <div class="col-md-4">
          <div class="card shadow-sm border-0 h-100 rounded-3">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="fw-bold"><?= htmlspecialchars($promo['name']) ?></h5>
                <span class="badge bg-danger">Promo</span>
              </div>

              <p class="text-muted small mb-3">
                Gunakan kode promo berikut untuk menikmati potongan harga atau keuntungan spesial lainnya.
              </p>

              <div class="border rounded p-3 mb-3">
                <p class="mb-1 fw-bold text-uppercase small text-danger">Kode Promo</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="fw-bold"><?= htmlspecialchars($promo['code']) ?></span>
                  <button class="btn btn-outline-secondary btn-sm" onclick="copyCode('<?= htmlspecialchars($promo['code']) ?>')">
                    <i class="bi bi-clipboard"></i>
                  </button>
                </div>
              </div>

              <div class="d-flex justify-content-between small mb-3">
                <span><i class="bi bi-calendar-event me-1"></i>
                  Berlaku: <?= date('d M Y', strtotime($promo['start_date'])) ?> -
                  <?= date('d M Y', strtotime($promo['end_date'])) ?>
                </span>
              </div>

              <p class="small text-muted mb-1"><i class="bi bi-people me-1"></i> Slot tersedia: <?= $promo['slot'] ?></p>
              <hr>
              <a href="/booking-bus" class="btn btn-danger w-100 fw-bold">
                Gunakan Promo <i class="bi bi-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
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

<script>
  function copyCode(code) {
    navigator.clipboard.writeText(code);
    alert('Kode promo "' + code + '" disalin!');
  }
</script>

</body>
</html>
