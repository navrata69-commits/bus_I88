<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Helper;
use bus\Project\core\Session;
use bus\Project\models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Session::get('user')['id'];

        $user = User::where('id', '=', $userId)->first();

        return $this->view('home.profile', ['user' => $user]);
    }

    public function update()
    {
        $id = Session::get('user')['id'];

        $data = [
            'name'  => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? ''
        ];

        User::update($id, $data);

        Session::set('success', "Profil berhasil diperbarui.");
        $this->redirect('/profile');
    }

    public function changePassword()
    {
        $id = Session::get('user')['id'];
        $user = User::where('id', '=', $id)->first();

        $old = $_POST['old_password'];
        $new = $_POST['new_password'];
        $confirm = $_POST['confirm_password'];

        $errors = [];

        if (!Helper::bcryptVerify($old, $user->password)) {
            $errors[] = ["Password lama tidak sesuai"];
        }

        if ($new !== $confirm) {
            $errors[] = ["Konfirmasi password tidak cocok"];
        }

        if (!empty($errors)) {
            Session::set('errors', $errors);
            $this->redirect('/profile');
        }

        User::update($id, [
            'password' => Helper::bcryptEncrypt($new)
        ]);

        Session::set('success', "Password berhasil diubah.");
        $this->redirect('/profile');
    }
}
