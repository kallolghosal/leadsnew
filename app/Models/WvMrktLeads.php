<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WvMrktLeads extends Model
{
    protected $table = 'wvmrkt';
    protected $fillable = [
        'platform',
        'exporting',
        'ecommexp',
        'enterprise',
        'business_name',
        'business_type',
        'hereabtus',
        'full_name',
        'phone',
        'email',
        'city',
        'state',
        'status'
    ];
}
