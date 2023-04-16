<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'allow_withdrawals',
        'minimum_withdrawal',
        'referral_bonus_first',
        'referral_bonus_second',
        'referral_bonus_third',
        'kyc'
    ];
}
