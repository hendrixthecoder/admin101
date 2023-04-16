<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('plan_name');
            $table->integer('plan_user_id')->nullable();
            $table->integer('min_deposit');
            $table->integer('max_deposit');
            $table->integer('duration');
            $table->float('daily_earnings');
            $table->integer('minimum_withdrawal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investment_plans');
    }
}
