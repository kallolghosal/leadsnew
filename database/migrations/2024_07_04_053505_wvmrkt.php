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
        Schema::create('wvmrkt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->nullable();
            $table->string('exporting')->nullable();
            $table->string('ecommexp')->nullable();
            $table->string('enterprise')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_type')->nullable();
            $table->string('hereabtus')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wvmrkt');
    }
};
