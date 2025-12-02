<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\DB;
use bus\Project\core\Request;
use bus\Project\core\Session;
use bus\Project\core\Validation;
use bus\Project\models\Bus;
use bus\Project\models\BusRental;
use bus\Project\models\BusRentalDetail;
use bus\Project\models\Payment;
use bus\Project\models\Promo;
use bus\Project\models\TourPackage;
use bus\Project\models\TourRental;
use DateTime;
use ReturnTypeWillChange;

class TransactionController extends Controller 
{
    public function indexBus()
    {
        if (!Session::get('user')) {
            return $this->redirect('/login');
        }

        $buses = Bus::where('status', '=', 'available')->get();

        return $this->view('home.booking-bus', ['buses' => $buses]);
    }
    public function indexBusCreate(Request $request)
    {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /login');
            exit;
        }
        $data = [
            'bus_ids'    => $request->input('bus_ids'),
            'start_date' => $request->input('start_date'),
            'end_date'   => $request->input('end_date'),
        ];

        $validator = new Validation();
        $isValid = $validator->validate($data, [
            'bus_ids'    => 'required',
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);

        if (!empty($data['start_date']) && !empty($data['end_date'])) {
            if (strtotime($data['end_date']) < strtotime($data['start_date'])) {
                $validator->errors()['end_date'][] = 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.';
            }
        }

        if (!$isValid || !empty($validator->errors())) {
            Session::set('errors', $validator->errors());
            header('Location: /booking-bus');
            exit;
        }

        $start = new \DateTime($data['start_date']);
        $end = new \DateTime($data['end_date']);
        $days = $start->diff($end)->days + 1;

        $buses = Bus::whereIn('id', $data['bus_ids'])->get();
        $totalPrice = 0;

        foreach ($buses as $bus) {
            $totalPrice += ($bus->price * $days);
        }

        $rentalCode = 'RB-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 5));

        $id = BusRental::create([
            'user_id'     => $user['id'],
            'rental_code' => $rentalCode,
            'start_date'  => $data['start_date'],
            'end_date'    => $data['end_date'],
            'total_days'  => $days,
            'total_price' => $totalPrice,
            'date'        => date('Y-m-d H:i:s'),
            'status'      => 'pending'
        ]);

        foreach ($buses as $bus) {
            BusRentalDetail::create([
                'bus_rentals_id' => $id,
                'bus_id'        => $bus->id,
                'price' => $bus->price
            ]);

            Bus::update($bus->id, [
                'status' => 'unavailable'
            ]);
        }

        Session::set('success', 'Pesanan bus Anda berhasil dibuat!, Silahkan Lunasi Pembayaran Di Halaman Pesanan Saya');
        return $this->redirect('/booking-bus');
    }

    public function pesananSayaBus()
    {
        $user = Session::get('user');

        $userId = $user['id'];

        $busOrders = BusRental::where('user_id', '=', $userId)->get();

        return $this->view('home.pesanan-saya', ['bus' => $busOrders]);
    }

    public function pesananSayaTour()
    {
        $user = Session::get('user');

        $userId = $user['id'];

        $tourOrders = TourRental::where('user_id', '=', $userId)->get();
        
        return $this->view('home.pesanan-saya2', ['tour' => $tourOrders]);
    }

    public function pelunasanBus($id)
    {
        $data = BusRental::where('id', '=', $id)->first();

        return $this->view('home.pelunasan-bus', ['order' => $data]);
    }

    public function storePembayaran(Request $request)
    {
        $data = [
            'rental_id'      => $request->input('rental_id'),
            'payment_method' => $request->input('payment_method'),
            'amount'         => $request->input('amount'),
            'promo_code'     => $request->input('promo_code'),
        ];

        $rules = [
            'rental_id'      => 'required',
            'payment_method' => 'required',
        ];

        if (!$request->validate($rules)) {
            return $this->view('pelunasan-bus', [
                'errors' => $request->getErrors(),
                'old'    => $request->input(),
            ]);
        }
        
        $id = BusRental::where('id', '=', $data['rental_id'])->first();
        $amount = $id->total_price;
        $promo = Promo::where('code', '=', $data['promo_code'])->first();

        if (!empty($data['promo_code'])) {

        if ($promo) {
                $today = new DateTime(date('Y-m-d'));
                $start_date = new DateTime($promo->start_date);
                $end_date = new DateTime($promo->end_date);

                if ($today < $start_date) {
                    Session::set('errors', [['Kode promo belum dimulai atau sudah tidak berlaku (masa promo berakhir).']]);
                    return $this->redirect('/pelunasan-bus/' . $data['rental_id']);
                }

                if (isset($promo->slot) && $promo->slot <= 0) {
                    Session::set('errors', [['Kode promo sudah habis digunakan (slot 0).']]);
                    return $this->redirect('/pelunasan-bus/' . $data['rental_id']);
                }

                $discountValue = min($promo->amount, $amount);
                $amount -= $discountValue;

                if (isset($promo->slot)) {
                    Promo::update($promo->id, [
                        'slot' => $promo->slot - 1
                    ]);
                }

            } else {
                Session::set('errors', [['Kode promo tidak ditemukan.']]);
                return $this->redirect('/pelunasan-bus/' . $data['rental_id']);
            }
        }

        $paymentCode = 'PAY-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));

        $paymentId = Payment::create([
            'payment_code'   => $paymentCode,
            'rental_type'    => 'bus',
            'rental_id'      => $id->id,
            'amount'         => $id->total_price,
            'payment_method' => $data['payment_method'],
            'promo'          => $promo->amount ?? null,
            'total_amount'   => $amount
        ]);

        BusRental::update($id->id, [
            'status' => 'wait_confirmation',    
            'total_price' => $amount
        ]);

        return $this->redirect('/transfer-page/' . $paymentId);
    }

    public function pelunasanUpload(Request $request)
    {
        $rules = [
            'payment_id' => 'required'
        ];

        if (!$request->validate($rules)) {
            Session::set('errors', $request->getErrors());
            return $this->redirect('/transfer-page/' . $request->input('payment_id'));
        }

        $paymentId = $request->input('payment_id');
        $imageData = null;

        if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
            if ($_FILES['bukti']['size'] > 2 * 1024 * 1024) {
                Session::set('errors', [['Ukuran gambar maksimal 2MB!']]);
                return $this->redirect('/transfer-page/' . $paymentId);
            }

            $imageTmpPath = $_FILES['bukti']['tmp_name'];
            $imageData = file_get_contents($imageTmpPath);
        } else {
            Session::set('errors', [['File bukti pembayaran tidak ditemukan.']]);
            return $this->redirect('/transfer-page/' . $paymentId);
        }

        Payment::update($paymentId, [
            'bukti'  => $imageData, 
            'status' => 'paid',
        ]);

        Session::set('success', 'Bukti pembayaran berhasil diunggah. Pesanan akan segera dikonfirmasi.');
        return $this->redirect('/pesanan-saya-bus');
    }


    public function transferPage($id)
    {
        $payment = Payment::where('id', '=', $id)->first();

        return $this->view('home.transfer-page', ['payment' => $payment]);
    }

    public function indexTour()
    {
        if (!Session::get('user')) {
            return $this->redirect('/login');
        }


        $packages = TourPackage::where('start_date', '>', date('Y-m-d'))->get();

        return $this->view('home.booking-tour', ['packages' => $packages]);
    }

    public function storeTour(Request $request)
    {
        $user = Session::get('user');
        if (!$user) return $this->redirect('/login');

        $data = [
            'package_id'       => $request->input('package_id'),
            'number_of_people' => $request->input('number_of_people'),
        ];

        $validator = new Validation();
        $validator->validate($data, [
            'package_id'       => 'required',
            'number_of_people' => 'required'
        ]);

        if (!empty($validator->errors())) {
            Session::set('errors', $validator->errors());
            return $this->redirect('/booking-wisata');
        }

        $package = TourPackage::where('id', '=', $data['package_id'])->first();
        
        if (!$package) {
            Session::set('errors', [['Paket wisata tidak ditemukan.']]);
            return $this->redirect('/booking-wisata');
        }

        if ($data['number_of_people'] > $package->fixed_capacity) {
            Session::set('errors', [[
                'Jumlah orang melebihi kapasitas maksimal (' . $package->fixed_capacity . ' orang).'
            ]]);
            return $this->redirect('/booking-wisata');
        }

        $totalPrice = $package->fixed_price;

        $rentalCode = 'TR-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 5));

        TourRental::create([
            'rental_code'      => $rentalCode,
            'user_id'          => $user['id'],
            'package_id'       => $data['package_id'],
            'number_of_people' => $data['number_of_people'],
            'total_price'      => $totalPrice,
            'date'             => date('Y-m-d H:i:s'),
            'status'           => 'pending'
        ]);

        Session::set('success', 'Pesanan paket wisata berhasil dibuat!');
        return $this->redirect('/booking-wisata');
    }

    public function pelunasanTour($id)
    {
        $data = TourRental::where('id', '=' ,$id)->first();

        if (!$data) {
            return $this->redirect('/pesanan-saya-tour');
        }

        return $this->view('home.pelunasan-tour', ['order' => $data]);
    }

    public function storePembayaranTour(Request $request)
    {
        $data = [
            'rental_id'      => $request->input('rental_id'),
            'payment_method' => $request->input('payment_method'),
            'amount'         => $request->input('amount'),
            'promo_code'     => $request->input('promo_code'),
        ];

        $rules = [
            'rental_id'      => 'required',
            'payment_method' => 'required',
        ];

        if (!$request->validate($rules)) {
            Session::set('errors', $request->getErrors());
            return $this->redirect('/pelunasan-tour/' . $data['rental_id']);
        }

        $order = TourRental::where('id', '=', $data['rental_id'])->first();
        $amount = $order->total_price;
        $promo = Promo::where('code', '=' ,$data['promo_code'])->first();

        if (!empty($data['promo_code'])) {
            if ($promo) {
                $today = date('Y-m-d');

                if ($today < $promo->start_date || $today > $promo->end_date) {
                    Session::set('errors', [['Kode promo sudah tidak berlaku.']]);
                    return $this->redirect('/pelunasan-tour/' . $data['rental_id']);
                }

                if (isset($promo->slot) && $promo->slot <= 0) {
                    Session::set('errors', [['Kode promo sudah habis digunakan.']]);
                    return $this->redirect('/pelunasan-tour/' . $data['rental_id']);
                }

                $discountValue = min($promo->amount, $amount);
                $amount -= $discountValue;

                if (isset($promo->slot)) {
                    Promo::update($promo->id, ['slot' => $promo->slot - 1]);
                }
            } else {
                Session::set('errors', [['Kode promo tidak ditemukan.']]);
                return $this->redirect('/pelunasan-tour/' . $data['rental_id']);
            }
        }

        $paymentCode = 'PAYT-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));

        $paymentId = Payment::create([
            'payment_code'   => $paymentCode,
            'rental_type'    => 'tour',
            'rental_id'      => $order->id,
            'amount'         => $order->total_price,
            'payment_method' => $data['payment_method'],
            'promo'          => $promo->amount ?? null,
            'total_amount'   => $amount
        ]);

        TourRental::update($order->id, [
            'status' => 'wait_confirmation',
            'total_price' => $amount
        ]);

        return $this->redirect('/transfer-page/' . $paymentId);
    }

    public function adminListPembayaranBus()
    {
        $orders = DB::table('bus_rentals')
            ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'bus_rentals.id')
            ->join('users', 'bus_rentals.user_id', '=', 'users.id')
            ->whereIn('bus_rentals.status', ['pending', 'wait_confirmation'])
            ->select(['bus_rentals.*', 'users.name', 'rental_payments.total_amount', 'rental_payments.id as payment_id'])
            ->get();


        return $this->view('bus-transaksi.bus-belum-konfirmasi', ['orders' => $orders], 'layout.index');
    }

    public function adminDetailPembayaranBus($id)
    {
        $order = DB::table('bus_rentals')
            ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'bus_rentals.id')
            ->leftJoin('users', 'bus_rentals.user_id', '=', 'users.id')
            ->where('bus_rentals.id', '=',$id)
            ->select(['bus_rentals.*', 'rental_payments.*', 'bus_rentals.id as bus_id', 'rental_payments.id as payment_id' ,'users.name as user_name' ,'bus_rentals.status as bus_status', 'rental_payments.status as payment_status'])
            ->first();
            
        return $this->view('bus-transaksi.bus-konfirmasi-detail', [
            'order' => $order
        ], 'layout.index');
    }


    public function konfirmasiPembayaranBus($id)
    {
        BusRental::update($id, [
            'status' => 'confirmed'
        ]);

        $payment = Payment::where('rental_id', '=', $id)->first();

        if($payment->payment_method == 'transfer') {
            Payment::update($payment->id,[
                'status' => 'paid'
            ]);
        }

        Session::set('success', 'Pembayaran berhasil dikonfirmasi!');
        return $this->redirect('/bus/belum-konfirmasi');
    }

    public function tolakPembayaranBus($id)
    {
        $rental = BusRental::where('id', '=',$id)->first();
        $payment = Payment::where('rental_id', '=', $rental->id)->first();
        Payment::delete($payment->id);

        $details = BusRentalDetail::where('bus_rentals_id', '=', $rental->id)->get();

        foreach ($details as $detail) {
            Bus::update($detail->bus_id, [
                'status' => 'available'
            ]);
        }

        BusRental::delete($rental->id);

        Session::set('success', 'Pembayaran ditolak. Bus telah tersedia kembali.');
        return $this->redirect('/bus/belum-konfirmasi');
    }

    public function busAktif()
    {
        $orders = DB::table('bus_rentals')
            ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'bus_rentals.id')
            ->join('users', 'bus_rentals.user_id', '=', 'users.id')
            ->where('bus_rentals.status', '=', 'confirmed')
            ->select(['bus_rentals.*', 'users.name', 'rental_payments.total_amount', 'rental_payments.id as payment_id'])
            ->get();

        return $this->view('bus-transaksi.bus-konfirmasi', ['orders' => $orders], 'layout.index');
    }

    public function busSelesai($id)
    {
        BusRental::update($id, [
            'status' => 'completed'
        ]);

        $details = BusRentalDetail::where('bus_rentals_id', '=', $id)->get();

        foreach ($details as $detail) {
            Bus::update($detail->bus_id, [
                'status' => 'available'
            ]);
        }

        Session::set('success', 'Bus Telah Selesai Disewa');
        return $this->redirect('/bus/konfirmasi');
    }

    public function riwayatBus()
    {
        $orders = DB::table('bus_rentals')
            ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'bus_rentals.id')
            ->join('users', 'bus_rentals.user_id', '=', 'users.id')
            ->where('bus_rentals.status', '=', 'completed')
            ->select(['bus_rentals.*', 'users.name', 'rental_payments.total_amount', 'rental_payments.id as payment_id'])
            ->get();

        return $this->view('bus-transaksi.bus-selesai', ['orders' => $orders], 'layout.index');
    }

    public function adminListPembayaranTour()
{
    $orders = DB::table('tour_rentals')
        ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'tour_rentals.id')
        ->join('users', 'tour_rentals.user_id', '=', 'users.id')
        ->whereIn('tour_rentals.status',['pending', 'wait_confirmation'])
        ->select(['tour_rentals.*', 'tour_rentals.id as tour_id','tour_rentals.status as tour_status', 'users.name', 'rental_payments.total_amount', 'rental_payments.status as payment_status'])
        ->get();

    return $this->view('bus-transaksi.tour-belum-konfirmasi', ['orders' => $orders], 'layout.index');
}

public function adminDetailPembayaranTour($id)
{
    $order = DB::table('tour_rentals')
        ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'tour_rentals.id')
        ->leftJoin('users', 'tour_rentals.user_id', '=', 'users.id')
        ->where('tour_rentals.id', '=',$id)
        ->select([
            'tour_rentals.*',
            'rental_payments.*',
            'tour_rentals.id as tour_id',
            'rental_payments.id as payment_id',
            'users.name as user_name',
            'tour_rentals.status as tour_status',
            'rental_payments.status as payment_status'
        ])
        ->first();

    return $this->view('bus-transaksi.tour-konfirmasi-detail', [
        'order' => $order
    ], 'layout.index');
}

    public function konfirmasiPembayaranTour($id)
    {
        TourRental::update($id, [
            'status' => 'confirmed'
        ]);

        $payment = Payment::where('rental_id', '=', $id)->first();

        if($payment->payment_method == 'transfer') {
            Payment::update($payment->id,[
                'status' => 'paid'
            ]);
        }

        Session::set('success', 'Pembayaran berhasil dikonfirmasi!');
        return $this->redirect('/tour/belum-konfirmasi');
    }

    public function tolakPembayaranTour($id)
    {
        $rental = TourRental::where('id', '=',$id)->first();
        $payment = Payment::where('rental_id', '=',$rental->id)->first();

        Payment::delete($payment->id);
        TourRental::delete($rental->id);

        Session::set('success', 'Pembayaran ditolak dan data dihapus.');
        return $this->redirect('/tour/belum-konfirmasi');
    }

    public function tourAktif()
    {
        $orders = DB::table('tour_rentals')
            ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'tour_rentals.id')
            ->join('users', 'tour_rentals.user_id', '=', 'users.id')
            ->where('tour_rentals.status', '=', 'confirmed')
            ->select(['tour_rentals.*', 'users.name', 'rental_payments.total_amount'])
            ->get();

        return $this->view('bus-transaksi.tour-konfirmasi', ['orders' => $orders], 'layout.index');
    }

    public function tourSelesai($id)
    {
        TourRental::update($id, [
            'status' => 'completed'
        ]);

        Session::set('success', 'Tour Telah Selesai');
        return $this->redirect('/tour/konfirmasi');
    }

    public function riwayatTour()
    {
        $orders = DB::table('tour_rentals')
            ->leftJoin('rental_payments', 'rental_payments.rental_id', '=', 'tour_rentals.id')
            ->join('users', 'tour_rentals.user_id', '=', 'users.id')
            ->where('tour_rentals.status', '=', 'completed')
            ->select(['tour_rentals.*', 'users.name', 'rental_payments.total_amount'])
            ->get();

        return $this->view('bus-transaksi.tour-selesai', ['orders' => $orders], 'layout.index');
    }

}