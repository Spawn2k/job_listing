<?php

namespace App\model;

trait UserModel
{
    use Model;
    public string $table = 'users';
    protected $fillable = [
        'firstname',
        'lastname',
        'password',
        'email',
        'age',
        'phone'
    ];
}
