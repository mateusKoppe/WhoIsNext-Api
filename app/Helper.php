<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    protected $fillable = [
        'name',
        'description',
        'helped_times',
        'task',
        'account', // User id
    ];

    protected $hidden = [
        'task',
    ];
}
