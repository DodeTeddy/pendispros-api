<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDisability extends Model
{
    use HasFactory;
    protected $table = 'user_disability';
    protected $fillable = [
        'user_id',
        'name',
        'city_id',
        'province_id',
        'age',
        'address',
        'phone_number',
        'disability',
        'jenis_amputasi_kiri',
        'jenis_amputasi_kanan',
        'jenis_prostetik'
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
