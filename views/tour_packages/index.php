<div class="container mt-4">
    <h4 class="fw-bold text-center">Daftar Paket Wisata</h4>
    <a href="/tour-packages/add" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Tambah Paket</a>

            <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Tujuan</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $key => $item): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= htmlspecialchars($item['destination_name'] ?? '-') ?></td>
                                <td><?= $item['duration_days'] ?> Hari</td>
                                <td>Rp <?= number_format($item['fixed_price'], 0, ',', '.') ?></td>
                                <td><?= $item['start_date'] ?> - <?= $item['end_date'] ?></td>
                                <td><?= $item['fixed_capacity'] ?> Orang</td>
                                <td>
                                    <a href="/tour-packages/edit/<?= $item['id'] ?>" class="btn btn-sm btn-warning">Edit</i></a>
                                    <a href="/tour-packages/delete/<?= $item['id'] ?>" onclick="return confirm('Yakin ingin menghapus paket ini?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data paket wisata.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
