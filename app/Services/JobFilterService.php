<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class JobFilterService
{
    public function applyFilters(Builder $query, array $filters)
    {
        foreach ($filters as $key => $value) {
            if ($this->isEAVAttribute($key)) {
                $this->applyEAVFilter($query, $key, $value);
            } elseif ($this->isRelationshipFilter($key)) {
                $this->applyRelationshipFilter($query, $key, $value);
            } else {
                $this->applyBasicFilter($query, $key, $value);
            }
        }

        return $query;
    }

    private function applyBasicFilter(Builder $query, string $field, $value)
    {
        if (is_array($value)) {
            [$operator, $filterValue] = $value;
            switch ($operator) {
                case '=':
                case '!=':
                case '>':
                case '<':
                case '>=':
                case '<=':
                    $query->where($field, $operator, $filterValue);
                    break;
                case 'LIKE':
                    $query->where($field, 'LIKE', "%$filterValue%");
                    break;
                case 'IN':
                    $query->whereIn($field, explode(',', $filterValue));
                    break;
            }
        }
    }

    private function applyRelationshipFilter(Builder $query, string $relation, $value)
    {
        [$operator, $filterValue] = $value;
        $query->whereHas($relation, function ($q) use ($operator, $filterValue) {
            if ($operator === 'HAS_ANY') {
                $q->whereIn('name', explode(',', $filterValue));
            } elseif ($operator === 'IS_ANY') {
                $q->where('name', $filterValue);
            } elseif ($operator === 'EXISTS') {
                // فقط التحقق مما إذا كانت العلاقة موجودة
            }
        });
    }

    private function applyEAVFilter(Builder $query, string $attribute, $value)
    {
        [$operator, $filterValue] = $value;
        $query->whereHas('attributes', function ($q) use ($attribute, $operator, $filterValue) {
            $q->where('name', $attribute)
              ->where('value', $operator, $filterValue);
        });
    }

    private function isRelationshipFilter($key)
    {
        return in_array($key, ['languages', 'locations', 'categories']);
    }

    private function isEAVAttribute($key)
    {
        return str_starts_with($key, 'attribute:');
    }
}
