<?php

namespace App\Repositories\Plan_details;

use Illuminate\Database\Eloquent\Model;

class Plan_detail extends Model
{
    // use FilterTrait, PresentationTrait;

    // const CREATED = 0;
    // const WAIT_APPROVE = 1;
    // const APPROVED = 2;
    // const NOT_APPROVE = 3;
    // const DONE = 4;
    // const DELETED = 5;

    // const ALL_STATUS = [
    //     self::CREATED,
    //     self::WAIT_APPROVE,
    //     self::APPROVED,
    //     self::NOT_APPROVE,
    //     self::DONE,
    //     self::DELETED,
    // ];
    // const DISPLAY_STATUS = [
    //     self::CREATED => 'Mới',
    //     self::WAIT_APPROVE => 'Chờ duyệt',
    //     self::APPROVED => 'Duyệt',
    //     self::NOT_APPROVE => 'Không duyệt',
    //     self::DONE => 'Hoàn thành',
    //     self::DELETED => 'Xóa',
    // ];
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

    // public function departments()
    // {
    //     return $this->hasMany(\App\Repositories\Departments\Department::class, 'department_id');
    // }

    // public function positions()
    // {
    //     return $this->hasMany(\App\Repositories\Positions\Position::class, 'id');
    // }

    // public function city()
    // {
    //     return $this->belongsTo(\App\Repositories\Cities\City::class);
    // }   

    // public function district()
    // {
    //     return $this->belongsTo(\App\Repositories\Districts\District::class);
    // }
}
