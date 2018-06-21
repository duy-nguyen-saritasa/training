<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 07:33:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

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
class User extends Eloquent
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
