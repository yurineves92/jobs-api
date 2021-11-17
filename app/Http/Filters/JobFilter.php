<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class JobFilter extends Filter
{
    /**
     * Filter the company by the given string.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function company(string $value = null): Builder
    {
        return $this->builder->where('company', 'like', "{$value}%");
    }

    /**
     * Filter the title by the given string.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function title(string $value = null): Builder
    {
        return $this->builder->where('title', 'like', "{$value}%");
    }

    /**
     * Filter the location by the given string.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function location(string $value = null): Builder
    {
        return $this->builder->where('location', 'like', "{$value}%");
    }

    /**
     * Filter the category by the given category.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function category(string $value = null): Builder
    {
        return $this->builder->where('category_id', $value);
    }

    /**
     * Filter the user by the given category.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function user(string $value = null): Builder
    {
        return $this->builder->where('user_id', $value);
    }

    /**
     * Filter the salary by the given category.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function salary(string $value = null): Builder
    {
        return $this->builder->where('salary', $value);
    }

    /**
     * Sort the products by the given order and field.
     *
     * @param  array  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort(array $value = []): Builder
    {
        if (isset($value['by']) && !Schema::hasColumn('jobs', $value['by'])) {
            return $this->builder;
        }

        return $this->builder->orderBy(
            $value['by'] ?? 'created_at',
            $value['order'] ?? 'desc'
        );
    }
}
