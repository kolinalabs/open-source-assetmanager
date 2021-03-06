<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    const STATE_MAINTENANCE         = 'maintenance';
    const STATE_MAINTENANCE_PENDING = 'maintenance_pending';
    const STATE_ACTIVE              = 'active';
    const STATE_INACTIVE            = 'inactive';

    const STATES = [
        self::STATE_MAINTENANCE,
        self::STATE_MAINTENANCE_PENDING,
        self::STATE_ACTIVE,
        self::STATE_INACTIVE,
    ];

    protected $fillable = [
        'place_id',
        'manufacturer_id',
        'category_id',
        'model',
        'description',
        'state',
        'patrimony',
        'acquisition_value',
    ];

    public function getTranslatedStateAttribute()
    {
        return trans('database.equipment.state.'.$this->state);
    }

    /**
     * Relationship with occurrences table
     *
     * @return void
     */
    public function occurrences()
    {
        return $this->hasMany(Occurrence::class);
    }

    public function index()
    {
        return $this->all();
    }
}
