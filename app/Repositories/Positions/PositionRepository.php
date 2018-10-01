<?php

namespace App\Repositories\Positions;

use App\Repositories\BaseRepository;

class PositionRepository extends BaseRepository
{
    /**
     * Position model.
     * @var Model
     */
    protected $model;

    /**
     * PositionRepository constructor.
     * @param Position $position
     */
    public function __construct(Position $position)
    {
        $this->model = $position;
    }

    public function getAllStatus()
    {
        return implode(',', Position::ALL_STATUS);
    }


    public function changeStatus($id)
    {
        $position = parent::getById($id);
        if ($position->status === 0) {
            parent::update($id, ['status' => 1]);
        } else {
            parent::update($id, ['status' => 0]);
        }
    }
}
