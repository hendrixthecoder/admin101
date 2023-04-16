<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = Settings::create([
            'allow_withdrawals' => true,
            'minimum_withdrawal' => 10,
            'kyc' => false,
            'referral_bonus_first' => 10,
            'referral_bonus_second' => 5,
            'referral_bonus_third' => 3,
        ]);
    }
}
