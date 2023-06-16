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
        Schema::create('item', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('qty')->default(0);
            $table->integer('price')->default(0);
            $table->string('category')->nullable();
            $table->string('supplier')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['available', 'out of stock']);
            $table->string('description')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_models');
    }
};
