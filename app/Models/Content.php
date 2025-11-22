<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['key', 'value'];

    public static function valuesFor(array $defaults): array
    {
        $keys = array_keys($defaults);
        $stored = self::whereIn('key', $keys)->pluck('value', 'key');

        return collect($defaults)->map(function ($default, $key) use ($stored) {
            return $stored[$key] ?? $default;
        })->all();
    }

    public static function updateValue(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
