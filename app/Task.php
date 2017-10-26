<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function hasPermission(User $user)
    {
        return $this->creator == $user->id;
    }

    protected $fillable = [
        'name',
        'description',
        'creator',
    ];
}
