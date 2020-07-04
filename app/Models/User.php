<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','provider','provider_token','media'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_seen_at' => 'datetime',
        'is_blocked' => 'boolean',
    ];

    protected $appends = ['avatar'];

    /**
     * registerMediaCollections
     *
     * @return void
     */
    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackUrl(config('app.placeholder').'default.png')
            ->useFallbackPath(config('app.placeholder').'default.png')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(160)
                    ->height(160);
            });
    }

    /**
     * getAllUsers
     *
     * @return void
     */
    public static function getAllUsers()
    {
        return Cache::rememberForever('users.all', function() {
            return self::with('role')->latest('id')->get();
        });
    }

    /**
     * flush Cache
     *
     * @return void
     */
    public static function flushCache()
    {
        Cache::forget('users.all');
    }

    /**
     * getAvatarAttribute
     *
     * @param  mixed $var
     * @return void
     */
    public function getAvatarAttribute( $var )
    {
        return $this->getFirstMediaUrl('avatar', 'thumb');
    }

    /**
     * role
     *
     * @return void
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }



    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    // public function scopeHasPermission($query,$slug)
    // {
    //     return $this->role->whereFirst('slug', $slug);
    // }
}
