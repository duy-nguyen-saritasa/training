<?php

namespace App\Contracts;

use App\Exceptions\RestfulServiceBindingException;
use App\Exceptions\RestfulServiceException;

/**
 * Repositories factory.
 */
interface IRepositoryFactory
{
    /**
     * Returns needed repository for model class.
     *
     * @param string $modelClass Model class
     * @return IRepository
     * @throws RestfulServiceException
     */
    public function getRepository(string $modelClass): IRepository;

    /**
     * Registered certain repository realization for model class.
     *
     * @param string $modelClass Model class
     * @param string $repositoryClass Repository realization class
     * @throws RestfulServiceBindingException
     */
    public function register(string $modelClass, string $repositoryClass): void;
}
