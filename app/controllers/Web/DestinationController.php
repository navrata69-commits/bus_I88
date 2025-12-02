<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\models\Destination;
use bus\Project\models\DestinationDetail;

class DestinationController extends Controller
{
    public function index()
    {
        $data = Destination::all();
        return $this->view('destination.index', ['data' => $data], 'layout.index');
    }

    public function add()
    {
        return $this->view('destination.add', [], 'layout.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:150',
            'description' => 'required|min:5'
        ];

        if (!$request->validate($rules)) {
            return $this->view('destination.add', [
                'errors' => $request->getErrors(),
                'old' => $request->input()
            ], 'layout.index');
        }

        // Simpan data utama
        $idDestination = Destination::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        // Simpan data wisata (tour)
        $tours = $request->input('tour');
        if (!empty($tours)) {
            foreach ($tours as $tourName) {
                DestinationDetail::create([
                    'id_destinations' => $idDestination,
                    'tour' => $tourName
                ]);
            }
        }

        $_SESSION['success'] = "Tujuan dan daftar wisata berhasil ditambahkan!";
        return $this->redirect('/data-destination');
    }

    public function edit($id)
    {
        $destination = Destination::where('id', '=', $id)->first();
        if (!$destination) {
            echo "Data tujuan tidak ditemukan.";
            return;
        }

        // Ambil semua wisata terkait
        $destinationDetails = DestinationDetail::where('id_destinations', '=', $id)->get();

        return $this->view('destination.edit', [
            'destination' => $destination,
            'destinationDetails' => $destinationDetails
        ], 'layout.index');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        $destination = Destination::where('id', '=', $id)->first();
        if (!$destination) {
            echo "Data tujuan tidak ditemukan.";
            return;
        }

        $rules = [
            'name' => 'required|min:3|max:150',
            'description' => 'required|min:5'
        ];

        if (!$request->validate($rules)) {
            $destinationDetails = DestinationDetail::where('id_destinations', '=', $id)->get();

            return $this->view('destination.edit', [
                'errors' => $request->getErrors(),
                'destination' => $destination,
                'destinationDetails' => $destinationDetails
            ], 'layout.index');
        }

        // Update data utama
        Destination::update($id, [
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        // Hapus semua data wisata lama
        DestinationDetail::deleteWhere('id_destinations', $id);

        // Tambahkan wisata baru
        $tours = $request->input('tour');
        if (!empty($tours)) {
            foreach ($tours as $tourName) {
                DestinationDetail::create([
                    'id_destinations' => $id,
                    'tour' => $tourName
                ]);
            }
        }

        $_SESSION['success'] = "Data tujuan berhasil diperbarui!";
        return $this->redirect('/data-destination');
    }

    public function delete($id)
    {
        // Hapus semua detail wisata terkait
        DestinationDetail::deleteWhere('id_destinations', $id);

        // Hapus tujuan
        Destination::delete($id);

        $_SESSION['success'] = "Data tujuan berhasil dihapus!";
        return $this->redirect('/data-destination');
    }
}
