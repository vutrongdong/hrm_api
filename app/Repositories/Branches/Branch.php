<?php

namespace App\Repositories\Branches;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Branch extends Entity
{
    use FilterTrait, PresentationTrait;

    const DISABLE   = 0;
    const ENABLE    = 1;

    const ALL_STATUS = [
        self::DISABLE,
        self::ENABLE,
    ];
    const DISPLAY_STATUS = [
        self::DISABLE   => 'Không hiển thị',
        self::ENABLE    => 'Hiển thị',
    ];

    const NOT_MAIN      = 0;
    const MAIN          = 1;

    const DISPLAY_BRANCH = [
        self::NOT_MAIN      => 'Chi nhánh phụ',
        self::MAIN          => 'Chi nhánh chính',
    ];
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
