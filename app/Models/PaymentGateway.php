<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'image',
        'order',
        'account_holder_name',
        'account_number',
        'branch_address',
        'swift_code',
        'description'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('admin/images/payment/' .  $value);
        }
        return NULL;
    }
}
