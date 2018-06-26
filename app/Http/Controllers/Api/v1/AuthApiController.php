<?php

namespace App\Http\Controllers\Api\v1;

use Saritasa\Laravel\Controllers\Api\JWTAuthApiController;

/**
 * User authentication
 */
class AuthApiController extends JWTAuthApiController
{
    public function user()
    {
        return response()->json(auth()->user());
    }
}
