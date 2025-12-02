<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\models\Bus;
use bus\Project\models\Feature;

class FeatureController extends Controller
{
    public function index()
    {
        $data = Feature::all();
        return $this->view('bus_feature.index', ['data' => $data], 'layout.index');
    }

    public function add()
    {
        return $this->view('bus_feature.add', [], 'layout.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'feature' => 'required|min:1|max:50'
        ];

        if (!$request->validate($rules)) {
            $busList = Bus::all();
            return $this->view('bus_feature.add', [
                'errors'  => $request->getErrors(),
                'busList' => $busList,
                'old'     => $request->input()
            ], 'layout.index');
        }

        Feature::create([
            'feature' => $request->input('feature')
        ]);

        $_SESSION['success'] = "Fitur bus berhasil ditambahkan!";
        return $this->redirect('/data-fitur-bus');
    }

    public function edit($id)
    {
        $feature = Feature::where('id', '=', $id)->first();
        if (!$feature) {
            echo "Data tidak ditemukan.";
            return;
        }
        return $this->view('bus_feature.edit', [
            'feature' => $feature
        ], 'layout.index');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $feature = Feature::where('id', '=', $id)->first();

        if (!$feature) {
            echo "Data tidak ditemukan.";
            return;
        }

        $rules = [
            'feature' => 'required|min:1|max:50'
        ];

        if (!$request->validate($rules)) {
            return $this->view('bus_feature.edit', [
                'errors'  => $request->getErrors(),
                'feature' => $feature
            ], 'layout.index');
        }

        Feature::update($id, [
            'feature' => $request->input('feature')
        ]);

        $_SESSION['success'] = "Fitur bus berhasil diperbarui!";
        return $this->redirect('/data-fitur-bus');
    }

    public function delete($id)
    {
        Feature::delete($id);
        $_SESSION['success'] = "Fitur bus berhasil dihapus!";
        return $this->redirect('/data-fitur-bus');
    }
}
