<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Content extends Model
{
    protected $fillable = ['key', 'value'];

    public static function valuesFor(array $defaults): array
    {
        if (empty($defaults)) {
            return $defaults;
        }

        try {
            $keys = array_keys($defaults);
            $stored = self::whereIn('key', $keys)->pluck('value', 'key');
        } catch (QueryException $e) {
            return $defaults;
        }

        $missingKeys = array_diff($keys, $stored->keys()->all());

        if (!empty($missingKeys)) {
            $records = array_map(function ($key) use ($defaults) {
                return [
                    'key' => $key,
                    'value' => $defaults[$key],
                ];
            }, $missingKeys);

            self::upsert($records, ['key'], ['value']);

            foreach ($missingKeys as $key) {
                $stored[$key] = $defaults[$key];
            }
        }

        return collect($defaults)->map(function ($default, $key) use ($stored) {
            return $stored[$key] ?? $default;
        })->all();
    }

    public static function updateValue(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
