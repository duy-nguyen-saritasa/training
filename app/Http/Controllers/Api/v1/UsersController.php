<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Saritasa\Enums\PagingType;

class UsersController extends AppApiController
{
    protected $modelClass = User::class;
    protected $paging = PagingType::NONE;
}
