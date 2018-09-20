<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Contract extends Entity
{
    use FilterTrait, PresentationTrait;

    const DISABLE = 0;
    const ENABLE = 1;

    const ALL_STATUS = [
        self::DISABLE,
        self::ENABLE,
    ];
    const DISPLAY_STATUS = [
        self::DISABLE => 'Không hiển thị',
        self::ENABLE => 'Hiển thị',
    ];

    const TRAINING = 0;
    const COLLABORATOR = 1;
    const PROBATION = 2;
    const FORMAL_TERM = 3;
    const FORMAL_WITHOUT_TERM = 4;

    const ALL_TYPE = [
        self::TRAINING,
        self::COLLABORATOR,
        self::PROBATION,
        self::FORMAL_TERM,
        self::FORMAL_WITHOUT_TERM,
    ];
    const DISPLAY_TYPE = [
        self::TRAINING => 'Hợp đồng học việc',
        self::COLLABORATOR => 'Hợp đồng cộng tác viên',
        self::PROBATION => 'Hợp đồng thử việc',
        self::FORMAL_TERM => 'Hợp đồng chính thức có thời hạn',
        self::FORMAL_WITHOUT_TERM => 'Hợp đồng chính thức không thời hạn',
    ];

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'code',
        'title',
        'type',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->code = hashid_encode($model->id);
            $model->save();
        });
    }

    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'contract_user');
    }
}
