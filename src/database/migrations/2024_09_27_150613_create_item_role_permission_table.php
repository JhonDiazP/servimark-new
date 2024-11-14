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
        Schema::create('item_role_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('item_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedSmallInteger('permission_id');

            $table->index('item_id');
            $table->index('role_id');
            $table->index('permission_id');

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('permission_id')->references('id')->on('permission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_role_permission');
    }
};
