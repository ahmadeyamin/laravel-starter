<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $deletable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDeletable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
