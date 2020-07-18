<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public static function getAllSettings()
    {
        // return SettingCollection::collection(self::all());
        return Cache::rememberForever('settings.all', function () {
            return self::all();
        });
    }

    /**
     * flushCache
     *
     * @return void
     */
    public static function flushCache()
    {
        return Cache::forget('settings.all');
    }

    public static function setting($key,$default = '')
    {
        $setting = self::getAllSettings()->where('key',$key)->first();

        if (!$setting) {
            return $default;
        }
        return $setting->value;
    }

    public static function has($key)
    {
        return (boolean) self::getAllSettings()->where('key',$key)->count() > 0;
    }


    public static function set($key,$value)
    {
        $set = self::updateOrCreate([
            'key' => $key,
        ],[
            'key' => $key,
            'value' => $value,
        ]);

        if ($set) {
            return true;
        }

        return false;
    }

    public static function get($key,$default = '')
    {
        return self::setting($key,$default);
    }

    /**
     * Remove a setting
     *
     * @param $key
     * @return bool
     */
    public static function remove($key)
    {
        if (self::has($key)) {

            return self::where('key',$key)->delete() ? self::flushCache() : 0;

        }

        return false;
    }
}
