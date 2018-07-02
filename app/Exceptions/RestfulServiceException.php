<?php

namespace App\Exceptions;

use App\Contracts\IRepositoryFactory;
use App\Contracts\IRestfulServiceFactory;

/**
 * Base exception for restful services.
 *
 * @see IRestfulServiceFactory
 * @see IRepositoryFactory
 */
class RestfulServiceException extends \Exception
{

}
