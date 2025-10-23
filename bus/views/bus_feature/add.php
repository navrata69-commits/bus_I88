<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <h4 class="mb-0 text-center">Tambah Fitur Bus</h4>
        <div class="card-body p-4">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $fieldErrors): ?>
                            <?php foreach ($fieldErrors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/add-fitur-bus" method="POST">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Fitur</label>
                    <input type="text" name="feature" class="form-control" placeholder="Contoh: AC, TV, WiFi" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/data-fitur-bus" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
