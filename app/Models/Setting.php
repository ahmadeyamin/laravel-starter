<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

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
