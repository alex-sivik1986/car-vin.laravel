<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
    use HasFactory;

    protected $table = 'models';
    protected $guarded = false;
    protected $visible =  ['name', 'make_id'];

    public function make()
    {
        return $this->belongsTo(Make::class, 'api_make_id', 'make_id');
    }
}
