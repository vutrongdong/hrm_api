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

    public function changeStatus($id)
    {
        $setting = parent::getById($id);
        if ($setting->status === 0) {
            parent::update($id, ['status' => 1]);
        } else {
            parent::update($id, ['status' => 0]);
        }
    }
}
