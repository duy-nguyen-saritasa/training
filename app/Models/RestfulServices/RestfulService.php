<?php

namespace App\Models\RestfulServices;

use App\Contracts\IRepository;
use App\Contracts\IRestfulService;
use App\Contracts\IRestfulServiceFactory;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

/**
 * Restful service to create, update and delete model. Has ability to validate model attributes.
 * Provides access to handled model repository.
 */
class RestfulService implements IRestfulService
{
    /**
     * Restful services factory realization.
     *
     * @var IRestfulServiceFactory
     */
    protected $restfulServiceFactory;

    /**
     * Current entity repository.
     *
     * @var IRepository
     */
    protected $repository;

    /**
     * Entity class name.
     *
     * @var string
     */
    protected $className;

    /**
     * Validation factory.
     *
     * @var Factory
     */
    protected $validatorFactory;

    /**
     * Connection interface realization.
     *
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Default restful service for all entities.
     *
     * @param string $className Entity class name
     * @param IRestfulServiceFactory $restfulServiceFactory Restful services factory realization
     * @param IRepository $repository Current entity repository
     * @param Factory $validatorFactory Validation factory
     * @param ConnectionInterface $connection Connection interface realization
     */
    public function __construct(
        string $className,
        IRestfulServiceFactory $restfulServiceFactory,
        IRepository $repository,
        Factory $validatorFactory,
        ConnectionInterface $connection
    ) {
        $this->repository = $repository;
        $this->validatorFactory = $validatorFactory;
        $this->className = $className;
        $this->connection = $connection;
        $this->restfulServiceFactory = $restfulServiceFactory;
    }

    /** {@inheritdoc} */
    public function create(array $modelParams): Model
    {
        $this->validate($modelParams);

        return $this->repository->create(new $this->className($modelParams));
    }

    /** {@inheritdoc} */
    public function update(Model $model, array $modelParams): void
    {
        $this->validate($modelParams, $this->getValidationRulesForAttributes($modelParams));
        $this->repository->save($model->fill($modelParams));
    }

    /**
     * Returns rules for giveb attributes.
     *
     * @param array $modelParams Updating fields
     * @param array $rules Custom validation rules
     * @return array
     */
    protected function getValidationRulesForAttributes(array $modelParams, array $rules = []): array
    {
        $modelRules = empty($rules) ? $this->repository->getModelValidationRules() : $rules;
        return array_intersect_key($modelRules, $modelParams);
    }

    /**
     * Validates model before it can be deleted.
     *
     * @param Model $model Model to delete
     */
    protected function checkBeforeDelete(Model $model): void
    {
        // do nothing
    }

    /**
     * Deletes model.
     *
     * @param Model $model Model to delete
     *
     * @return void
     */
    public function delete(Model $model): void
    {
        $this->checkBeforeDelete($model);
        $this->repository->delete($model);
    }

    /**
     * Wrap closure in db transaction.
     *
     * @param \Closure $callback Callback which will be wrapped into transaction
     *
     * @return mixed
     * @throws \Throwable
     */
    public function handleTransaction(\Closure $callback)
    {
        try {
            $this->connection->beginTransaction();

            return tap($callback(), function () {
                $this->connection->commit();
            });
        } catch (\Throwable $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    /**
     * Validates data.
     *
     * @param array $data Data to validate
     * @param array|null $rules Validation rules
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validate(array $data, array $rules = null): void
    {
        $validator = $this->validatorFactory->make($data, $rules ?? $this->repository->getModelValidationRules());
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Returns current entity repository.
     *
     * @return IRepository
     */
    public function getRepository(): IRepository
    {
        return $this->repository;
    }
}
