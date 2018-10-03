<?php

namespace App\Repositories\Settings;

trait FilterTrait
{
    public function scopeQ($query, $q)
    {
        if ($q) {
            return $query->where('name', 'like', "%${q}%")
            ->orWhere('slug', 'like', "%${q}%")
            ->orWhere('value', 'like', "%${q}%");
        }
        return $query;
    }
}
