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
      <a class="navbar-brand fw-bold" href="#">
        <img src="logo.png" alt="Logo" width="40" class="me-2">
        IND'S 88 TRANS
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="/armada-bus">Armada Bus</a></li>
          <li class="nav-item"><a class="nav-link" href="/paket-wisata">Paket Wisata</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Booking</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Promo</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
        </ul>
        <a href="#" class="gradient-button btn ms-lg-3">Booking Sekarang</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
 <!-- Section Armada Bus -->
<section class="py-5 bg-light" id="armada-bus">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Armada <span class="text-danger">Bus Wisata</span></h2>
      <p>Pilih bus yang tepat untuk perjalanan wisata Anda. Semua armada dalam kondisi prima dan terawat.</p>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4 align-items-center">
      <div class="col-md-6 mb-2 mb-md-0">
        <div class="input-group">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input type="text" class="form-control" placeholder="Cari nama bus atau fasilitas...">
        </div>
      </div>
      <div class="col-md-3 mb-2 mb-md-0">
        <select class="form-select">
          <option>Semua Tipe</option>
          <option>Mini Bus</option>
          <option>Medium Bus</option>
          <option>Big Bus</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option>Rating Tertinggi</option>
          <option>Harga Terendah</option>
          <option>Harga Tertinggi</option>
        </select>
      </div>
    </div>

    <!-- Armada Cards -->
    <div class="row g-4">
      <!-- Bus 1 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="position-relative">
            <img src="assets/img/bus-fleet.jpg" class="card-img-top" alt="Luxury Coach">
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">45 Penumpang</span>
          </div>
          <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <h5 class="fw-bold mb-0">Luxury Coach</h5>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-star-fill text-warning me-1"></i>
                  <p class="mb-0">4.9 (203 ulasan)</p>
                </div>
              </div>
            <p class="small mb-2">Bus mewah terbesar dengan layanan premium dan fasilitas terlengkap.</p>
            <div class="d-flex flex-wrap gap-2 small mb-3">
              <span class="badge bg-light text-dark border">AC</span>
              <span class="badge bg-light text-dark border">WiFi</span>
              <span class="badge bg-light text-dark border">Toilet</span>
              <span class="badge bg-light text-dark border">Reclining Seat</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">Rp 950.000 / hari</span>
              <div class="d-flex align-items-center -">
                <a href="#" class="btn btn-danger btn-sm me-2">Booking</a>
                <a href="#" class="btn btn-outline-danger btn-sm">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="position-relative">
            <img src="assets/img/bus-fleet.jpg" class="card-img-top" alt="Luxury Coach">
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">45 Penumpang</span>
          </div>
          <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <h5 class="fw-bold mb-0">Luxury Coach</h5>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-star-fill text-warning me-1"></i>
                  <p class="mb-0">4.9 (203 ulasan)</p>
                </div>
              </div>
            <p class="small mb-2">Bus mewah terbesar dengan layanan premium dan fasilitas terlengkap.</p>
            <div class="d-flex flex-wrap gap-2 small mb-3">
              <span class="badge bg-light text-dark border">AC</span>
              <span class="badge bg-light text-dark border">WiFi</span>
              <span class="badge bg-light text-dark border">Toilet</span>
              <span class="badge bg-light text-dark border">Reclining Seat</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">Rp 950.000 / hari</span>
              <div class="d-flex align-items-center -">
                <a href="#" class="btn btn-danger btn-sm me-2">Booking</a>
                <a href="#" class="btn btn-outline-danger btn-sm">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="position-relative">
            <img src="assets/img/bus-fleet.jpg" class="card-img-top" alt="Luxury Coach">
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">45 Penumpang</span>
          </div>
          <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <h5 class="fw-bold mb-0">Luxury Coach</h5>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-star-fill text-warning me-1"></i>
                  <p class="mb-0">4.9 (203 ulasan)</p>
                </div>
              </div>
            <p class="small mb-2">Bus mewah terbesar dengan layanan premium dan fasilitas terlengkap.</p>
            <div class="d-flex flex-wrap gap-2 small mb-3">
              <span class="badge bg-light text-dark border">AC</span>
              <span class="badge bg-light text-dark border">WiFi</span>
              <span class="badge bg-light text-dark border">Toilet</span>
              <span class="badge bg-light text-dark border">Reclining Seat</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">Rp 950.000 / hari</span>
              <div class="d-flex align-items-center -">
                <a href="#" class="btn btn-danger btn-sm me-2">Booking</a>
                <a href="#" class="btn btn-outline-danger btn-sm">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="position-relative">
            <img src="assets/img/bus-fleet.jpg" class="card-img-top" alt="Luxury Coach">
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">45 Penumpang</span>
          </div>
          <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <h5 class="fw-bold mb-0">Luxury Coach</h5>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-star-fill text-warning me-1"></i>
                  <p class="mb-0">4.9 (203 ulasan)</p>
                </div>
              </div>
            <p class="small mb-2">Bus mewah terbesar dengan layanan premium dan fasilitas terlengkap.</p>
            <div class="d-flex flex-wrap gap-2 small mb-3">
              <span class="badge bg-light text-dark border">AC</span>
              <span class="badge bg-light text-dark border">WiFi</span>
              <span class="badge bg-light text-dark border">Toilet</span>
              <span class="badge bg-light text-dark border">Reclining Seat</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">Rp 950.000 / hari</span>
              <div class="d-flex align-items-center -">
                <a href="#" class="btn btn-danger btn-sm me-2">Booking</a>
                <a href="#" class="btn btn-outline-danger btn-sm">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="position-relative">
            <img src="assets/img/bus-fleet.jpg" class="card-img-top" alt="Luxury Coach">
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">45 Penumpang</span>
          </div>
          <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <h5 class="fw-bold mb-0">Luxury Coach</h5>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-star-fill text-warning me-1"></i>
                  <p class="mb-0">4.9 (203 ulasan)</p>
                </div>
              </div>
            <p class="small mb-2">Bus mewah terbesar dengan layanan premium dan fasilitas terlengkap.</p>
            <div class="d-flex flex-wrap gap-2 small mb-3">
              <span class="badge bg-light text-dark border">AC</span>
              <span class="badge bg-light text-dark border">WiFi</span>
              <span class="badge bg-light text-dark border">Toilet</span>
              <span class="badge bg-light text-dark border">Reclining Seat</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">Rp 950.000 / hari</span>
              <div class="d-flex align-items-center -">
                <a href="#" class="btn btn-danger btn-sm me-2">Booking</a>
                <a href="#" class="btn btn-outline-danger btn-sm">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="position-relative">
            <img src="assets/img/bus-fleet.jpg" class="card-img-top" alt="Luxury Coach">
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">45 Penumpang</span>
          </div>
          <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <h5 class="fw-bold mb-0">Luxury Coach</h5>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-star-fill text-warning me-1"></i>
                  <p class="mb-0">4.9 (203 ulasan)</p>
                </div>
              </div>
            <p class="small mb-2">Bus mewah terbesar dengan layanan premium dan fasilitas terlengkap.</p>
            <div class="d-flex flex-wrap gap-2 small mb-3">
              <span class="badge bg-light text-dark border">AC</span>
              <span class="badge bg-light text-dark border">WiFi</span>
              <span class="badge bg-light text-dark border">Toilet</span>
              <span class="badge bg-light text-dark border">Reclining Seat</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">Rp 950.000 / hari</span>
              <div class="d-flex align-items-center -">
                <a href="#" class="btn btn-danger btn-sm me-2">Booking</a>
                <a href="#" class="btn btn-outline-danger btn-sm">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- CTA -->
    <div class="text-center mt-5 py-5">
      <h3 class="fw-bold mb-3">Butuh Bantuan Memilih Bus?</h3>
      <p>Tim kami siap membantu Anda menemukan bus yang tepat sesuai kebutuhan perjalanan.</p>
      <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="#" class="btn gradient-button text-white"><i class="bi bi-telephone me-2"></i>Hubungi Kami</a>
        <a href="#" class="btn gradient-button-2 text-white">Mulai Booking →</a>
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
          <img src="logo.png" alt="Logo" width="40" class="me-2">
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
          <li><a href="#" class="text-white text-decoration-none">Beranda</a></li>
          <li><a href="#" class="text-white text-decoration-none">Armada Bus</a></li>
          <li><a href="#" class="text-white text-decoration-none">Paket Wisata</a></li>
          <li><a href="#" class="text-white text-decoration-none">Booking</a></li>
          <li><a href="#" class="text-white text-decoration-none">Promo</a></li>
          <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
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
