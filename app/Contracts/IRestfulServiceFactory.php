<?php

namespace App\Contracts;

use App\Exceptions\RestfulServiceException;

/**
 * Restful services factory interface.
 */
interface IRestfulServiceFactory
{
    /**
     * Returns needed restful service for model class.
     *
     * @param string $modelClass Model class
     * @return IRestfulService
     * @throws RestfulServiceException
     */
    public function buildRestfulService(string $modelClass): IRestfulService;
}
