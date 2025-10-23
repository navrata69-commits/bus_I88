<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <h4 class="mb-0 text-center mt-5"><i class="bi bi-bus-front me-2"></i>Tambah Data Bus</h4>

        <div class="card-body p-4">
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

            <div class="container mt-4">

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="/add-data-bus" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Bus</label>
            <input type="text" name="name" class="form-control" >
        </div>

        <div class="mb-3">
            <label>Gambar (max 2MB)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="capacity" class="form-control" >
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" >
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="1" >Aktif</option>
                <option value="0" >Nonaktif</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Fitur Bus</label>
            <div class="row">
                <?php foreach ($features as $f): ?>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" name="features[]" value="<?= $f['id'] ?>" class="form-check-input">
                            <label class="form-check-label"><?= $f['feature'] ?></label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

        </div>
    </div>
</div>
