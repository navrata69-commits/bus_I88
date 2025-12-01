<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Edit Data Bus</h1>

    <div class="card shadow-sm mt-4">
        <div class="card-body">

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

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

            <?php if (!empty($bus)): ?>
                <form method="POST" action="/update-data-bus" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($bus->id) ?>">

                    <div class="mb-3">
                        <label>Nama Bus</label>
                        <input type="text" name="name" class="form-control" 
                               value="<?= htmlspecialchars($bus->name) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Gambar (max 2MB)</label><br>
                        <?php if (!empty($bus->image)): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($bus->image) ?>" 
                                 width="120" class="mb-2 rounded">
                        <?php endif; ?>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Kapasitas</label>
                        <input type="number" name="capacity" class="form-control" 
                               value="<?= htmlspecialchars($bus->capacity) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="price" class="form-control" 
                               value="<?= htmlspecialchars($bus->price) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Tipe Bus</label>
                        <select name="type_bus" class="form-select">
                            <option value="Mini Bus" <?= $bus->type_bus == 'Mini Bus' ? 'selected' : '' ?>>Mini Bus</option>
                            <option value="Medium Bus" <?= $bus->type_bus == 'Medium Bus' ? 'selected' : '' ?>>Medium Bus</option>
                            <option value="Big Bus" <?= $bus->type_bus == 'Big Bus' ? 'selected' : '' ?>>Big Bus</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($bus->description) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="1" <?= $bus->status == '1' ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= $bus->status == '0' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Fitur Bus</label>
                        <div class="row">
                            <?php foreach ($features as $f): ?>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="features[]" 
                                               value="<?= htmlspecialchars($f['id']) ?>"
                                               class="form-check-input"
                                               <?= in_array($f['id'], $selectedFeatures ?? []) ? 'checked' : '' ?>>
                                        <label class="form-check-label"><?= htmlspecialchars($f['feature']) ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                    <a href="/data-bus" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Update</button>
                </div>
                </form>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    Data bus tidak ditemukan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
