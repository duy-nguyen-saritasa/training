<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 07:33:32 +0000.
 */

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $gender
 * @property string $facebook_id
 * @property string $instagram_id
 * @property string $avatar_url
 * @property int $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\Role $role
 * @property \Illuminate\Database\Eloquent\Collection $notification_settings
 * @property \Illuminate\Database\Eloquent\Collection $notifications
 * @property \App\Models\Preference $preference
 * @property \Illuminate\Database\Eloquent\Collection $user_devices
 *
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
        'role_id' => 'int'
    ];

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'facebook_id',
        'instagram_id',
        'avatar_url',
        'role_id'
    ];

    /**
     * Rules of users
     *
     * @return array
     */
    public function getValidationRules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    public function notificationSettings()
    {
        return $this->hasMany(\App\Models\NotificationSetting::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    public function preference()
    {
        return $this->hasOne(\App\Models\Preference::class, 'id');
    }

    public function userDmakeevices()
    {
        return $this->hasMany(\App\Models\UserDevice::class);
    }
}
