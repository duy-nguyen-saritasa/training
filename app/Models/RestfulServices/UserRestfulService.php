<?php

namespace App\Models\RestfulServices;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

/**
 * {@inheritdoc}
 * Handles User restful methods.
 */
class UserRestfulService extends RestfulService
{
    /**
     * Validates and saves user.
     *
     * @param Model $model User model
     * @param array $modelParams Data to update User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Model $model, array $modelParams): void
    {
        $rules = $this->getRepository()->getModelValidationRules();
        if (isset($rules[User::PWD_FIELD])) {
            unset($rules[User::PWD_FIELD]);
        }
        $rules[User::EMAIL] = Rule::unique($model->getTable())->ignore($model->getKey());
        $this->validate($modelParams, $rules);
        $this->repository->save($model->fill($modelParams));
    }
}
