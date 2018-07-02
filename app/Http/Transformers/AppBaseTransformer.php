<?php

namespace App\Http\Transformers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Saritasa\Transformers\BaseTransformer;

/**
 * Converts model to raw array.
 * If model has date fields, converts them to ISO 8601 format with applying server timezone.
 */
class AppBaseTransformer extends BaseTransformer
{
    /**
     * {@inheritdoc}
     *
     * Applies server timezone to all dates.
     */
    protected function datesToISO8601(array $result, Model $model): array
    {
        foreach ($model->getDates() as $field) {
            /**
             * Date to convert in iso format.
             *
             * @var Carbon $value
             */
            $value = $model->getAttributeValue($field);
            $result[$field] = $value ? $value->setTimezone(config('app.server_timezone'))
                ->toIso8601String() : null;
        }

        return $result;
    }
}
