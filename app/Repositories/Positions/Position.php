<?php

namespace App\Repositories\Positions;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Position extends Entity
{
    use FilterTrait, PresentationTrait;

    const ENABLE    = 1;
    const DISABLE   = 0;

    const ALL_STATUS = [
        self::DISABLE,
        self::ENABLE,
    ];
    const DISPLAY_STATUS = [
        self::DISABLE   => 'Không hiển thị',
        self::ENABLE    => 'Hiển thị',
    ];

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
