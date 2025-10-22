<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <h4 class="mb-0 text-center">Tambah Promo</h4>

        <div class="card-body p-4">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $fieldErrors): ?>
                            <?php foreach ($fieldErrors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/add-promo" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Promo</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama promo" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Promo</label>
                    <input type="number" name="code" class="form-control" placeholder="Masukkan kode promo" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Berakhir</label>
                    <input type="datetime-local" name="end_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slot</label>
                    <input type="number" name="slot" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/data-promo" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
