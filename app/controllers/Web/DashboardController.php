<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL USERS
        $totalUsers = DB::table('users')->select(['COUNT(*) as total'])->first()['total'];

        // TOTAL BUS
        $totalBus = DB::table('buses')->select(['COUNT(*) as total'])->first()['total'];

        // BUS AVAILABLE
        $totalAvailableBus = DB::table('buses')
            ->where('status', '=', 'available')
            ->select(['COUNT(*) as total'])
            ->first()['total'];

        // BUS UNAVAILABLE
        $totalUnavailableBus = DB::table('buses')
            ->where('status', '=', 'unavailable')
            ->select(['COUNT(*) as total'])
            ->first()['total'];

        // TOTAL RENTAL ORDER
        $totalOrders = DB::table('bus_rentals')
            ->select(['COUNT(*) as total'])
            ->first()['total'];

        // TOTAL PENDAPATAN
        $totalIncome = DB::table('rental_payments')
            ->select(['SUM(total_amount) as total'])
            ->first()['total'] ?? 0;

        // GRAFIK ORDER PER BULAN
        $ordersPerMonth = DB::table('bus_rentals')
            ->select([
                "MONTH(date) as month",
                "COUNT(*) as total"
            ])
            ->groupBy(['MONTH(date)'])
            ->orderByRaw("MONTH(date) ASC")
            ->get();

        // GRAFIK PENDAPATAN PER BULAN
        $incomePerMonth = DB::table('rental_payments')
            ->select([
                "MONTH(created_at) as month",
                "SUM(total_amount) as total"
            ])
            ->groupBy(['MONTH(created_at)'])
            ->orderByRaw("MONTH(created_at) ASC")
            ->get();

        return $this->view('dashboard.index', [
            'totalUsers' => $totalUsers,
            'totalBus' => $totalBus,
            'totalAvailableBus' => $totalAvailableBus,
            'totalUnavailableBus' => $totalUnavailableBus,
            'totalOrders' => $totalOrders,
            'totalIncome' => $totalIncome,
            'ordersPerMonth' => $ordersPerMonth,
            'incomePerMonth' => $incomePerMonth
        ], 'layout.index');
    }



public function generateReport()
{
    $start = $_POST['start'] ?? null;
    $end   = $_POST['end'] ?? null;

    if (!$start || !$end) {
        return $this->redirect('/dashboard');
    }

    // ===============================
    // 1. Ambil Data TOUR RENTALS
    // ===============================
    $tourRentals = DB::table('tour_rentals')
        ->join('users', 'tour_rentals.user_id', '=', 'users.id')
        ->select(['users.name as nama_user', 'tour_rentals.*'])
        ->whereRaw("date BETWEEN '$start' AND '$end'")
        ->get();

    // ===============================
    // 2. Ambil Data BUS RENTALS
    // ===============================
    $busRentals = DB::table('bus_rentals')
        ->join('users', 'bus_rentals.user_id', '=', 'users.id')
        ->select(['users.name as nama_user', 'bus_rentals.*'])
        ->whereRaw("date BETWEEN '$start' AND '$end'")
        ->get();

    // ===============================
    // 3. Total Income (payment)
    // ===============================
    $income = DB::table('rental_payments')
        ->select(["SUM(total_amount) as total"])
        ->whereRaw("created_at BETWEEN '$start' AND '$end'")
        ->first()['total'] ?? 0;

    // ===============================
    // Render PDF
    // ===============================
    $html = $this->loadPdf('dashboard.report', [
        'start'        => $start,
        'end'          => $end,
        'tourRentals'  => $tourRentals,
        'busRentals'   => $busRentals,
        'income'       => $income
    ]);

    $options = new Options();
    $options->set('defaultFont', 'Helvetica');

    $dompdf = new Dompdf($options);
    ob_clean();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("laporan-$start-$end.pdf", ["Attachment" => false]);
    exit;
}

}