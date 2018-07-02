<?php

namespace App\Models\Repositories;

use App\Contracts\IRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Saritasa\DTO\SortOptions;
use Saritasa\Exceptions\RepositoryException;
use Saritasa\Repositories\Base\Repository;

/**
 * Base application repository.
 */
class AppRepository extends Repository implements IRepository
{
    /**
     * Base application repository.
     *
     * @param string $modelClass Model class
     * @throws RepositoryException
     */
    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
        try {
            parent::__construct();
        } catch (\Throwable $exception) {
            throw new RepositoryException($this, $exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function firstOrFail(): Model
    {
        return $this->query()->firstOrFail();
    }

    /**
     * Returns the entities count.
     *
     * @return integer
     */
    public function count(): int
    {
        return $this->query()->count();
    }

    /**
     * {@inheritdoc}
     */
    public function getWhereWithSorting(array $fieldValues, SortOptions $sortOptions): Collection
    {
        return $this->query()
            ->orderBy($sortOptions->orderBy, $sortOptions->sortOrder)
            ->where($fieldValues)
            ->get();
    }
}
