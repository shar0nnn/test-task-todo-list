<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;

trait Filterable
{
    public function scopeFilter(Builder $builder): Builder
    {
        $appliedFilters = request('filter');

        if (empty($appliedFilters)) {
            return $builder;
        }

        foreach (array_intersect(array_keys($this->filterable), array_keys($appliedFilters)) as $filter) {
            $values = explode(',', $appliedFilters[$filter]);

            $castedValues = array_map(function ($value) use ($filter) {
                return $this->castToType($this->filterable[$filter], $value);
            }, $values);

            $builder->whereIn($filter, $castedValues);
        }

        return $builder;
    }

    private function castToType(string $type, mixed $value): mixed
    {
        return match ($type) {
            'int', 'integer' => (int)$value,
            'float', 'double' => (float)$value,
            'string' => (string)$value,
            'bool', 'boolean' => (bool)$value,
            'array' => (array)$value,
            'object' => (object)$value,
            default => throw new InvalidArgumentException("Wrong data type: $type"),
        };
    }
}
