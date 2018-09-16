<?php

namespace App\Repositories\Branches;

trait PresentationTrait
{
    public function getStatus()
    {
        return $this->status === self::STATUS_ENABLE ? 'Hiển thị' : 'Không hiển thị';
    }

    public function getType()
    {
        return $this->type === self::BRANCH_MAIN ? 'Chi nhánh chính' : 'Chi nhánh phụ';
    }

    public function getAllStatus()
    {
        return implode(',', self::STATUS);
    }
}
