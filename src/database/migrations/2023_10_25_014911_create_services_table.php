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
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('service_status_id')->default(1);
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('municipality_id');
            $table->timestamps();

            $table->index('service_status_id');
            $table->index('category_id');
            $table->index('municipality_id');

            $table->foreign('service_status_id')->references('id')->on('service_status');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
