<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageContent extends Model
{
    protected $table = 'page_contents';
    public $incrementing = false;
    protected $fillable = ['page', 'section', 'key', 'value'];

    public static function getValue($page, $section, $key, $default = null)
    {
        $record = static::where('page', $page)
            ->where('section', $section)
            ->where('key', $key)
            ->first();

        return ($record && $record->value !== null && $record->value !== '') ? $record->value : $default;
    }

    public static function setValue($page, $section, $key, $value)
    {
        return DB::table('page_contents')->updateOrInsert(
            ['page' => $page, 'section' => $section, 'key' => $key],
            ['value' => $value, 'updated_at' => now()]
        );
    }

    public static function getPageSections($page)
    {
        $records = static::where('page', $page)->get();
        $grouped = [];
        foreach ($records as $r) {
            $grouped[$r->section][$r->key] = $r->value;
        }
        return $grouped;
    }
}
