<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
