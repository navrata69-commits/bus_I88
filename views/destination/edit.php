<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <h4 class="mb-0 text-center">Edit Tujuan</h4>

        <div class="card-body p-4">
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="/update-destination" method="POST">
                <input type="hidden" name="id" value="<?= $destination->id ?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Tujuan</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($destination->name) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($destination->description) ?></textarea>
                </div>

                <hr>
                <h5 class="fw-semibold mb-3">Daftar Wisata</h5>

                <div id="tour-container">
                    <?php if (!empty($destinationDetails)): ?>
                        <?php foreach ($destinationDetails as $detail): ?>
                            <div class="tour-item mb-3 d-flex">
                                <input type="text" name="tour[]" class="form-control me-2" value="<?= htmlspecialchars($detail->tour) ?>" required>
                                <button type="button" class="btn btn-danger remove-tour">Hapus</button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="tour-item mb-3 d-flex">
                            <input type="text" name="tour[]" class="form-control me-2" placeholder="Masukkan nama wisata" required>
                            <button type="button" class="btn btn-danger remove-tour">Hapus</button>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="button" id="add-tour" class="btn btn-primary mb-3">+ Tambah Wisata</button>

                <div class="d-flex justify-content-between">
                    <a href="/data-destination" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('add-tour').addEventListener('click', function() {
    const container = document.getElementById('tour-container');
    const div = document.createElement('div');
    div.classList.add('tour-item', 'mb-3', 'd-flex');
    div.innerHTML = `
        <input type="text" name="tour[]" class="form-control me-2" placeholder="Masukkan nama wisata" required>
        <button type="button" class="btn btn-danger remove-tour">Hapus</button>
    `;
    container.appendChild(div);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-tour')) {
        e.target.closest('.tour-item').remove();
    }
});
</script>
