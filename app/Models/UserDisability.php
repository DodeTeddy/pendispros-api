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
        'city',
        'province',
        'age',
        'address',
        'phone_number',
        'disability',
        'explanation'
    ];
}
