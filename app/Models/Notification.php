<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 07:33:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Notification
 *
 * @property int $id
 * @property int $user_id
 * @property int $notification_type_id
 * @property string $subject
 * @property string $message
 * @property bool $is_viewed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $delivered_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\NotificationType $notification_type
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Notification extends Eloquent
{
    protected $casts = [
        'user_id' => 'int',
        'notification_type_id' => 'int',
        'is_viewed' => 'bool'
    ];

    protected $dates = [
        'delivered_at'
    ];

    protected $fillable = [
        'user_id',
        'notification_type_id',
        'subject',
        'message',
        'is_viewed',
        'delivered_at'
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
