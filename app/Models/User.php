<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as AuthCanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements AuthCanResetPassword
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'f_name',
        'l_name',
        'email',
        'password',
        'p_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFiltered() {
        return Model::where('is_admin', false);
    }

    public function deposits () {
        return $this->hasMany(Deposits::class);
    }

    public function withdrawals () {
        return $this->hasMany(Withdrawal::class);
    }

    public function transactions () {
        return $this->hasMany(Transaction::class);
    }

    public function investmentPlans () {
        return $this->belongsToMany(InvestmentPlans::class)->withPivot('amount','pay_day');
    }

    public function getAmountInvested () {
        return $this->investmentPlans->map(function($item){
            return $item->pivot->amount;
        })->sum();
    }

    public function getDateInvestment () {
        return $this->investmentPlans->map(function ($transaction){
            return $transaction->pivot->pay_day;
        });
    }

    public function returnAmountInvested () {
        return $this->transactions->where('source', 'Capital')->where('end_day', '<', now())->sum('amount');
    }

    public function getDueProfit () {
        return $this->transactions->where('whereToCredit', 'Profit')->where('pay_day', '<=', now())->sum('amount');
    }

    public function getReversedProfit () {
        return $this->transactions->where('whereToDebit', 'Profit')->sum('amount');
    }

    public function getReversedBonus () {
        return $this->transactions->where('whereToDebit', 'Bonus')->sum('amount');
    }

    public function getReversed () {
        return $this->transactions->where('whereToDebit', 'Balance')->sum('amount');
    }

    public function getProcessedBalanceCredits () {
        return $this->transactions->where('type', 'Credit')->where('whereToCredit', 'Balance')->where('source', '!=', 'Capital')->sum('amount');
    }

    public function getBonusCredits () {
        return $this->transactions->where('type', 'Credit')->where('whereToCredit', 'Bonus')->sum('amount');
    }

    public function getProcessedDebits () {
        return $this->getReversedProfit() + $this->getReversedBonus() + $this->getReversed();
    }

    public function totalAmountInvested () {
        return $this->transactions->where('source', 'Capital')->sum('amount');
    }

    public function getWalletBalance () {
        return $this->deposits->where('status', 'Processed')->sum('amount') - $this->totalAmountInvested();
    }

    public function getBonusBalance () {
        return $this->getBonusCredits() - $this->withdrawals->where('source', 'Bonus')->sum('amount');
    }

    public function getProcessedWithdrawals () {
        return $this->withdrawals->where('status', 'Processed')->sum('amount');
    }

    public function getDeductableProfit () {
        return $this->getDueProfit() - ($this->getReversedProfit() + $this->getProcessedWithdrawals());
    }

    public function getBalance () {
        $processedDeposits = $this->deposits->where('status', 'Processed')->sum('amount');

        if($this->investmentPlans->isEmpty()){
            $balance = ($processedDeposits + $this->getProcessedBalanceCredits() + $this->getDueProfit() + $this->getBonusCredits()) - ($this->getProcessedDebits() + $this->getProcessedWithdrawals());
            
        }else{
            $balance = ($processedDeposits + $this->getProcessedBalanceCredits() + $this->getDueProfit() + $this->getBonusCredits() + $this->returnAmountInvested()) - ($this->getProcessedDebits() + $this->getProcessedWithdrawals() + $this->getAmountInvested());
        }

        return $balance;
    }
}
