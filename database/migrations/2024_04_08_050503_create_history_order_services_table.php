<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_order_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_service_id');
            $table->integer('total_amount');

            $table->index('order_service_id');

            $table->foreign('order_service_id')->references('id')->on('order_services');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_order_services');
    }
};
