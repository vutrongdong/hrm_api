<?php

namespace App\Repositories\Wards;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    /**
     * Disable timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = ['name', 'district_id', 'slug', 'zipcode', 'order', 'status'];

    /**
     * Relationship with city
     * @return [type]        [description]
     */
    public function district()
    {
        return $this->belongsTo(\App\Repositories\Districts\District::class);
    }

    /**
     * Relationship with user
     * @return [type] [description]
     */
    // public function users()
    // {
    //     return $this->hasMany(\App\User::class);
    // }
}
