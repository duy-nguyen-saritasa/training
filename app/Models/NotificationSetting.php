<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 07:33:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NotificationSetting
 *
 * @property int $id
 * @property int $user_id
 * @property int $notification_type_id
 * @property bool $is_on
 *
 * @property \App\Models\NotificationType $notification_type
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class NotificationSetting extends Eloquent
{
    public $timestamps = false;

    protected $casts = [
        'user_id' => 'int',
        'notification_type_id' => 'int',
        'is_on' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'notification_type_id',
        'is_on'
    ];

    public function notificationType()
    {
        return $this->belongsTo(\App\Models\NotificationType::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
