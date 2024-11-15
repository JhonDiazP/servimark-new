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
        Schema::create('history_service_status', function (Blueprint $table) {
            $table->id();
            $table->uuid('service_id');
            $table->unsignedBigInteger('service_status_id');

            $table->index('service_id');
            $table->index('service_status_id');

            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('service_status_id')->references('id')->on('service_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_service_status');
    }
};
