<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
     * user
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * permissions
     *
     * @return void
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }


    public static function getAllRoles()
    {
        return Cache::rememberForever('roles.all', function() {
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
        Cache::forget('roles.all');
    }
}
