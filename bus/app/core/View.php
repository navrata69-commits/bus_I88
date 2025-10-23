<?php

namespace bus\Project\core;

class View 
{
    public static function render($view, $data = [], $layout = null)
    {
        $viewPath = __DIR__ . '/../../views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            echo "View file '$viewPath' not found.";
            return;
        }

        // Siapkan variabel untuk digunakan di view
        extract($data);

        // Gunakan layout jika disediakan
        if ($layout) {
            $layoutPath = __DIR__ . '/../../views/' . str_replace('.', '/', $layout) . '.php';
            if (file_exists($layoutPath)) {
                // Simpan isi view di buffer agar bisa ditaruh di dalam layout
                ob_start();
                include $viewPath;
                $content = ob_get_clean();

                include $layoutPath;
                return;
            }
        }

        // Jika tidak ada layout, langsung tampilkan view
        include $viewPath;
    }
}
