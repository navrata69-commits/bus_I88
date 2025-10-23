<?php

namespace bus\Project\middleware;

use bus\Project\core\Session;

class AuthMiddleware
{
    public function handle()
    {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /login');
            exit;
        }
    }
}
