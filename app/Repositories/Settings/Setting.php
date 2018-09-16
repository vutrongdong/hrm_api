<?php

namespace App\Repositories\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Setting extends Entity
{
    use FilterTrait, PresentationTrait;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

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
