<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    protected Request $request;
    protected Builder $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder) : Builder
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $name => $value)
        {
            if (method_exists($this, $name) && !empty($value))
            {
                call_user_func([$this, $name], $builder, $value);
            }
        }
        return $this->builder;
    }
}
