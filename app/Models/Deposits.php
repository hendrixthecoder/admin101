<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Deposits extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'plan_id',
        'source',
    ];

    protected $table = 'deposits';

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function getDeposits (Request $request) {
        return Model::where('user_id', $request->user()->id);
    }

}
