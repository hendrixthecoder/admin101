<?php

namespace Database\Seeders;

use App\Models\InvestmentPlans;
use Illuminate\Database\Seeder;

class InvestmentPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = InvestmentPlans::create([
            'plan_name' => 'Community Bot',
            'min_deposit' => 300,
            'max_deposit' => 4999,
            'duration' => 65,
            'daily_earnings' => 3.5,
            'minimum_withdrawal' => 10
        ]);

        $plan2 = InvestmentPlans::create([
            'plan_name' => 'Personal Bot Pro',
            'min_deposit' => 5000,
            'max_deposit' => 10000,
            'duration' => 80,
            'daily_earnings' => 4,
            'minimum_withdrawal' => 50
        ]);
    }
}
