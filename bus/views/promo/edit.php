<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <h4 class="mb-0 text-center">Edit Promo</h4>
        <div class="card-body p-4">
            <form action="/update-promo" method="POST">
                <input type="hidden" name="id" value="<?= $promo->id ?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Promo</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($promo->name) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode</label>
                    <input type="number" name="code" class="form-control" value="<?= htmlspecialchars($promo->code) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="<?= htmlspecialchars($promo->start_date) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Berakhir</label>
                    <input type="datetime-local" name="end_date" class="form-control" value="<?= str_replace(' ', 'T', $promo->end_date) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slot</label>
                    <input type="number" name="slot" class="form-control" value="<?= htmlspecialchars($promo->slot) ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/data-promo" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
