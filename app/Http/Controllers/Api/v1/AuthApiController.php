<?php

namespace App\Http\Controllers\Api\v1;

use Saritasa\Laravel\Controllers\Api\JWTAuthApiController;
use App\Models\User;

/**
 * User authentication
 */
class AuthApiController extends JWTAuthApiController
{
    public function user()
    {
        $id = auth()->user()->getAuthIdentifier();
        return response()->json(User::findOrFail($id)->toArray());
    }
}
