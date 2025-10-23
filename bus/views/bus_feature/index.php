<div class="container-fluid px-4">
    <div class="card-body">
        <h1 class="mt-4 text-center">Data Fitur Bus</h1>
        <a href="/add-fitur-bus" class="btn btn-primary mb-4">
            <i class="bi bi-plus-circle me-1"></i> Tambah Fitur Bus
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
                <table id="datatablesSimple" class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Fitur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php $no = 1; foreach ($data as $row): 
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['feature']) ?></td>
                                <td>
                                    <a href="/edit-fitur-bus/<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/delete-fitur-bus/<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin ingin menghapus fitur ini?');">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-muted">Belum ada data fitur bus.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
