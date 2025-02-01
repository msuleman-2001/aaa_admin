<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';
    protected $primaryKey = 'location_id';
    public $timestamps = false; // We are using custom timestamp fields

    protected $fillable = [
        'location_number',
        'enable',
        'created_by_id',
        'last_updated_by_id',
        'created_datetime',
        'updated_datetime',
    ];
}
