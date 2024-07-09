<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbLeadsModel extends Model
{
    protected $table = 'test-leads';
    protected $fillable = [
        'platform',
        'business_name',
        'full_name',
        'business_sector',
        'state',
        'city',
        'phone',
        'email',
        'remark'
    ];
}
