<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'payment_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'unit_key',
        'move_in_date',
        'insurance_id',
        'pay_amount',
        'created_date',
        'remarks',
    ];

    protected $dates = ['move_in_date', 'created_date'];
}
