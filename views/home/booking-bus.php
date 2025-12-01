<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IND'S 88 TRANS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
                    <li class="nav-item"><a class="nav-link" href="/paket-wisata">Paket Wisata</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/booking-bus">Booking Bus</a></li>
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
  <!-- Hero Section -->
    <section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Form <span class="text-danger">Rental Bus</span></h2>
      <p>Isi detail pemesanan bus wisata Anda di bawah ini.</p>
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
    <form method="POST" action="/booking-bus" class="card shadow-sm p-4 mx-auto" style="max-width: 600px;">
      <?php if(isset($errors)): ?>
        <div class="alert alert-danger">
          <?php foreach($errors as $err): foreach($err as $e): ?>
            <p><?= htmlspecialchars($e) ?></p>
          <?php endforeach; endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="mb-3">
        <label class="form-label fw-bold">Pilih Bus</label>
        <select name="bus_ids[]" class="form-select" multiple required>
          <?php foreach($buses as $bus): ?>
            <option value="<?= $bus->id ?>"><?= htmlspecialchars($bus->name) ?> - Rp <?= number_format($bus->price, 0, ',', '.') ?>/hari</option>
          <?php endforeach; ?>
        </select>
        <small class="text-muted">*Tekan CTRL (atau CMD di Mac) untuk memilih lebih dari satu.</small>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label fw-bold">Tanggal Mulai</label>
          <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label fw-bold">Tanggal Selesai</label>
          <input type="date" name="end_date" class="form-control" required>
        </div>
      </div>

      <div class="text-center mt-4">
        <button class="btn btn-danger px-5" type="submit">
          <i class="bi bi-check-circle me-2"></i>Pesan Sekarang
        </button>
      </div>
    </form>
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

  <script>
document.addEventListener('DOMContentLoaded', function () {
    const startDateInput = document.querySelector('input[name="start_date"]');
    const endDateInput = document.querySelector('input[name="end_date"]');

    // Set minimum date untuk start_date (tidak boleh sebelum hari ini)
    const today = new Date().toISOString().split('T')[0];
    startDateInput.setAttribute('min', today);

    // Saat start_date berubah
    startDateInput.addEventListener('change', function () {
        const startDate = startDateInput.value;

        // Set minimum untuk end_date agar tidak bisa sebelum start_date
        endDateInput.setAttribute('min', startDate);

        // Jika end_date sudah diisi tapi lebih kecil dari start_date → kosongkan
        if (endDateInput.value && endDateInput.value < startDate) {
            endDateInput.value = '';
        }
    });

    // Validasi ketika end_date berubah
    endDateInput.addEventListener('change', function () {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (endDate < startDate) {
            alert('Tanggal selesai tidak boleh kurang dari tanggal mulai!');
            endDateInput.value = '';
        }
    });
});
</script>

</body>
</html>
