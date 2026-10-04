<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key.
     */
    public static function get(string $key, $default = null)
    {
        if (!Schema::hasTable('settings')) {
            return $default;
        }

        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Set (create or update) a setting value.
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Get all settings as a key => value array.
     */
    public static function allAsArray(): array
    {
        if (!Schema::hasTable('settings')) {
            return [];
        }

        return static::pluck('value', 'key')->toArray();
    }
}
