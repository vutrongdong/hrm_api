<?php

namespace App\Repositories\Positions;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Position extends Entity
{
    use FilterTrait, PresentationTrait;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

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
