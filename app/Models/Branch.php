<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'contact_person',
        'location',
        'email',
        'phone',
        'description',
        'order',
    ];
}
