<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;
use bus\Project\core\Request;
use bus\Project\core\Session;
use bus\Project\core\Helper;
use bus\Project\models\User;

class AuthController extends Controller
{
    public function index()
    {
        if (Session::get('user')) {
            return $this->redirect('/dashboard');
        }

        return $this->view('home.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if(!$request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ])) {
            return $this->view('home.login', ['errors' => $request->getErrors()]);
        }

        $user = User::where('email', '=', $email)->first();

        if(Helper::bcryptVerify($request->input('password'), $user->password)) 
        {
            Session::set('user', [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role ?? 'user'
            ]);

            return $this->redirect('/dashboard');
        }

        return $this->view('home.login', ['error' => 'Username Atau Password Salah']);
    }

    public function logout()
    {
        Session::destroy();
        return $this->redirect('/login');
    }
}
