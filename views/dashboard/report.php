<style>
    body { font-family: Arial, sans-serif; font-size: 12px; }
    h2 { margin-bottom: 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    table, th, td { border: 1px solid #444; }
    th, td { padding: 5px; text-align: left; }
    .section-title { margin-top: 20px; font-size: 16px; font-weight: bold; }
</style>

<h2>Laporan Penyewaan Bus</h2>
<p>Periode: <b><?= $start ?></b> sampai <b><?= $end ?></b></p>

<!-- ================= TOUR RENTALS ================= -->
<div class="section-title">1. Tour Rentals</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($tourRentals as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_user'] ?></td>
            <td><?= $row['rental_code'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!-- ================= BUS RENTALS ================= -->
<div class="section-title">2. Bus Rentals</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Bus</th>
            <th>Tanggal</th>
            <th>Durasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($busRentals as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_user'] ?></td>
            <td><?= $row['rental_code'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?> hari</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!-- ================= INCOME ================= -->
<div class="section-title">3. Pendapatan</div>
<h3>Total Income: Rp <?= number_format($income, 0, ',', '.') ?></h3>
