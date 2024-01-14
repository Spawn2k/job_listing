<?php

namespace App\controller;

use App\model\Model;

trait ListingController
{
    use Model;

    public string $table = 'job_listings';
    public array $fillable = [
        'user_id',
        'email',
        'state',
        'city',
        'benefits',
        'requirements',
        'title',
        'address',
        'description',
        'company',
        'phone',
        'salary',
        'tags',
        'name',
        'password',
    ];

}
