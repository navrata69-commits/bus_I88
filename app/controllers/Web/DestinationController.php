<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\models\Destination;

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

        Destination::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $_SESSION['success'] = "Tujuan berhasil ditambahkan!";
        return $this->redirect('/data-destination');
    }

    public function edit($id)
    {
        $destination = Destination::where('id', '=', $id)->first();
        if (!$destination) {
            echo "Data tujuan tidak ditemukan.";
            return;
        }

        return $this->view('destination.edit', ['destination' => $destination], 'layout.index');
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
            return $this->view('destination.edit', [
                'errors' => $request->getErrors(),
                'destination' => $destination
            ], 'layout.index');
        }

        Destination::update($id, [
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $_SESSION['success'] = "Data tujuan berhasil diperbarui!";
        return $this->redirect('/data-destination');
    }

    public function delete($id)
    {
        Destination::delete($id);

        $_SESSION['success'] = "Data tujuan berhasil dihapus!";
        return $this->redirect('/data-destination');
    }
}
