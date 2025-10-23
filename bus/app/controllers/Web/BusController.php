<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\models\Bus;
use bus\Project\models\Feature;
use bus\Project\models\BusFeature;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return $this->view('bus.index', ['data' => $buses], 'layout.index');
    }

    public function add()
    {
        $features = Feature::all();
        return $this->view('bus.add', [
            'features' => $features
        ], 'layout.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'        => 'required|min:3|max:100',
            'capacity'    => 'required',
            'price'       => 'required',
            'description' => 'required|min:5',
            'status'      => 'required'
        ];

        if (!$request->validate($rules)) {
            $features = Feature::all();
            return $this->view('bus.add', [
                'errors' => $request->getErrors(),
                'old' => $request->input(),
                'features' => $features
            ], 'layout.index');
        }

        $imageData = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = "Ukuran gambar maksimal 2MB!";
                return $this->redirect('/tambah-data-bus');
            }
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageData = file_get_contents($imageTmpPath);
        }

        $busId = Bus::create([
            'name'        => $request->input('name'),
            'image'       => $imageData,
            'capacity'    => $request->input('capacity'),
            'price'       => $request->input('price'),
            'description' => $request->input('description'),
            'status'      => $request->input('status')
        ]);

        // Simpan fitur bus
        if (!empty($_POST['features']) && is_array($_POST['features'])) {
            foreach ($_POST['features'] as $featureId) {
                BusFeature::create([
                    'id_bus' => $busId,
                    'id_feature' => $featureId
                ]);
            }
        }

        $_SESSION['success'] = "Bus berhasil ditambahkan!";
        return $this->redirect('/data-bus');
    }

    public function edit($id)
    {
        $bus = Bus::where('id', '=', $id)->first();
        $features = Feature::all();

        $busFeatures = BusFeature::where('id_bus', '=', $id)->get();
        $selectedFeatures = array_column($busFeatures, 'id_feature');

        return $this->view('bus.edit', [
            'bus' => $bus,
            'features' => $features,
            'selectedFeatures' => $selectedFeatures
        ], 'layout.index');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $bus = Bus::where('id', '=', $id)->first();

        if (!$bus) {
            $_SESSION['error'] = "Data bus tidak ditemukan.";
            return $this->redirect('/data-bus');
        }

        $rules = [
            'name'        => 'required|min:3|max:100',
            'capacity'    => 'required',
            'price'       => 'required',
            'description' => 'required|min:5',
            'status'      => 'required'
        ];

        if (!$request->validate($rules)) {
            $features = Feature::all();
            $busFeatures = BusFeature::where('id_bus', '=', $id)->get();
            $selectedFeatures = array_column($busFeatures, 'id_feature');
            return $this->view('bus.edit', [
                'bus' => $bus,
                'features' => $features,
                'selectedFeatures' => $selectedFeatures,
                'errors' => $request->getErrors()
            ], 'layout.index');
        }

        $imageData = $bus->image;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = "Ukuran gambar maksimal 2MB!";
                return $this->redirect('/edit-data-bus?id=' . $id);
            }
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageData = file_get_contents($imageTmpPath);
        }

        Bus::update($id, [
            'name'        => $request->input('name'),
            'image'       => $imageData,
            'capacity'    => $request->input('capacity'),
            'price'       => $request->input('price'),
            'description' => $request->input('description'),
            'status'      => $request->input('status')
        ]);

        BusFeature::deleteWhere('id_bus', $id);
        if (!empty($_POST['features']) && is_array($_POST['features'])) {
            foreach ($_POST['features'] as $featureId) {
                BusFeature::create([
                    'id_bus' => $id,
                    'id_feature' => $featureId
                ]);
            }
        }

        $_SESSION['success'] = "Data bus berhasil diperbarui!";
        return $this->redirect('/data-bus');
    }

    public function delete($id)
    {
        BusFeature::deleteWhere('id_bus', $id);
        Bus::delete($id);
        $_SESSION['success'] = "Data bus berhasil dihapus!";
        return $this->redirect('/data-bus');
    }
}
