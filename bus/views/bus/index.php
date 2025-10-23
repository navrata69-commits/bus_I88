<div class="container-fluid px-4">
    <div class="card-body">
        <h1 class="mt-4 text-center">Data Bus</h1>
        <a href="add-data-bus" class="btn btn-primary mb-4">
            <i class="bi bi-plus-circle me-1"></i> Tambah Bus
        </a>

        <!-- Alert Pesan Sukses -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Tabel Data Bus -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table-striped align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Penumpang</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data) && count($data) > 0): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $bus): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($bus['name']) ?></td>
                                    <td><?= htmlspecialchars($bus['capacity']) ?></td>
                                    <td>Rp <?= number_format($bus['price'], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($bus['description']) ?></td>
                                    <td>
                                        <?php if ($bus['status'] === 'available'): ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit-bus/<?= urlencode($bus['id']) ?>" class="btn btn-warning btn-sm me-2">
                                            Edit
                                        </a>
                                        <a href="delete-data-bus/<?= urlencode($bus['id']) ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Yakin ingin menghapus data ini?');">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-muted">Belum ada data bus.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>              
</div>