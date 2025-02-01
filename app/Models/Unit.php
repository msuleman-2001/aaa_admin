<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class Unit extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $primaryKey = 'unit_id';

    protected $fillable = [
        'location_number',
        'rent_per_month',
        'unit_key',
        'enable',
        'created_by',
        'updated_by',
    ];

    // Optional: Define relationships
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
