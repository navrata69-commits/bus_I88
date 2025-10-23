<div class="container mt-4">
    <h4 class="fw-bold mb-3">Edit Paket Wisata</h4>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/tour-packages/update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $package->id ?>">

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Pilih Destinasi</label>
                    <select name="destination_id" class="form-select">
                        <option value="">-- Pilih Destinasi --</option>
                        <?php foreach ($destinations as $destination): ?>
                            <option value="<?= $destination['id'] ?>"
                                <?= isset($package->destination_id) && $package->destination_id == $destination['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($destination['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($package->name) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (Hari)</label>
                    <input type="number" name="duration_days" class="form-control" value="<?= $package->duration_days ?>">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="<?= date('Y-m-d', strtotime($package->start_date)) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Berakhir</label>
                        <input type="date" name="end_date" class="form-control" value="<?= date('Y-m-d', strtotime($package->end_date)) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kapasitas Tetap</label>
                        <input type="number" name="fixed_capacity" class="form-control" value="<?= $package->fixed_capacity ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga Tetap</label>
                        <input type="number" name="fixed_price" class="form-control" value="<?= $package->fixed_price ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Paket</label>
                    <?php if (!empty($package->image)): ?>
                        <div class="mb-2">
                            <img src="data:image/jpeg;base64,<?= base64_encode($package->image) ?>" width="150" class="rounded">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($package->description) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Bus</label>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach ($buses as $bus): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="buses[]" value="<?= $bus['id'] ?>"
                                    id="bus<?= $bus['id'] ?>"
                                    <?= in_array($bus['id'], $selectedBuses) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="bus<?= $bus['id'] ?>"><?= htmlspecialchars($bus['name']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="/tour-packages" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>

            </div>
        </div>
    </form>
</div>
