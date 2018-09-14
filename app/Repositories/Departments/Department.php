<?php

namespace App\Repositories\Departments;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Department extends Entity
{
    use FilterTrait, PresentationTrait;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'branch_id',
        'status'
    ];

    // public function scopeQ($query, $value = null)
    // {
    //     if ($value) {
    //         return $query->where('name', 'like', "%{$value}%");
    //     }
    //     return $query;
    // }

    public function branch()
    {
        return $this->belongsTo(\App\Repositories\Branches\Branch::class);
    }

    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'department_user');
    }

    public function branches()
    {
        return $this->hasMany(\App\Repositories\Branches\Branch::class);
    }
}
