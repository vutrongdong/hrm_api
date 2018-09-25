<?php

namespace App\Repositories\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Setting extends Entity
{
    use FilterTrait, PresentationTrait;

    const DISABLE   = 0;
    const ENABLE    = 1;

    const DISPLAY_STATUS = [
        self::DISABLE   => 'Không kích hoạt',
        self::ENABLE    => 'Kích hoạt',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'value',
        'status'
    ];
}
