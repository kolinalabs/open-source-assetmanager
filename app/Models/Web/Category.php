<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'position',
        'description',
    ];

    public function index()
    {
        return $this->all();
    }
}
