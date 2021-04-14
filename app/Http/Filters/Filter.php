<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    /**
     * The request instance
     *
     * @var Request
     */
    public Request $request;

    /**
     * The builder instance
     *
     * @var Builder
     */
    protected Builder $builder;

    /**
     * Create a new filter instance
     *
     * @param   Request $request
     * @return  void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filters on the builder
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach($this->request->all() as $name => $value)
        {
            if (method_exists($this, $name))
                call_user_func_array([$this, $name], array_filter([$value]));
        }

        return $this->builder;
    }

}
