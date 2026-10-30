<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'menu_type',
        'parent_id',
        'title',
        'url',
        'category_group',
        'icon',
        'description',
        'target',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    public static function getActiveMenu($menuType)
    {
        return static::where('menu_type', $menuType)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }
}

