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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_status_id')->default(1);
            $table->unsignedSmallInteger('identification_type_id');
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->string('identification', 32)->unique();
            $table->string('first_name', 32);
            $table->string('middle_first_name', 32)->nullable();
            $table->string('last_name', 32);
            $table->string('middle_last_name', 32)->nullable();
            $table->string('username', 32)->unique();
            $table->string('phone', 32)->unique();
            $table->string('phone_home')->nullable();
            $table->unsignedBigInteger('municipality_id');
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();

            $table->index('user_status_id');
            $table->index('identification_type_id');
            $table->index('gender_id');
            $table->index('municipality_id');

            $table->foreign('user_status_id')->references('id')->on('user_status');
            $table->foreign('identification_type_id')->references('id')->on('identification_types');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('gender_id')->references('id')->on('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
