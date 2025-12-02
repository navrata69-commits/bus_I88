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
            if($user->role == 'admin')
            {
                return $this->redirect('/dashboard');
            }else{
                return $this->redirect('/');
            }
        }

        return $this->view('home.login', ['error' => 'Username Atau Password Salah']);
    }

    public function logout()
    {
        Session::destroy();
        return $this->redirect('/login');
    }

    public function register()
    {
        return $this->view('home.register');
    }

    public function createRegister(Request $request)
    {
        if (!$request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required'
        ])) {
            return $this->view('home.register', ['errors' => $request->getErrors()]);
        }

        $email = $request->input('email');
        $existing = User::where('email', '=', $email)->first();

        if ($existing) {
            return $this->view('home.register', ['error' => 'Email sudah digunakan']);
        }

        $userId = User::create([
            'name' => $request->input('name'),
            'email' => $email,
            'phone_number' => $request->input('phone_number') ?: null,
            'password' => Helper::bcryptEncrypt($request->input('password')),
            'role' => 'customer'
        ]);

        if ($userId) {
            $_SESSION['success'] = 'Registrasi berhasil! Silakan login.';
            return $this->redirect('/login');
        } else {
            return $this->view('home.register', ['error' => 'Terjadi kesalahan saat registrasi']);
        }
    }
}
