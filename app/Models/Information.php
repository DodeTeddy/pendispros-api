<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'information';
    protected $fillable = [
        'id',
        'create_by',
        'title_information',
        'detail_information'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
}
