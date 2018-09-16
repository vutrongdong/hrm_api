<?php

namespace App\Repositories\Branches;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Branch extends Entity
{
    use FilterTrait, PresentationTrait;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    const STATUS = [
        self::STATUS_ENABLE,
        self::STATUS_DISABLE
    ];

    const BRANCH_MAIN = 1;
    const BRANCH_NOT_MAIN = 0;
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'about',
        'phone',
        'address',
        'website',
        'email',
        'facebook',
        'instagram',
        'zalo',
        'tax_number',
        'bank',
        'type',
        'city_id',
        'district_id',
        'status',
    ];

    public function departments()
    {
        return $this->hasMany(\App\Repositories\Departments\Department::class);
    }

    public function city()
    {
        return $this->belongsTo(\App\Repositories\Cities\City::class);
    }   

    public function district()
    {
        return $this->belongsTo(\App\Repositories\Districts\District::class);
    }
}
