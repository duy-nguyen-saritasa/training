<?php

namespace App\Models\Repositories;

use App\Contracts\IRepository;
use App\Contracts\IRepositoryFactory;
use App\Exceptions\RestfulServiceBindingException;
use App\Exceptions\RestfulServiceException;
use Saritasa\Exceptions\RepositoryException;

/**
 * Provides to repository for application model.
 */
class RepositoryFactory implements IRepositoryFactory
{
    /**
     * Registered repositories.
     *
     * @var array
     */
    protected $registeredRepositories = [];

    /**
     * Already created instances.
     *
     * @var array
     */
    protected static $sharedInstances = [];

    /**
     * {@inheritdoc}
     */
    public function getRepository(string $modelClass): IRepository
    {
        if (!isset(static::$sharedInstances[$modelClass]) || static::$sharedInstances[$modelClass] === null) {
            static::$sharedInstances[$modelClass] = $this->build($modelClass);
        }
        return static::$sharedInstances[$modelClass];
    }

    /**
     * Build repository by model class from registered instances or creates default.
     *
     * @param string $modelClass Model class
     * @return IRepository
     * @throws RestfulServiceException
     */
    protected function build(string $modelClass): IRepository
    {
        try {
            if (isset($this->registeredServiceManagers[$modelClass])) {
                return new $this->registeredRepositories[$modelClass]($modelClass);
            }
            return new AppRepository($modelClass);
        } catch (RepositoryException $exception) {
            throw new RestfulServiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register(string $modelClass, string $repositoryClass): void
    {
        if (!$repositoryClass instanceof AppRepository) {
            throw new RestfulServiceBindingException(AppRepository::class, $repositoryClass);
        }
        $this->registeredRepositories[$modelClass] = $repositoryClass;
    }
}
