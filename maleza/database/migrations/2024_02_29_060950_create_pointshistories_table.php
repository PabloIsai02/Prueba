<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointshistories', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('order_id');
            $table->integer('earned_points');
            $table->integer('redeemed_points');
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
        Schema::dropIfExists('pointshistories');
    }
};
