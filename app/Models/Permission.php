<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
     * AllPermissions
     *
     * @return mixed
     */
    public static function getAllPermissions()
    {
        return Cache::rememberForever('permissions.all', function() {
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
        Cache::forget('permissions.all');
    }


    /**
     * module
     *
     * @return void
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function hasRole($roleId)
    {
        // return true;
        return $this->roles->where('id',$roleId)->first() ? true : false;
    }

    /**
     * roles
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
