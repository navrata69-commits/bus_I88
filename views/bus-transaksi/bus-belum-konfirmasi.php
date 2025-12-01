<h3 class="text-center">Konfirmasi Pembayaran Bus</h3>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['dangers'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['dangers']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table-striped align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th>Kode Rental</th>
                            <th>Nama User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders) && count($orders) > 0): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $order['rental_code'] ?></td>
                                    <td><?= $order['name'] ?></td>
                                    <td>Rp <?= number_format($order['total_price']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $order['status'] == 'pending' ? 'warning' : 'secondary' ?>">
                                        <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/admin/pembayaran-bus/<?= $order['id'] ?>" class="btn btn-info btn-sm">Detail</a>
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
