<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promo = Promo::all();
        return $this->view('promo.index', ['promo' => $promo], 'layout.index');
    }

    public function add()
    {
        return $this->view('promo.add', [], 'layout.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:50',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required',
            'slot' => 'required'
        ];

        if (!$request->validate($rules)) {
            return $this->view('promo.add', [
                'errors' => $request->getErrors(),
                'old' => $request->input()
            ], 'layout.index');
        }

        Promo::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'amount' => $request->input('amount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'slot' => $request->input('slot')
        ]);

        $_SESSION['success'] = "Promo berhasil ditambahkan!";
        return $this->redirect('/data-promo');
    }

    public function edit($id)
    {
        $promo = Promo::where('id', '=', $id)->first();
        if (!$promo) {
            echo "Data promo tidak ditemukan.";
            return;
        }

        return $this->view('promo.edit', ['promo' => $promo], 'layout.index');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        $promo = Promo::where('id', '=', $id)->first();
        if (!$promo) {
            echo "Data promo tidak ditemukan.";
            return;
        }

        $rules = [
            'name' => 'required|min:3|max:50',
            'code' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'slot' => 'required'
        ];

        if (!$request->validate($rules)) {
            return $this->view('promo.edit', [
                'errors' => $request->getErrors(),
                'promo' => $promo
            ], 'layout.index');
        }

        Promo::update($id, [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'amount' => $request->input('amount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'slot' => $request->input('slot')
        ]);

        $_SESSION['success'] = "Data promo berhasil diperbarui!";
        return $this->redirect('/data-promo');
    }

    public function delete($id)
    {
        Promo::delete($id);

        $_SESSION['success'] = "Data promo berhasil dihapus!";
        return $this->redirect('/data-promo');
    }
}
