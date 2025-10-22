<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\models\Bus;

class BusController extends Controller
{
    public function index()
    {
        $data = Bus::all();
        return $this->view('bus.index', ['data' => $data], 'layout.index');
    }

    public function add()
    {
        return $this->view('bus.add', [], 'layout.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'        => 'required|min:3|max:100',
            'image'       => 'required|maxsize:2048',
            'capacity'    => 'required',
            'price'       => 'required',
            'description' => 'required|min:5',
            'status'      => 'required'
        ];

        if (!$request->validate($rules)) {
            return $this->view('bus.add', [
                'errors' => $request->getErrors(),
                'old' => $request->input()
            ], 'layout.index');
        }

        $imageData = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageData = file_get_contents($imageTmpPath);
        }

        Bus::create([
            'name'        => $request->input('name'),
            'image'       => $imageData,
            'capacity'    => $request->input('capacity'),
            'price'       => $request->input('price'),
            'description' => $request->input('description'),
            'status'      => $request->input('status')
        ]);

        $_SESSION['success'] = "Bus berhasil ditambahkan!";
        return $this->redirect('/data-bus');
    }

    public function edit($id)
    {
        $bus = Bus::where('id', '=', $id)->first();
        if (!$bus) {
            echo "Data bus tidak ditemukan.";
            return;
        }

        return $this->view('bus.edit', ['bus' => $bus], 'layout.index');
    }

    // 🟢 Update Data
    public function update(Request $request)
    {
        $id = $request->input('id');

        $bus = Bus::where('id', '=', $id)->first();
        if (!$bus) {
            echo "Data bus tidak ditemukan.";
            return;
        }

        $rules = [
            'name'        => 'required|min:3|max:100',
            'capacity'    => 'required',
            'price'       => 'required',
            'description' => 'required|min:5',
            'status'      => 'required'
        ];

        if (!$request->validate($rules)) {
            return $this->view('bus.edit', [
                'errors' => $request->getErrors(),
                'bus' => $bus
            ], 'layout.index');
        }

        $imageData = $bus->image; 

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];

            // Validasi ukuran 2MB
            if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = "Ukuran gambar maksimal 2MB!";
                return $this->view('bus.edit', ['bus' => $bus], 'layout.index');
            }

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

        $_SESSION['success'] = "Data bus berhasil diperbarui!";
        return $this->redirect('/data-bus');
    }

    public function delete($id)
    {
        Bus::delete($id);

        $_SESSION['success'] = "Data bus berhasil Dihapus!";
        return $this->redirect('/data-bus');
    }
}
