<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\models\TourPackage;
use bus\Project\models\Bus;
use bus\Project\models\Destination;
use bus\Project\models\TourPackageBus;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::allWithDestination();
        return $this->view('tour_packages.index', ['data' => $packages], 'layout.index');
    }

    public function create()
    {
        $buses = Bus::all();
        $destinations = Destination::all();
        return $this->view('tour_packages.add', [
            'buses' => $buses,
            'destinations' => $destinations
        ], 'layout.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'destination_id' => 'required',
            'name' => 'required|min:3|max:100',
            'duration_days' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'fixed_capacity' => 'required',
            'fixed_price' => 'required',
            'description' => 'required|min:5'
        ];

        if (!$request->validate($rules)) {
            $buses = Bus::all();
            $destinations = Destination::all();
            return $this->view('tour_packages.add', [
                'errors' => $request->getErrors(),
                'old' => $request->input(),
                'buses' => $buses,
                'destinations' => $destinations
            ], 'layout.index');
        }

        $imageData = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = "Ukuran gambar maksimal 2MB!";
                return $this->redirect('/tour-packages/add');
            }
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
        }

        $packageId = TourPackage::create([
            'destination_id' => $request->input('destination_id'),
            'name' => $request->input('name'),
            'image' => $imageData,
            'duration_days' => $request->input('duration_days'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'fixed_capacity' => $request->input('fixed_capacity'),
            'fixed_price' => $request->input('fixed_price'),
            'description' => $request->input('description')
        ]);

        if (!empty($_POST['buses']) && is_array($_POST['buses'])) {
            foreach ($_POST['buses'] as $busId) {
                TourPackageBus::create([
                    'tour_packages_id' => $packageId,
                    'bus_id' => $busId
                ]);
            }
        }

        $_SESSION['success'] = "Tour package berhasil ditambahkan!";
        return $this->redirect('/tour-packages');
    }

    public function edit($id)
    {
        $package = TourPackage::where('id', '=', $id)->first();
        $buses = Bus::all();
        $destinations = Destination::all();
        $selectedBuses = array_column(TourPackageBus::where('tour_packages_id', '=', $id)->get(), 'bus_id');

        return $this->view('tour_packages.edit', [
            'package' => $package,
            'buses' => $buses,
            'destinations' => $destinations,
            'selectedBuses' => $selectedBuses
        ], 'layout.index');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $package = TourPackage::where('id', '=', $id)->first();

        if (!$package) {
            $_SESSION['error'] = "Paket wisata tidak ditemukan.";
            return $this->redirect('/tour-packages');
        }

        $rules = [
            'destination_id' => 'required',
            'name'           => 'required|min:3|max:100',
            'duration_days'  => 'required',
            'fixed_capacity' => 'required',
            'fixed_price'    => 'required'
        ];

        if (!$request->validate($rules)) {
            $destinations = Destination::all();
            $buses = Bus::all();
            $selectedBuses = array_column(
                TourPackageBus::where('tour_packages_id', '=', $id)->get(),
                'bus_id'
            );

            return $this->view('tour_packages.edit', [
                'package' => $package,
                'destinations' => $destinations,
                'buses' => $buses,
                'selectedBuses' => $selectedBuses,
                'errors' => $request->getErrors()
            ], 'layout.index');
        }

        // Handle gambar
        $imageData = $package->image;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = "Ukuran gambar maksimal 2MB!";
                return $this->redirect('/tour-packages/edit/' . $id);
            }
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageData = file_get_contents($imageTmpPath);
        }

        // Update data paket wisata
        TourPackage::update($id, [
            'destination_id' => $request->input('destination_id'),
            'name'           => $request->input('name'),
            'duration_days'  => $request->input('duration_days'),
            'start_date'     => $request->input('start_date'),
            'end_date'       => $request->input('end_date'),
            'fixed_capacity' => $request->input('fixed_capacity'),
            'fixed_price'    => $request->input('fixed_price'),
            'description'    => $request->input('description'),
            'image'          => $imageData
        ]);

        // Update relasi bus
        TourPackageBus::deleteWhere('tour_packages_id', $id);
        if (!empty($_POST['buses']) && is_array($_POST['buses'])) {
            foreach ($_POST['buses'] as $busId) {
                TourPackageBus::create([
                    'tour_packages_id' => $id,
                    'bus_id' => $busId
                ]);
            }
        }

        $_SESSION['success'] = "Paket wisata berhasil diperbarui!";
        return $this->redirect('/tour-packages');
    }


    public function destroy($id)
    {
        TourPackageBus::deleteWhere('tour_packages_id', $id);
        TourPackage::delete($id);
        $_SESSION['success'] = "Tour package berhasil dihapus!";
        return $this->redirect('/tour-packages');
    }
}
