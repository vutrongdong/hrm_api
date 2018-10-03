<?php

namespace App\Repositories\Settings;

trait FilterTrait
{
	/**
	 * Tìm kiếm theo tên, slug, giá trị
	 * @param  [type] $query [description]
	 * @param  string $q     name, slug, value
	 * @return Collection Setting Model
	 */
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
