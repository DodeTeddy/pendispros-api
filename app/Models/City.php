<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'city';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'province_id',
        'name'
    ];

    /**
     * Get the province that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function cityWs(){
        return $this->hasOne(UserWorkshop::class);
    }

    public function cityDs(){
        return $this->hasOne(UserDisability::class);
    }
}
