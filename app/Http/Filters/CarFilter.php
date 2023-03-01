<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CarFilter extends Filter
{
    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function sort(Builder $builder, $value)
    {
        $data = explode("|", $value);
        $builder->orderBy($data[0], $data[1]);
    }

    public function vinCode(Builder $builder, $value)
    {
        $builder->where('vin_code', 'like', "%{$value}%");
    }

    public function search(Builder $builder, $value)
    {
        $builder->where('vin_code', 'like', "%{$value}%")
                ->orWhere('name', 'like', "%{$value}%")
                ->orWhere('country_number', 'like', "%{$value}%");
    }

    public function model(Builder $builder, $value)
    {
        $builder->where('model', $value);
    }

    public function make(Builder $builder, $value)
    {
        $builder->where('make', $value);
    }

    public function mark(Builder $builder, $value)
    {
        $builder->where('make', 'like', "{$value}%");
    }

    public function year(Builder $builder, $value)
    {
        $builder->where('year', $value);
    }
}
