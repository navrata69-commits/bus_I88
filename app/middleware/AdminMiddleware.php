<?php

namespace bus\Project\middleware;

use bus\Project\core\Session;

class AdminMiddleware
{
    public function handle()
    {
        $user = Session::get('user');

        if (!$user) {
            header('Location: /login');
            exit;
        }

        if ($user['role'] !== 'admin') {
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
            exit;
        }
    }
}
