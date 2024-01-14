<?php

namespace App\middleware;

use App\http\Request;
use App\http\Response;
use App\session\Session;

class Authorize
{
    use Session;
    use Request;

    public function handle(string $role)
    {
        if ($role === 'user' && !$this->isAuthenticated()) {
            return Response::redirect('/');
        } elseif ($role === 'author' && $this->isAuthenticated()) {
            $userId = (int) $_SESSION['user']->id;
            $jobId = (int) $this->getPost()['id'];
            if($userId !== $jobId) {
                $this->setFlash('error', 'Sorry you are not authorize to delete this post');
                return Response::redirect('/');
            }
        } elseif ($role === 'author' && !$this->isAuthenticated()) {
            $this->setFlash('error', 'Sorry you are not authorize to delete this post');
            return Response::redirect('/');
        }
    }

    public function isAuthenticated(): bool
    {
        return $this->has('user');
    }
}
