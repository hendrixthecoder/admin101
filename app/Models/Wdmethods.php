<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wdmethods extends Model
{
    use HasFactory;

    protected $table = 'wdmethods';

    protected $fillable = [
        'method_name',
        'minimum_amount',
        'maximum_account',
        'charges_amount',
        'charges_percentage',
        'payout_duration',
        'status',
    ];
}
