<?php

namespace Database\Seeders;

use App\Models\PaymentDetails;
use Illuminate\Database\Seeder;

class PaymentDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentDetail1 = PaymentDetails::create([
            'address' => 'ebwlerqeyrfgoqeuyrv',
            'status' => 1,
            'name' => 'BTC',
            'identifier' => 'btc',
            'path' => 'https://marathn.co/system/wallet/btc_address.jpeg'
        ]);

        $paymentDetail2 = PaymentDetails::create([
            'address' => 'qerqerqerqverq343gf3fre',
            'status' => 1,
            'name' => 'USDT(Trc20)',
            'identifier' => 'usdt',
            'path' => 'https://marathn.co/system/wallet/usdt_address.jpeg'
        ]);

        $paymentDetail3 = PaymentDetails::create([
            'address' => 'erblerhvqlehrqwvqyuwvquuw',
            'status' => 1,
            'name' => 'ETH',
            'identifier' => 'eth',
            'path'=> 'https://marathn.co/system/wallet/eth_address.jpeg'
        ]);

        $paymentDetail4 = PaymentDetails::create([
            'address' => 'qrebqyvou3yeo1uv314134',
            'status' => 1,
            'name' => 'Perfect Money',
            'identifier' => 'pmoney'
        ]);

    }
}
