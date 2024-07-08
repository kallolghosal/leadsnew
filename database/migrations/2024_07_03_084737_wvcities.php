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
        Schema::create('wvcities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city');
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('fbleads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->nullable();
            $table->string('business_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('business_sector')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('cacleads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('form_name')->nullable();
            $table->string('platform')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wvcities');
        Schema::dropIfExists('files');
        Schema::dropIfExists('fbleads');
        Schema::dropIfExists('cacleads');
    }
};
