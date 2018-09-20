<?php

namespace App\Repositories\Candidates;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Candidate extends Entity
{
    use FilterTrait, PresentationTrait;

    const CREATED = 0;
    const WAIT_RESULT = 1;
    const FAIL = 2;
    const PASS = 3;
    const BLACKLIST = 4;

    const ALL_STATUS = [
        self::CREATED,
        self::WAIT_RESULT,
        self::FAIL,
        self::PASS,
        self::BLACKLIST,
    ];
    const DISPLAY_STATUS = [
        self::CREATED => 'Mới',
        self::WAIT_RESULT => 'Chờ kết quả',
        self::PASS => 'Trượt',
        self::FAIL => 'Đỗ',
        self::BLACKLIST => 'Danh sách đen',
    ];

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'source',
        'date_apply',
        'time_interview',
        'plan_id',
        'position_id',
        'status',
    ];

    public function users() {
        return $this->belongsToMany(\App\User::class, 'interview', 'candidate_id', 'interview_by');
    }
}
