<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran Pesanan | IND'S 88 TRANS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
  <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#"> 
      <img src="/assets/img/inds88-logo.png" alt="Logo" width="40" class="me-2"> IND'S 88 TRANS 
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"> 
      <span class="navbar-toggler-icon"></span> 
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="/armada-bus">Armada Bus</a></li>
        <li class="nav-item"><a class="nav-link" href="/paket-wisata">Paket Wisata</a></li>
        <li class="nav-item"><a class="nav-link" href="/booking-bus">Booking Bus</a></li>
        <li class="nav-item"><a class="nav-link" href="/booking-wisata">Booking Wisata</a></li>
        <li class="nav-item"><a class="nav-link" href="/promo">Promo</a></li>
        <li class="nav-item"><a class="nav-link" href="/tentang-kami">Tentang Kami</a></li>
      </ul>
      <?php use bus\Project\core\Session; ?>
      <?php if (!empty(Session::get('user'))): ?>
        <a href="/pesanan-saya-bus" 
          class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center ms-2"
          style="width: 40px; height: 40px;">
          <i class="bi bi-person fs-5"></i>
          <a href="/logout" class="btn btn-danger">Logout</a>
        </a>
      <?php else: ?>
        <a href="/login" class="gradient-button btn ms-lg-3">Booking Sekarang</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Section Pembayaran -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Pembayaran <span class="text-danger">Pesanan</span></h2>
      <p class="text-muted">Selesaikan pembayaran Anda untuk mengonfirmasi pesanan.</p>
    </div>
    <?php 
        $errors = Session::get('errors');
        $success = Session::get('success');
        Session::forget('errors');
        Session::forget('success');
        ?>

        <?php if($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $fieldErrors): foreach($fieldErrors as $err): ?>
            <p class="mb-0"><?= htmlspecialchars($err) ?></p>
            <?php endforeach; endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <!-- Detail Pesanan -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Detail Pesanan</h5>
            <div class="row mb-2">
              <div class="col-md-6"><strong>Kode Pesanan:</strong></div>
              
              <div class="col-md-6"><?= htmlspecialchars($order->rental_code) ?></div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6"><strong>Tanggal Sewa:</strong></div>
              <div class="col-md-6"><?= htmlspecialchars($order->start_date) ?> → <?= htmlspecialchars($order->end_date) ?></div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6"><strong>Total Hari:</strong></div>
              <div class="col-md-6"><?= htmlspecialchars($order->total_days) ?> hari</div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6"><strong>Total Harga:</strong></div>
              <div class="col-md-6 fw-bold text-danger">Rp <?= number_format($order->total_price, 0, ',', '.') ?></div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6"><strong>Status:</strong></div>
              <div class="col-md-6">
                <span class="badge bg-warning text-dark"><?= ucfirst($order->status) ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Form Pembayaran -->
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Metode Pembayaran</h5>
            <form method="POST" action="/pelunasan/submit">
              <input type="hidden" name="rental_id" value="<?= $order->id ?>">
              <input type="hidden" name="rental_type" value="bus">

              <div class="mb-3">
                <label class="form-label fw-bold">Pilih Metode</label>
                <select class="form-select" name="payment_method" required>
                  <option value="transfer">Transfer Bank</option>
                  <option value="cash">Bayar di Tempat</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Kode Promo (Opsional)</label>
                <input type="text" class="form-control" name="promo_code" placeholder="Masukkan kode promo jika ada">
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-danger px-5">
                  <i class="bi bi-wallet2 me-2"></i>Bayar Sekarang
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
