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
}
