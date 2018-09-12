<?php

namespace App\Repositories\Positions;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'department_user');
    }
}
