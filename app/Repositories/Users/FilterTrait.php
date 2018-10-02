<?php

namespace App\Repositories\Users;

use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Positions\PositionRepository;
use App\Repositories\Contracts\ContractRepository;

trait FilterTrait
{
    /**
    * Tìm kiếm theo tên, email, mã nhân viên, số điện thoại
    * @param  [type] $query [description]
    * @param  string $q     name, email, code, phone
    * @return Collection User Model
    */
    public function scopeQ($query, $q)
    {
        if ($q) {
            return $query->where('name', 'like', "%${q}%")
            ->orWhere('email', 'like', "%${q}%")
            ->orWhere('code', 'like', "%${q}%")
            ->orWhere('phone', 'like', "%${q}%");
        }
        return $query;
    }

    /**
    * Tìm kiếm theo phòng ban
    * @param  [type] $query        [description]
    * @param  int $departmentId     departmentId
    * @return Collection User Model
    */
    public function scopeDepartmentID($query, $departmentId)
    {
        if ($departmentId) {
            $departments = app()->make(DepartmentRepository::class)
            ->getByQuery(['id' => $departmentId], -1)
            ->pluck('id');

            return $query->whereHas('departments', function ($query) use ($departments) {
                $query->whereIn('id', $departments);
            }); 
        }

        return $query;
    }    

    /**
     * Tìm kiếm theo chức vụ
     * @param  [type] $query        [description]
     * @param  int    $positionId   positionId
     * @return Collection User Model
     */
    public function scopePositionID($query, $positionId)
    {
        if ($positionId) {
            $positions = app()->make(positionRepository::class)
            ->getByQuery(['id' => $positionId], -1)
            ->pluck('id');

            return $query->whereHas('positions', function ($query) use ($positions) {
                $query->whereIn('id', $positions);
            }); 
        }

        return $query;
    } 

    /**
     * Tìm kiếm theo chi nhánh
     * @param  [type] $query        [description]
     * @param  int    $branchId     branchId
     * @return Collection User Model
     */
    public function scopeBranchID($query, $branchId)
    {
        if ($branchId) {
            $departments = app()->make(DepartmentRepository::class)
            ->getByQuery(['branch_id' => $branchId], -1)
            ->pluck('id');

            return $query->whereHas('departments', function ($query) use ($departments) {
                $query->whereIn('id', $departments);
            }); 
        }
        return $query;
    } 

    /**
     * Tìm kiếm theo trạng thái
     * @param  [type] $query  [description]
     * @param  int $status    status
     * @return [type]         [description]
     */
    public function scopeStatus($query, $status)
    {
        if (in_array($status, self::ALL_STATUS)) {
            return $query->where('status', $status);
        }
        return $query;
    }   

    /**
     * Tìm kiếm theo loại hợp đồng
     * @param  [type] $query        [description]
     * @param  int $contractType    type
     * @return [type]               [description]
     */
    public function scopeContractType($query, $contractType)
    {
        if ($contractType) {
            $contracts = app()->make(ContractRepository::class)
            ->getByQuery(['type' => $contractType], -1)
            ->pluck('user_id');

            return $query->whereHas('contracts', function ($query) use ($contracts) {
                $query->whereIn('user_id', $contracts);
            }); 
        }
        return $query;
    }
}
