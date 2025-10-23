<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->view('dashboard.index', [], 'layout.index');
    }
}