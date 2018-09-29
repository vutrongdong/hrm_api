<?php

namespace App\Repositories\Settings;

use App\Repositories\BaseRepository;

class SettingRepository extends BaseRepository
{
    /**
     * Setting model.
     * @var Model
     */
    protected $model;

    /**
     * SettingRepository constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }
}
