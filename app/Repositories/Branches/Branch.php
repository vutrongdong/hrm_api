<?php

namespace App\Repositories\Branches;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
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
        'ward_id',
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
