<?php

namespace App\Contracts;

use App\Exceptions\RestfulServiceException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

/**
 * Manager to work with entities.
 */
interface IRestfulService
{
    /**
     * Creates new entity.
     *
     * @param array $modelParams Model needed parameters
     * @return Model
     *
     * @throws ValidationException
     */
    public function create(array $modelParams): Model;

    /**
     * Updates entity.
     *
     * @param Model $model Model to update
     * @param array $modelParams Model needed parameters
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function update(Model $model, array $modelParams): void;

    /**
     * Deletes entity.
     *
     * @param Model $model Model to delete
     *
     * @throws RestfulServiceException
     *
     * @return void
     */
    public function delete(Model $model): void;

    /**
     * Returns repository for entity.
     *
     * @return IRepository
     */
    public function getRepository(): IRepository;

    /**
     * Validate entity data before saving.
     *
     * @param array $data Data to validate
     * @param array|null $rules Validation rules
     *
     * @return void
     *
     * @throws ValidationException
     */
    public function validate(array $data, array $rules = null): void;

    /**
     * Wrap closure in storage transaction.
     *
     * @param \Closure $callback Callback which will be wrapped into transaction
     *
     * @return mixed
     * @throws \Throwable
     */
    public function handleTransaction(\Closure $callback);
}
