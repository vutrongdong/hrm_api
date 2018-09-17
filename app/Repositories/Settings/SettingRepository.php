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

    public function store($data)
    {
        $data['slug'] = str_slug($data['name']);
        return $this->model->create($data);
    }

    public function update($id, $data, $excepts = [], $only = [])
    {
        $data['slug'] = str_slug($data['name']);
        $data = array_except($data, $excepts);
        if (count($only)) {
            $data = array_only($data, $only);
        }
        $record = $this->getById($id);
        $record->fill($data)->save();
        return $record;
    }
}
