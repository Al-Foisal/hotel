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
        Schema::create('account_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('voucher_number')->unique();
            $table->date('voucher_date');
            $table->string('description')->nullable();
            $table->double('amount');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_vouchers');
    }
};
