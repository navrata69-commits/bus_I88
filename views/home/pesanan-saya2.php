<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesanan Saya | IND'S 88 TRANS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
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
                    <li class="nav-item"><a class="nav-link active" href="/armada-bus">Armada Bus</a></li>
                    <li class="nav-item"><a class="nav-link" href="/paket-wisata">Paket Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="/booking-bus">Booking Bus</a></li>
                    <li class="nav-item"><a class="nav-link" href="/booking-wisata">Booking Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="/promo">Promo</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tentang-kami">Tentang Kami</a></li>
                </ul> 
                <?php
                  use bus\Project\core\Session;
                  use bus\Project\models\Payment;

                  if (!empty(Session::get('user'))) :
                  ?>
                      <a href="/pesanan-saya-bus" 
                        class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 40px; height: 40px;">
                          <i class="bi bi-cart fs-5"></i>
                      </a>
                      <a href="/logout" class="btn btn-danger">Logout</a>
                  <?php else : ?>
                      <a href="/login" class="gradient-button btn ms-lg-3">Booking Sekarang</a>
                  <?php endif; ?>

        </div>
    </nav>

<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Pesanan <span class="text-danger">Saya</span></h2>
      <p>Kelola semua pesanan Anda untuk rental bus dan paket wisata.</p>
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
    <!-- Tabs -->
    <ul class="nav nav-pills justify-content-center mb-4" id="orderTabs">
      <li class="nav-item">
        <a href="/pesanan-saya-bus" class="btn nav-link">
            <i class="bi bi-geo-alt me-2"></i> Pesanan Bus
        </a>
      </li>
      <li class="nav-item">
        <a href="/pesanan-saya-tour" class="btn nav-link active">
            <i class="bi bi-geo-alt me-2"></i> Pesanan Wisata
        </a>
      </li>
    </ul>

    <div class="tab-content">

      <div class="tab-pane fade show active" id="tour-orders">
        <?php if (!empty($tour)): ?>
          <div class="row g-4">
            <?php foreach ($tour as $order): ?>
              <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                  <div class="card-body">
                    <h5 class="fw-bold mb-1">Kode: <?= htmlspecialchars($order->rental_code) ?></h5>
                    <p class="small text-muted mb-2">Tanggal: <?= date('d M Y', strtotime($order->date)) ?></p>
                    <ul class="list-unstyled small mb-3">
                      <li><i class="bi bi-people me-2 text-danger"></i>Jumlah Orang: <?= $order->number_of_people ?></li>
                      <li><i class="bi bi-cash-stack me-2 text-danger"></i>Total Harga: <b>Rp <?= number_format($order->total_price, 0, ',', '.') ?></b></li>
                      <li><i class="bi bi-info-circle me-2 text-danger"></i>Status: 
                        <span class="badge bg-<?= $order->status == 'confirmed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') ?>">
                          <?= ucfirst($order->status) ?>
                        </span>
                      </li>
                    </ul>

                    <div class="d-flex justify-content-end">
                      <?php if ($order->status == 'confirmed'): ?>
                        <button class="btn btn-success btn-sm" disabled><i class="bi bi-check-circle"></i> Sudah Dikonfirmasi</button>
                      <?php elseif ($order->status == 'pending'): ?>
                        <a href="/pelunasan-tour/<?= $order->id ?>" class="btn btn-danger btn-sm">
                            <i class="bi bi-wallet2 me-1"></i> Pilih Metode Pembayaran
                          </a>
                      <?php elseif($order->status == 'wait_confirmation') : ?>
                        <?php 
                          $payment = Payment::where('rental_id', '=', $order->id)->first();
                        ?>
                        <?php if ($payment->status == 'paid') :?>
                          <a href="#" class="btn btn-secondary btn-sm">
                            <i class="bi bi-credit-card me-1"></i> Menunggu Konfirmasi
                          </a>
                        <?php elseif($payment->status == 'unpaid') : ?>
                          <a href="/transfer-page/<?= $payment->id ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-credit-card me-1"></i> Lakukan Pelunasan
                        </a>
                        <?php endif ?>  
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-center text-muted mt-4">Belum ada pesanan wisata.</p>
        <?php endif; ?>
      </div>

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
      console.log("Script jalan!");
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
