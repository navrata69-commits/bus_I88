<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\DB;
use bus\Project\models\Destination;

class HomeController extends Controller
{
    public function index()
    {
        $db = DB::table('buses')
            ->join('bus_feature', 'buses.id', '=', 'bus_feature.id_bus')
            ->join('feature', 'bus_feature.id_feature', '=', 'feature.id')
            ->leftJoin('bus_rating', 'buses.id', '=', 'bus_rating.bus_id')
            ->select([
                'buses.id',
                'buses.name',
                'buses.image',
                'buses.capacity',
                'buses.price',
                'buses.description',
                'buses.type_bus',
                'GROUP_CONCAT(DISTINCT feature.feature) AS features',
                'AVG(bus_rating.rating) AS avg_rating',
                'COUNT(bus_rating.id) AS rating_count'
            ])->groupBy('buses.id')->limit(3)->get();
            
        $destinasi = Destination::all();
        return $this->view('home.index', ['data' => $destinasi, 'datas' => $db]);
    }

    public function ArmadaBus()
    {
        $db = DB::table('buses')
            ->join('bus_feature', 'buses.id', '=', 'bus_feature.id_bus')
            ->join('feature', 'bus_feature.id_feature', '=', 'feature.id')
            ->leftJoin('bus_rating', 'buses.id', '=', 'bus_rating.bus_id')
            ->select([
                'buses.id',
                'buses.name',
                'buses.image',
                'buses.capacity',
                'buses.price',
                'buses.description',
                'buses.type_bus',
                'GROUP_CONCAT(DISTINCT feature.feature) AS features',
                'AVG(bus_rating.rating) AS avg_rating',
                'COUNT(bus_rating.id) AS rating_count'
            ]);

        $search = $_GET['search'] ?? null;
        $type   = $_GET['type'] ?? null;
        $sort   = $_GET['sort'] ?? null;

        if (!empty($search)) {
            $db->havingRaw(
                "(buses.name LIKE :search OR GROUP_CONCAT(DISTINCT feature.feature) LIKE :search)",
                [':search' => "%$search%"]
            );
        }

        if (!empty($type)) {
            $db->where('buses.type_bus', '=', $type);
        }

        $db->groupBy('buses.id');

        if ($sort === 'rating') {
            $db->orderByRaw('avg_rating DESC');
        } elseif ($sort === 'price_asc') {
            $db->orderBy('buses.price', 'ASC');
        } elseif ($sort === 'price_desc') {
            $db->orderBy('buses.price', 'DESC');
        }



        $data = $db->get();

        return $this->view('home.armada-bus', ['datas' => $data]);
    }


    public function PaketWisata()
    {
        $destination = isset($_GET['destination']) ? $_GET['destination'] : null;
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        $capacity = isset($_GET['capacity']) ? $_GET['capacity'] : null;

        $db = DB::table('tour_packages')
            ->join('destinations', 'tour_packages.destination_id', '=', 'destinations.id')
            ->leftJoin('detail_destinatiion', 'destinations.id', '=', 'detail_destinatiion.id_destinations')
            ->leftJoin('tour_packages_rating', 'tour_packages.id', '=', 'tour_packages_rating.tour_packages_id')
            ->select([
                'tour_packages.id',
                'tour_packages.name',
                'tour_packages.image',
                'tour_packages.duration_days',
                'tour_packages.fixed_capacity',
                'tour_packages.fixed_price',
                'tour_packages.description',
                'destinations.name AS destination_name',
                'GROUP_CONCAT(detail_destinatiion.tour SEPARATOR ", ") AS tours',
                'COALESCE(AVG(tour_packages_rating.rating), 0) AS avg_rating',
                'COUNT(tour_packages_rating.id) AS rating_count'
            ])
            ->groupBy('tour_packages.id');

            if ($destination) {
                $db->where('tour_packages.destination_id', '=', $destination);
            }

            if ($date) {
                // asumsi tabel punya kolom start_date
                $db->where('tour_packages.start_date', '=', $date);
            }

            if ($capacity) {
                $capacityNum = (int) filter_var($capacity, FILTER_SANITIZE_NUMBER_INT);
                $db->where('tour_packages.fixed_capacity', '>=', $capacityNum);
            }

            $pakets = $db->get();

        return $this->view('home.paket-wisata', ['pakets' => $pakets]);
    }

    public function Promo()
    {
        $db = DB::table('promo')
            ->select(['id', 'name', 'code', 'start_date', 'end_date', 'slot'])
            ->get();

        return $this->view('home.promo', ['promos' => $db]);
    }

    public function KontakKami()
    {
        return $this->view('home.tentang-kami');
    }


}