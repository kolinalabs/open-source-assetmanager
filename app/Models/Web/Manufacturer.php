<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'name',
    ];

    public function index()
    {
        return $this->all();

    }
}
