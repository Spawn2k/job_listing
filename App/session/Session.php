<?php

namespace App\session;

trait Session
{
    public function start(): void
    {
        session_start();
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null): ?array
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function getFlash(string $type): array
    {
        $flash = $this->get('flash') ?? [];
        if (isset($flash[$type])) {
            $messages = $flash[$type];
            unset($flash[$type]);
            $this->set('flash', $flash);
            return $messages;
        }
        return [];
    }

    public function setFlash(string $type, string $message): void
    {
        $flash = $this->get('flash') ?? [];
        $flash[$type][] = $message;
        $this->set('flash', $flash);
    }

    public function hasFlash(string $type): bool
    {
        return isset($_SESSION['flash'][$type]);
    }

    public function clearFlash(): void
    {
        unset($_SESSION['flash']);
    }
}
