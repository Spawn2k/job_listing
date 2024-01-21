<?php

function start(): void
{
    session_start();
}

function set(string $key, $value): void
{
    $_SESSION[$key] = $value;
}

function get(string $key, $default = null): ?array
{
    return $_SESSION[$key] ?? $default;
}

function has(string $key): bool
{
    return isset($_SESSION[$key]);
}

function remove(string $key): void
{
    unset($_SESSION[$key]);
}

function getFlash(string $type): array
{
    $flash = get('flash') ?? [];
    if (isset($flash[$type])) {
        $messages = $flash[$type];
        unset($flash[$type]);
        set('flash', $flash);
        return $messages;
    }
    return [];
}

function setFlash(string $type, string $message): void
{
    $flash = get('flash') ?? [];
    $flash[$type][] = $message;
    set('flash', $flash);
}

function hasFlash(string $type): bool
{
    return isset($_SESSION['flash'][$type]);
}

function clearFlash(): void
{
    unset($_SESSION['flash']);
}
