<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 07:33:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Media
 *
 * @property int $id
 * @property string $thumbnail
 * @property string $full
 * @property int $sequence
 * @property int $mediable_id
 * @property string $mediable_type
 *
 * @package App\Models
 */
class Media extends Eloquent
{
    protected $table = 'medias';
    public $timestamps = false;

    protected $casts = [
        'sequence' => 'int',
        'mediable_id' => 'int'
    ];

    protected $fillable = [
        'thumbnail',
        'full',
        'sequence',
        'mediable_id',
        'mediable_type'
    ];
}
