<div class="container-fluid px-4">

    <h1 class="mt-4">Dashboard</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard Overview</li>
    </ol>

    <!-- ====== TOP CARDS ====== -->
    <div class="row">

        <!-- TOTAL USERS -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h3><?= $totalUsers ?></h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <!-- TOTAL BUS -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h5>Total Bus</h5>
                    <h3><?= $totalBus ?></h3>
                    <small>Available: <?= $totalAvailableBus ?> | Unavailable: <?= $totalUnavailableBus ?></small>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <!-- TOTAL ORDERS -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5>Total Orders</h5>
                    <h3><?= $totalOrders ?></h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <!-- TOTAL INCOME -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h5>Total Income</h5>
                    <h3>Rp <?= number_format($totalIncome, 0, ',', '.') ?></h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

    </div>

    <div class="card mb-4">
    <div class="card-header">
        Generate Laporan PDF
    </div>
    <div class="card-body">
        <form action="/dashboard/report" method="POST" class="row g-3">

            <div class="col-md-4">
                <label>Dari Tanggal</label>
                <input type="date" name="start" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label>Sampai Tanggal</label>
                <input type="date" name="end" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label>&nbsp;</label><br>
                <button class="btn btn-danger w-100">
                    <i class="fas fa-file-pdf"></i> Generate PDF
                </button>
            </div>

        </form>
    </div>
</div>


    <!-- ====== CHARTS ====== -->
    <div class="row">

        <!-- ORDER CHART -->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Monthly Orders
                </div>
                <div class="card-body">
                    <canvas id="ordersChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>

        <!-- INCOME CHART -->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Monthly Income
                </div>
                <div class="card-body">
                    <canvas id="incomeChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ======================= -->
<!--   CHART.JS SCRIPTS     -->
<!-- ======================= -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // ===== ORDERS PER MONTH =====
    const orderLabels = <?= json_encode(array_column($ordersPerMonth, 'month')) ?>;
    const orderData = <?= json_encode(array_column($ordersPerMonth, 'total')) ?>;

    const ctxOrders = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctxOrders, {
        type: 'line',
        data: {
            labels: orderLabels,
            datasets: [{
                label: 'Orders',
                data: orderData,
                fill: true,
                tension: 0.3
            }]
        }
    });

    // ===== INCOME PER MONTH =====
    const incomeLabels = <?= json_encode(array_column($incomePerMonth, 'month')) ?>;
    const incomeData = <?= json_encode(array_column($incomePerMonth, 'total')) ?>;

    const ctxIncome = document.getElementById('incomeChart').getContext('2d');
    new Chart(ctxIncome, {
        type: 'bar',
        data: {
            labels: incomeLabels,
            datasets: [{
                label: 'Income',
                data: incomeData
            }]
        }
    });
</script>
