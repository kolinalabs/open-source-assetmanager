<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    protected $fillable = [
        'equipment_id',
        'description',
        'occurred_at',
    ];

    public function index()
    {
        return $this->all();
    }
}
