<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'province';
    protected $fillable = [
        'id',
        'province_name'
    ];

    /**
     * Get all of the city for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function city()
    {
        return $this->hasMany(City::class, 'province_id');
    }
}
