<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    protected $fillable = [
        'equipment_id',
        'description',
        'occurred_at',
    ];

    protected $dates = ['occurred_at'];

    public function index()
    {
        return $this->all();
    }
}
