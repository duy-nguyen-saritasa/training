<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Dingo\Api\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Saritasa\Enums\PagingType;
use Dingo\Api\Http\Request;

class UsersController extends AppApiController
{
    protected $modelClass = User::class;
    protected $paging = PagingType::NONE;

    public function update($id, Request $request)
    {
        return $this->updateEntity($request, User::findOrFail($id));
    }

    public function destroy($id): Response
    {
        return $this->destroyEntity(User::findOrFail($id));
    }
}
