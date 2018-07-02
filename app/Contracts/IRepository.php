<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Saritasa\DTO\SortOptions;
use Saritasa\Repositories\Base\IRepository as SaritasaRepository;

/**
 * App repository interface. All repositories should implement this interface.
 */
interface IRepository extends SaritasaRepository
{
    /**
     * Returns first model or fails.
     *
     * @return Model
     */
    public function firstOrFail(): Model;

    /**
     * Returns the existing entities count.
     *
     * @return integer
     */
    public function count(): int;

    /**
     * Returns ordered collection of models.
     *
     * @param array $fieldValues Filter values
     * @param SortOptions $sortOptions Requested sort options
     * @return Collection
     */
    public function getWhereWithSorting(array $fieldValues, SortOptions $sortOptions): Collection;
}
