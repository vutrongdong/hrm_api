<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Settings\Setting;

class SettingTransformer extends TransformerAbstract
{
    public function transform(Setting $setting = null)
    {
        if (is_null($setting)) {
            return [];
        }

        return [
            'id'            => $setting->id,
            'name'          => $setting->name,
            'slug'          => $setting->slug,
            'value'         => $setting->value,
        ];
    }
}
