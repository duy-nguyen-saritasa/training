<?php

namespace App\Models\RestfulServices;

use App\Contracts\IRepositoryFactory;
use App\Contracts\IRestfulService;
use App\Contracts\IRestfulServiceFactory;
use App\Exceptions\RestfulServiceException;
use App\Models\Device;
use App\Models\Line;
use App\Models\Location;
use App\Models\Package;
use App\Models\Product;
use App\Models\Run;
use App\Models\User;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Validation\Factory;

/**
 * App service manager factory.
 */
class RestfulServiceFactory implements IRestfulServiceFactory
{

    /**
     * Collection of correspondences model to service.
     *
     * @var array
     */
    protected $restfulServicesBinds = [
        User::class => UserRestfulService::class,
    ];

    /**
     * Repository factory.
     *
     * @var IRepositoryFactory
     */
    protected $repositoryFactory;

    /**
     * Validation factory.
     *
     * @var Factory
     */
    protected $factory;

    /**
     * Default db connection.
     *
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Already created instances.
     *
     * @var array
     */
    protected static $sharedInstances = [];

    /**
     * App service manager factory.
     *
     * @param IRepositoryFactory $repositoryFactory Repository factory
     * @param Factory $factory Validation factory
     * @param ConnectionInterface $connection Database connection
     */
    public function __construct(
        IRepositoryFactory $repositoryFactory,
        Factory $factory,
        ConnectionInterface $connection
    ) {
        $this->repositoryFactory = $repositoryFactory;
        $this->factory = $factory;
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function buildRestfulService(string $modelClass): IRestfulService
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
     *
     * @return IRestfulService
     * @throws RestfulServiceException
     */
    protected function build(string $modelClass): IRestfulService
    {
        try {
            if (isset($this->restfulServicesBinds[$modelClass])) {
                return new $this->restfulServicesBinds[$modelClass]($modelClass, $this,
                    $this->repositoryFactory->getRepository($modelClass), $this->factory, $this->connection);
            }

            return new RestfulService(
                $modelClass,
                $this,
                $this->repositoryFactory->getRepository($modelClass),
                $this->factory,
                $this->connection
            );
        } catch (\Exception $exception) {
            throw new RestfulServiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
