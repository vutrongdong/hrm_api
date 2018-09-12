<?php

namespace App\Repositories\Departments;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'branch_id',
        'status'
    ];

    public function branch()
    {
        return $this->belongsTo(\App\Repositories\Branches\Branch::class);
    }
}
