<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('p_number');
            $table->string('can_withdraw');
            $table->string('status');
            $table->string('kyc_status');
            $table->string('country');
            $table->string('pfp_path')->default('empty');
            $table->string('id_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('locale')->default('en');
            $table->string('btc_address')->nullable();
            $table->string('ethereum_address')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_acct_no')->nullable();
            $table->string('bank_acct_name')->nullable();
            $table->string('p_money')->nullable();
            $table->string('usdt_address')->nullable();
            $table->string('referral_key')->unique();
            $table->string('referred_by')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
