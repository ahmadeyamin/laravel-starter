<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * permissions
     *
     * @return void
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public static function getAllModules()
    {
        return Cache::rememberForever('modules.all', function() {
            return self::with('permissions')->get();
        });
    }


     /**
     * flushCache
     *
     * @return void
     */
    public static function flushCache()
    {
        Cache::forget('modules.all');
    }
}
