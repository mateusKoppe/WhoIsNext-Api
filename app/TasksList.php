<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksList extends Model
{
    protected $fillable = [
        'name',
        'description',
        'creator',
    ];
}
