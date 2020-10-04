<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
// use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Cache;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
// use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Fortify\TwoFactorAuthenticatable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable //implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // use InteractsWithMedia;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'password', 
        'remember_token',
        'provider',
        'provider_token',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
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


    /**
     * registerMediaCollections
     *
     * @return void
     */
    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackUrl(config('app.placeholder'))
            ->useFallbackPath(config('app.placeholder'))
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
        // return $this->getFirstMediaUrl('avatar', 'thumb');

        return $this->getOriginal('profile_photo_url');
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
