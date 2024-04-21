<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('name');
            $table->string('phone')->after('email');
            $table->integer('status')->default('1')->after('password');
            $table->integer('level_id')->default('1')->after('status');
            $table->string('image')->default('placeholder.png')->after('level_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("status");
            $table->dropColumn("level_id");
            $table->dropColumn("surname");
            $table->dropColumn("phone");
            $table->dropColumn("image");

        });
    }
};
