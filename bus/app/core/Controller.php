<?php

namespace bus\Project\core;

class Controller 
{
    public function view($path, $data = [], $layout = null)
    {
        return View::render($path, $data, $layout);
    }


    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    public function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
