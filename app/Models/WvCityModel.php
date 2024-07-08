<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WvCityModel extends Model
{
    protected $table = 'wvcities';
    protected $fillable = [
        'city'
    ];
}
