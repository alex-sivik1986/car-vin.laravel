<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'makes';
    protected  $guarded = false;

    public function models()
    {
        return $this->hasMany(\App\Models\ModelCar::class, 'make_id', 'api_make_id');
    }
}
