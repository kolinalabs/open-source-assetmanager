<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'place_id',
        'manufacturer_id',
        'category_id',
        'model',
        'description',
        'state',
        'patrimony',
        'aquisition_value',
    ];

    public function index()
    {
        return $this->all();
    }
}
