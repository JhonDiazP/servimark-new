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
        Schema::create('history_user_status', function (Blueprint $table) {
            $table->id();

            $table->uuid('user_id');
            $table->unsignedBigInteger('user_status_id');
            $table->text('description');
            $table->uuid('user_id_updated_by');
            
            $table->index('user_id');
            $table->index('user_status_id');
            $table->index('user_id_updated_by');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_id_updated_by')->references('id')->on('users');
            $table->foreign('user_status_id')->references('id')->on('user_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_user_status');
    }
};
