<?php

namespace App\util;

use Exception;

function loadTemplate(string $name): void
{
    //@phpstan-ignore-next-line
    $template = BASE_PATH . "/App/views/template/{$name}.php";
    if (!file_exists($template)) {
        throw new Exception("Template {$name} not found");

    }
    require $template;
}
