<?php

namespace bus\Project\controllers\Web;

use bus\Project\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('home.index');
    }

    public function ArmadaBus()
    {
        return $this->view('home.armada-bus');
    }

    public function PaketWisata()
    {
        return $this->view('home.paket-wisata');
    }
}