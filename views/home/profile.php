<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Saya | IND'S 88 TRANS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>


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
                  <?php else : ?>
                      <a href="/login" class="gradient-button btn ms-lg-3">Booking Sekarang</a>
                  <?php endif; ?>

        </div>
    </nav>

<section class="py-5 bg-light">
  <div class="container">
    
    <div class="text-center mb-5">
      <h2 class="fw-bold">Profil <span class="text-danger">Saya</span></h2>
      <p>Kelola informasi akun dan kata sandi Anda.</p>
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
    <ul class="nav nav-pills justify-content-center mb-4">
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile">
          <i class="bi bi-person-circle me-2"></i> Profil Saya
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password">
          <i class="bi bi-shield-lock me-2"></i> Ubah Password
        </button>
      </li>
    </ul>

    <div class="tab-content">

      <!-- TAB PROFIL -->
      <div class="tab-pane fade show active" id="profile">
        <div class="card shadow-sm border-0 p-4">
          <form action="/profile/update" method="POST">
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" 
                       value="<?= htmlspecialchars($user->name) ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" 
                       value="<?= htmlspecialchars($user->email) ?>">
              </div>
            </div>

            <button class="btn btn-danger px-4">Simpan Perubahan</button>
          </form>
        </div>
      </div>

      <!-- TAB UBAH PASSWORD -->
      <div class="tab-pane fade" id="password">
        <div class="card shadow-sm border-0 p-4">
          <form action="/profile/change-password" method="POST">
            <div class="mb-3">
              <label class="form-label">Password Lama</label>
              <input type="password" name="old_password" class="form-control">
            </div>

            <div class="mb-3">
              <label class="form-label">Password Baru</label>
              <input type="password" name="new_password" class="form-control">
            </div>

            <div class="mb-3">
              <label class="form-label">Konfirmasi Password Baru</label>
              <input type="password" name="confirm_password" class="form-control">
            </div>

            <button class="btn btn-danger px-4">Ubah Password</button>
          </form>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
