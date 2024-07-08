<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CacLeadsModel extends Model
{
    protected $table = 'cacleads';
    protected $fillable = [
        'form_name',
        'platform',
        'state',
        'city',
        'first_name',
        'last_name',
        'company_name',
        'phone',
        'email',
        'remark'
    ];
}
