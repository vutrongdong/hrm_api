<?php

namespace App\Repositories\PlanDetails;

use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    // use FilterTrait, PresentationTrait;
    public $timestamps = false;
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'department_id',
        'position_id',
        'quantity',
    ];

    public function plan()
    {
        return $this->belongsTo(\App\Repositories\Plans\Plan::class);
    }

    public function department()
    {
        return $this->belongsTo(\App\Repositories\Departments\Department::class);
    }

    public function position()
    {
        return $this->belongsTo(\App\Repositories\Positions\Position::class);
    }
}
