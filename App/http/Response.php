<?php

namespace App\http;

use Error;

class Response
{
    public function __construct(private ?string $view = '', private int $status = 200, public array $data = [])
    {
        $this->renderView($this->view, $this->status, $this->data);
    }
    public function renderView(string $view, int $status = 200, array $data = []): void
    {
        //@phpstan-ignore-next-line
        $template = BASE_PATH . "/App/views/{$view}.view.php";
        http_response_code($status);
        extract($data);
        require $template;
    }

    public static function redirect(string $path, int $status = 302)
    {
        header('location:' . $path, true, $status);
        exit();
    }
}
