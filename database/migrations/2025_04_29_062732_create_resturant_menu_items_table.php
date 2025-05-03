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
        Schema::create('resturant_menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resturant_menu_item_category_id');
            $table->string('image')->nullable();
            $table->string('name');
            $table->double('price');
            $table->string('formation_duration')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resturant_menu_items');
    }
};
