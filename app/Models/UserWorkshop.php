<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWorkshop extends Model
{
    use HasFactory;
    protected $table = 'user_workshop';
    protected $fillable = [
        'user_id',
        'workshop_name',
        'city_id',
        'province_id',
        'address',
        'phone_number',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function province(){
        return $this->belongsTo(Province::class, 'province_id');
    }
}
