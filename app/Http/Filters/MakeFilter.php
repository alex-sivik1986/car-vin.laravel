<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class MakeFilter extends Filter
{
    public function mark(Builder $builder, $value)
    {
        $builder->where('name', 'like', "{$value}%")->with('models');
    }
}
