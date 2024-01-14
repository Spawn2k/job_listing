<?php

namespace App\controller;

use App\model\Model;

trait PostModel
{
    use Model;

    protected string $table = 'posts';
    protected array $fillable = [
        'title',
        'info',
        'description',
    ];
}
