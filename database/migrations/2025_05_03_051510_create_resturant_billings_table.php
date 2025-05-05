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
        Schema::create('resturant_billings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->unsignedBigInteger('total')->default(0);
            $table->unsignedBigInteger('vat')->default(0);
            $table->unsignedBigInteger('vat_amount')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->enum('discount_type',["Flat","Percentage"])->default('Flat');
            $table->unsignedBigInteger('discount_amount')->default(0);
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('paid_amount')->default(0);
            $table->unsignedBigInteger('due')->default(0);
            $table->unsignedBigInteger('changes')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resturant_billings');
    }
};
