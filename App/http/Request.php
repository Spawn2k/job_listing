<?php

namespace App\http;

trait Request
{
    public function getParams(): array
    {
        return $_GET;
    }

    public function getPost(): array
    {
        return $_POST;
    }

    public function getServer(): array
    {
        return $_SERVER;
    }

    public function getCookies(): array
    {
        return $_COOKIE;
    }

    public function getFiles(): array
    {
        return $_FILES;
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPathInfo(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

}
