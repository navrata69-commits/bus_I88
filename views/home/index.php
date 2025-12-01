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
    <link href="assets/css/custom.css" rel="stylesheet"> </head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"> <img src="assets/img/inds88-logo.png" alt="Logo" width="40" class="me-2"> IND'S 88 TRANS </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/armada-bus">Armada Bus</a></li>
                    <li class="nav-item"><a class="nav-link" href="/paket-wisata">Paket Wisata</a></li>
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
    <!-- Hero Section -->
    <section class="hero d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white">
                    <h1 class="fw-bold">Jelajahi Indonesia<br>dengan <span class="text-warning">Bus Wisata Terbaik</span></h1>
                    <p>Nikmati perjalanan yang aman, nyaman, dan berkesan bersama armada bus modern kami. Destinasi impian Anda menanti!</p>
                    <div class="d-flex gap-3"> <a href="/booking-bus" class="gradient-button btn">Booking Sekarang</a> <a href="/armada-bus" class="btn gradient-button-2">Lihat Armada</a> </div>
                    <div class="d-flex gap-4 mt-4 small"> <span><i class="bi bi-shield-check"></i> Asuransi Perjalanan</span> <span><i class="bi bi-people"></i> 10.000+ Pelanggan</span> <span><i class="bi bi-star"></i> Rating 4.8/5</span> </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="card booking-card p-4">
                        <h5 class="mb-3 fw-bold">Booking Cepat</h5>
                        <form action="/paket-wisata">
                            <div class="mb-3">
                                <label class="form-label">Tujuan Wisata</label>
                                <select class="form-select" name="destination">
                                        <option>Pilih Destinasi</option>
                                    <?php foreach($data as $a) : ?>
                                        <option value="<?= $a['id'] ?>"><?= $a['name']  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="date"> </div>
                            <div class="mb-3">
                                <label class="form-label">Penumpang</label>
                                <select class="form-select" name="capacity">
                                    <option value="20">20 Orang</option>
                                    <option value="30">30 Orang</option>
                                    <option value="40">40 Orang</option>
                                    <option value="50">50 Orang</option>
                                </select>
                            </div>
                            <button class="gradient-button btn w-100">Cari Bus Tersedia</button>
                            <p class="small mt-2 text-center">Atau hubungi: +62 812-3456-7890</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Mengapa Memilih -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Mengapa Memilih IND'S 88 TRANS?</h2>
                <p>Pilihan lengkap dan pelayanan terbaik untuk perjalanan wisata yang tak terlupakan.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-6 col-md-4">
                    <div class="p-4 border rounded-4 h-100"> <i class="bi bi-snow text-danger display-5"></i>
                        <h5 class="mt-3 fw-bold">AC Full Blast</h5>
                        <p class="small">Pendingin ruangan terbaik untuk kenyamanan perjalanan.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="p-4 border rounded-4 h-100"> <i class="bi bi-wifi text-danger display-5"></i>
                        <h5 class="mt-3 fw-bold">WiFi Gratis</h5>
                        <p class="small">Akses internet gratis selama perjalanan.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="p-4 border rounded-4 h-100"> <i class="bi bi-battery-charging text-danger display-5"></i>
                        <h5 class="mt-3 fw-bold">Charging Port</h5>
                        <p class="small">Colokan listrik untuk isi daya gadget Anda.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="p-4 border rounded-4 h-100"> <i class="bi bi-card-checklist text-danger display-5"></i>
                        <h5 class="mt-3 fw-bold">Kursi Reclining</h5>
                        <p class="small">Kursi yang dapat direbahkan untuk relaksasi optimal.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="p-4 border rounded-4 h-100"> <i class="bi bi-shield-check text-danger display-5"></i>
                        <h5 class="mt-3 fw-bold">Asuransi Perjalanan</h5>
                        <p class="small">Perlindungan perjalanan yang menyeluruh.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="p-4 border rounded-4 h-100"> <i class="bi bi-clock text-danger display-5"></i>
                        <h5 class="mt-3 fw-bold">On Time Guarantee</h5>
                        <p class="small">Jaminan keberangkatan tepat waktu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Armada Bus -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
      <?php if (!empty($datas)): ?>
        <?php foreach ($datas as $bus): ?>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <div class="position-relative">
                <img src="data:image/jpeg;base64,<?= base64_encode($bus['image']) ?>"  class="w-100 object-fit-cover">
                <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                  <?= htmlspecialchars($bus['capacity']) ?> Penumpang
                </span>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div>
                    <h5 class="fw-bold mb-0"><?= htmlspecialchars($bus['name']) ?></h5>
                  </div>
                  <div class="d-flex align-items-center">
                    <i class="bi bi-star-fill text-warning me-1"></i>
                    <p class="mb-0">
                      <?= $bus['avg_rating'] ? number_format($bus['avg_rating'], 0) : '-' ?> 
                      (<?= $bus['rating_count'] ?> ulasan)
                    </p>
                  </div>
                </div>
                <p class="small mb-2"><?= htmlspecialchars($bus['description']) ?></p>
                
                <div class="d-flex flex-wrap gap-2 small mb-3">
                  <?php 
                    $features = explode(',', $bus['features']);
                    foreach ($features as $feature): 
                  ?>
                    <span class="badge bg-light text-dark border"><?= htmlspecialchars(trim($feature)) ?></span>
                  <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                  <span class="fw-bold text-danger">
                    Rp <?= number_format($bus['price'], 0, ',', '.') ?> / hari
                  </span>
                  <div class="d-flex align-items-center">
                    <a href="/booking-bus" class="btn btn-danger btn-sm me-2">Booking</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <p class="text-muted">Tidak ada data bus tersedia.</p>
        </div>
      <?php endif; ?>
    </div>
            <div class="text-center mt-4"> <a href="/armada-bus" class="gradient-button btn text-white"> Lihat Semua Armada <span class="arrow">→</span> </a> </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-danger text-white pt-5 pb-3">
        <div class="container">
            <div class="row gy-4">
                <!-- Kolom 1 -->
                <div class="col-md-5">
                    <div class="d-flex align-items-center mb-3"> <img src="assets/img/inds88-logo.png" alt="Logo" width="40" class="me-2">
                        <div>
                            <h5 class="mb-0 fw-bold">IND'S 88 TRANS</h5> <small>Travel Indonesia</small> </div>
                    </div>
                    <p class="small"> Perusahaan bus wisata terpercaya dengan lebih dari 10 tahun pengalaman. Kami berkomitmen memberikan layanan perjalanan yang aman, nyaman, dan berkesan ke seluruh destinasi wisata di Indonesia. </p>
                    <div class="d-flex gap-3 fs-5"> <a href="#" class="text-white"><i class="bi bi-facebook"></i></a> <a href="#" class="text-white"><i class="bi bi-instagram"></i></a> <a href="#" class="text-white"><i class="bi bi-twitter-x"></i></a> </div>
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
                        <li class="mb-2"> <i class="bi bi-telephone me-2"></i> +62 812-3456-7890
                            <br> <small class="ms-4">24 Jam Customer Service</small> </li>
                        <li class="mb-2"> <i class="bi bi-envelope me-2"></i> info@inds88trans.com
                            <br> <small class="ms-4">Booking & Informasi</small> </li>
                        <li> <i class="bi bi-geo-alt me-2"></i> Jakarta, Indonesia
                            <br> <small class="ms-4">Kantor Pusat</small> </li>
                    </ul>
                </div>
            </div>
            <hr class="border-light mt-4">
            <div class="text-center small"> © 2024 IND'S 88 TRANS Travel Indonesia. Semua hak cipta dilindungi. </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="assets/js/scripts.js"></script>
</body>

</html>