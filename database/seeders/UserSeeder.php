<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'f_name' => 'Henry',
            'l_name' => 'Danger',
            'p_number' => '12345378',
            'username' => 'olduser',
            'email' => 'cat@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => false,
            'referral_key' => 3256,
            'status' => 'Active',
            'referred_by' => 3456,
            'can_withdraw' => true,
            'kyc_status' => 'Unverified',
            'country' => 'Nigeria'
        ]);

        $user->attachRole('user');

        $user = User::create([
            'f_name' => 'Jimmy',
            'l_name' => 'Neutron',
            'p_number' => '12345678',
            'username' => 'newuser',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => false,
            'referral_key' => 3456,
            'status' => 'Active',
            'referred_by' => 4555,
            'can_withdraw' => true,
            'kyc_status' => 'Unverified',
            'country' => 'Nigeria'
        ]);

        $user->attachRole('user');

        $user2 = User::create([
            'f_name' => 'Sandy',
            'l_name' => 'Cheeks',
            'p_number' => '12345678',
            'username' => 'sandycheeks',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => false,
            'referral_key' => 4555,
            'status' => 'Active',
            'referred_by' => 1234,
            'can_withdraw' => true,
            'kyc_status' => 'Unverified',
            'country' => 'Nigeria'
        ]);

        $user2->attachRole('user');

        $user3 = User::create([
            'f_name' => 'Patrick',
            'l_name' => 'Star',
            'p_number' => '12345678',
            'username' => 'patrickstar',
            'email' => 'user3@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => false,
            'referral_key' => 1234,
            'status' => 'Active',
            'referred_by' => 2345,
            'can_withdraw' => true,
            'kyc_status' => 'Unverified',
            'country' => 'Nigeria'
        ]);

        $user3->attachRole('user');

        $admin = User::create([
            'f_name' => 'admin',
            'l_name' => 'Neutron',
            'p_number' => '12345678',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
            'referral_key' => 2345,
            'status' => 'Active',
            'can_withdraw' => true,
            'kyc_status' => 'Unverified',
            'country' => 'Nigeria'
        ]);

        $admin->attachRole('admin');
    }
}
