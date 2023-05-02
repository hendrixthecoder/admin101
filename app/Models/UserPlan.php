<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'pay_day',
        'days_left',
    ];

    protected $casts = [
        'pay_day' => 'datetime'
    ];

    public function getDaysLeftAttribute ($value) {
        // Trick to get days left for each plan
        return ($this->pay_day)->diffInDays(now());
    }

}
