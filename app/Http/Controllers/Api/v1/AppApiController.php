<?php

namespace App\Http\Controllers\Api\v1;

use App\Contracts\IRepository;
use App\Contracts\IRestfulService;
use App\Contracts\IRestfulServiceFactory;
use App\Exceptions\RestfulServiceException;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Saritasa\Database\Eloquent\Entity;
use Saritasa\DingoApi\Traits\PaginatedOutput;
use Saritasa\DTO\SortOptions;
use Saritasa\Enums\OrderDirections;
use Saritasa\Enums\PagingType;
use Saritasa\Laravel\Controllers\Api\BaseApiController;
use Saritasa\Transformers\IDataTransformer;

/**
 * Base app resource controller.
 */
class AppApiController extends BaseApiController
{
    use PaginatedOutput, AuthorizesRequests;

    /**
     * Default model name used in route bindings.
     */
    public const ACTION_PARAMETER_NAME = 'model';

    /**
     * Controller auth guard.
     *
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Entity class.
     *
     * @var string
     */
    protected $modelClass;

    /**
     * Service manager for current entity.
     *
     * @var IRestfulService
     */
    protected $serviceManager;

    /**
     * Restful service factory.
     *
     * @var IRestfulServiceFactory
     */
    protected $restfulServiceFactory;

    /**
     * Repository for current entity.
     *
     * @var IRepository
     */
    protected $repository;

    /**
     * Default paging type.
     *
     * @var string
     */
    protected $paging = PagingType::PAGINATOR;

    /**
     * Field uses for sorting.
     *
     * @var string
     */
    protected $sortField = Entity::ID;

    /**
     * Sorting type.
     *
     * @var string
     */
    protected $sortType = OrderDirections::ASC;

    /**
     * Base app resource controller.
     *
     * @param Gate $gate Gate contract realization.
     * @param IRestfulServiceFactory $restfulServiceFactory Restful service factory
     * @param IDataTransformer|null $transformer Result transformer
     *
     * @throws \InvalidArgumentException
     * @throws RestfulServiceException
     */
    public function __construct(
        Gate $gate,
        IRestfulServiceFactory $restfulServiceFactory,
        IDataTransformer $transformer = null
    ) {
        parent::__construct($transformer);
        $this->restfulServiceFactory = $restfulServiceFactory;
        $this->serviceManager = $restfulServiceFactory->buildRestfulService($this->modelClass);
        $this->repository = $this->serviceManager->getRepository();
        $gate->getPolicyFor($this->modelClass);
    }

    /**
     * Returns models collection by given params.
     *
     * @param Request $request Request with paging or cursor data
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $searchValues = $request->only($this->repository->searchableFields);

        switch ($this->paging) {
            case PagingType::PAGINATOR:
                return $this->response->paginator(
                    $this->repository->getPage($this->readPaging($request), $searchValues),
                    $this->transformer
                );
            case PagingType::CURSOR:
                return $this->response->item(
                    $this->repository->getCursorPage($this->readCursor($request), $searchValues),
                    $this->transformer
                );
            default:
                $sortOptions = new SortOptions($this->sortField, $this->sortType);

                return $this->response->collection(
                    $this->repository->getWhereWithSorting($searchValues, $sortOptions),
                    $this->transformer
                );
        }
    }

    /**
     * Creates new model.
     *
     * @param Request $request Request with data to create model
     *
     * @return Response
     *
     * @throws ValidationException
     */
    public function create(Request $request): Response
    {
        return $this->json($this->serviceManager->create($request->toArray()));
    }

    /**
     * Creates new model.
     *
     * @param Request $request Request with data to create model
     *
     * @return Response
     *
     * @throws ValidationException
     */
    public function store(Request $request): Response
    {
        return $this->create($request);
    }

    /**
     * Shows entity.
     *
     * @param Model $model Model to show
     *
     * @return Response
     */
    public function show(Model $model): Response
    {
        return $this->response->item($model, $this->transformer);
    }

    /**
     * Updates entity.
     *
     * @param Request $request Request with data to update model
     * @param Model $model Model to update
     *
     * @return Response
     *
     * @throws ValidationException
     */
    public function update(Request $request, Model $model): Response
    {
        $this->serviceManager->update($model, $request->toArray());
        return $this->response->item($model, $this->transformer);
    }

    /**
     * Destroys entity.
     *
     * @param Model $model Model to delete
     *
     * @return Response
     * @throws RestfulServiceException
     */
    public function destroy(Model $model): Response
    {
        $this->serviceManager->delete($model);
        return $this->response->noContent();
    }

    /**
     * Returns the existing entities count.
     *
     * @return Response
     */
    public function count(): Response
    {
        $count = $this->repository->count();
        return new Response(['count' => $count]);
    }
}
