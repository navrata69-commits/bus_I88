<div class="container mt-4">

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Detail Pembayaran Bus</h4>
        </div>
        <div class="card-body">

            <?php if (!$order): ?>
                <div class="alert alert-danger text-center">
                    Data tidak ditemukan.
                </div>
            <?php else: ?>

                <!-- Informasi Pemesan -->
                <div class="mb-4">
                    <h5 class="fw-bold">Informasi Pemesan</h5>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>Nama Pemesan</th>
                            <td><?= htmlspecialchars($order['user_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Kode Rental</th>
                            <td><?= htmlspecialchars($order['rental_code'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Sewa</th>
                            <td><?= htmlspecialchars($order['start_date'] ?? '-') ?> s/d <?= htmlspecialchars($order['end_date'] ?? '-') ?></td>
                        </tr>
                        
                    </table>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="mb-4">
                    <h5 class="fw-bold">Informasi Pembayaran</h5>

                    <?php if (!empty($order['id'])): ?>
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th>ID Pembayaran</th>
                                <td><?= htmlspecialchars($order['id']) ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Pembayaran</th>
                                <td><?= htmlspecialchars($order['rental_type'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th>Total Pembayaran</th>
                                <td>Rp <?= number_format($order['total_amount'] ?? 0, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                            <th>Status</th>
                            <td>
                                <?php if ($order['payment_status'] === 'paid'): ?>
                                    <span class="badge bg-success"><?= htmlspecialchars($order['status']) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-danger"><?= htmlspecialchars($order['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            
                        </tr>
                        <tr>
                            <?php if($order['payment_method'] == 'transer') : ?>
                                <th>Bukti</th>
                                <td> 
                                    <img src="data:image/jpeg;base64,<?= base64_encode($order['bukti']) ?>"  class="w-100 object-fit-cover">
                                </td>
                            <?php else : ?>
                                <th>Pembayaran</th>
                                <td> 
                                    COD
                                </td>
                            <?php endif; ?>

                        </tr>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-secondary">
                            Belum ada pembayaran yang dilakukan untuk pesanan ini.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tombol Aksi -->
                <div class="text-end">
                    <?php if($order['payment_method'] == 'transfer') : ?>
                        <?php if ($order['bus_status'] === 'pending' || $order['payment_status'] === 'unpaid'): ?>
                        <form action="/tolak/<?= $order['bus_id'] ?>"  style="display:inline;">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Tolak Pesanan
                            </button>
                        </form>  
                    <?php elseif ($order['bus_status'] === 'wait_confirmation' && $order['payment_status'] === 'paid'): ?>
                        <form action="/confirm/<?= $order['bus_id'] ?>" style="display:inline;">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-x-octagon"></i> Konfirmasi Pesanan
                            </button>
                        </form>
                    <?php endif; ?>
                    <?php elseif($order['payment_method'] == 'cash') : ?>
                         <form action="/tolak/<?= $order['bus_id'] ?>"  style="display:inline;">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Tolak Pesanan
                            </button>
                        </form>   
                        <form action="/confirm/<?= $order['bus_id'] ?>" style="display:inline;">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-x-octagon"></i> Konfirmasi Pesanan
                            </button>
                        </form>
                    <?php else : ?>
                        <form action="/tolak/<?= $order['bus_id'] ?>"  style="display:inline;">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Tolak Pesanan
                            </button>
                        </form>
                    <?php endif; ?>
                    
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>
