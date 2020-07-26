<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
    ];

    public function index()
    {
        return $this->all();
    }
}
