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
        Schema::create('resturant_billing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resturant_billing_id');
            $table->unsignedBigInteger('menu_item_id');
            $table->string('menu_item_name');
            $table->unsignedBigInteger('menu_item_price')->default(0);
            $table->unsignedBigInteger('menu_item_quantity')->default(0);
            $table->unsignedBigInteger('menu_item_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resturant_billing_details');
    }
};
