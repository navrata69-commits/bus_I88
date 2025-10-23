<div class="container-fluid px-4">
    <div class="card-body">
        <h1 class="mt-4 text-center">Data Promo</h1>
        <a href="/add-promo" class="btn btn-primary mb-4">
            <i class="bi bi-plus-circle me-1"></i> Tambah Promo
        </a>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table-striped align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Slot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($promo)): ?>
                            <?php $no = 1; foreach ($promo as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($p['name']) ?></td>
                                    <td><?= htmlspecialchars($p['code']) ?></td>
                                    <td><?= htmlspecialchars($p['start_date']) ?></td>
                                    <td><?= htmlspecialchars($p['end_date']) ?></td>
                                    <td><?= htmlspecialchars($p['slot']) ?></td>
                                    <td>
                                        <a href="/edit-promo/<?= urlencode($p['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="/delete-promo/<?= urlencode($p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-muted">Belum ada data promo.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
