<?php

namespace bus\Project\middleware;

use bus\Project\core\Session;

class GuestMiddleware
{
    public function handle()
    {
        $user = Session::get('user');

        if ($user) {
            header('Location: /dashboard');
            exit;
        }
    }
}
