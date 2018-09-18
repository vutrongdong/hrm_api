<?php

namespace App\Repositories\Plans;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Plan extends Entity
{
    use FilterTrait, PresentationTrait;

    const CREATED = 0;
    const WAIT_APPROVE = 1;
    const APPROVED = 2;
    const NOT_APPROVE = 3;
    const DONE = 4;
    const DELETED = 5;

    const ALL_STATUS = [
        self::CREATED,
        self::WAIT_APPROVE,
        self::APPROVED,
        self::NOT_APPROVE,
        self::DONE,
        self::DELETED,
    ];
    const DISPLAY_STATUS = [
        self::CREATED => 'Mới',
        self::WAIT_APPROVE => 'Chờ duyệt',
        self::APPROVED => 'Duyệt',
        self::NOT_APPROVE => 'Không duyệt',
        self::DONE => 'Hoàn thành',
        self::DELETED => 'Xóa',
    ];
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'title',
        'date_start',
        'date_end',
        'content',
        'status',
    ];

    public function departments()
    {
        return $this->hasMany(\App\Repositories\Departments\Department::class, 'plan_details', 'id');
    }

    public function positions()
    {
        return $this->hasMany(\App\Repositories\Positions\Position::class, 'plan_details', 'id');
    }

    // public function city()
    // {
    //     return $this->belongsTo(\App\Repositories\Cities\City::class);
    // }   

    // public function district()
    // {
    //     return $this->belongsTo(\App\Repositories\Districts\District::class);
    // }
}
