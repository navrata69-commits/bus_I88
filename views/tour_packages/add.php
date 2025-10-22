<div class="container mt-4">
    <h4 class="fw-bold mb-3">Tambah Paket Wisata</h4>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/tour-packages/create" method="POST" enctype="multipart/form-data">
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Pilih Destinasi</label>
                    <select name="destination_id" class="form-select">
                        <option value="">-- Pilih Destinasi --</option>
                        <?php foreach ($destinations as $destination): ?>
                            <option value="<?= $destination['id'] ?>"
                                <?= isset($package['destination_id']) && $package['destination_id'] == $destination['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($destination['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="name" class="form-control" value="<?= $old['name'] ?? '' ?>" placeholder="Nama paket wisata">
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (Hari)</label>
                    <input type="number" name="duration_days" class="form-control" value="<?= $old['duration_days'] ?? '' ?>" min="1">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="<?= $old['start_date'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Berakhir</label>
                        <input type="date" name="end_date" class="form-control" value="<?= $old['end_date'] ?? '' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kapasitas Tetap</label>
                        <input type="number" name="fixed_capacity" class="form-control" value="<?= $old['fixed_capacity'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga Tetap</label>
                        <input type="number" name="fixed_price" class="form-control" value="<?= $old['fixed_price'] ?? '' ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Paket</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Maksimal 2MB</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat paket"><?= $old['description'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Bus</label>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach ($buses as $bus): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="buses[]" value="<?= $bus['id'] ?>" id="bus<?= $bus['id'] ?>">
                                <label class="form-check-label" for="bus<?= $bus['id'] ?>"><?= htmlspecialchars($bus['name']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="/tour-packages" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </div>
        </div>
    </form>
</div>
