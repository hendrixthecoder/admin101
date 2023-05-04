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
            'address' => 'bc1q4n0ddf0drquuvweje65jzmp96xuqkk4f0q3e4q',
            'status' => 1,
            'name' => 'BTC',
            'identifier' => 'btc',
            'path' => 'https://marathn.co/system/wallet/btc_address.jpeg'
        ]);

        $paymentDetail2 = PaymentDetails::create([
            'address' => 'TXzgWFNQaQEMJFPnNVxjhAYKzg97XhqAcN',
            'status' => 1,
            'name' => 'USDT(Trc20)',
            'identifier' => 'usdt',
            'path' => 'https://marathn.co/system/wallet/usdt_address.jpeg'
        ]);

        $paymentDetail3 = PaymentDetails::create([
            'address' => '0x2f9d6F29E61462490Cf9EbbfbD4C073F4894A8AF',
            'status' => 1,
            'name' => 'ETH',
            'identifier' => 'eth',
            'path'=> 'https://marathn.co/system/wallet/eth_address.jpeg'
        ]);

        $paymentDetail4 = PaymentDetails::create([
            'address' => 'U31835402',
            'status' => 1,
            'name' => 'Perfect Money',
            'identifier' => 'pmoney'
        ]);

    }
}
