<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 07:33:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NotificationType
 *
 * @property int $id
 * @property string $name
 * @property bool $default_on
 *
 * @property \Illuminate\Database\Eloquent\Collection $notification_settings
 * @property \Illuminate\Database\Eloquent\Collection $notifications
 *
 * @package App\Models
 */
class NotificationType extends Eloquent
{
    public $timestamps = false;

    protected $casts = [
        'default_on' => 'bool'
    ];

    protected $fillable = [
        'name',
        'default_on'
    ];

    public function notificationSettings()
    {
        return $this->hasMany(\App\Models\NotificationSetting::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }
}
