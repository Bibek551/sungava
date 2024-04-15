<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'destination_id',
    ];
}
