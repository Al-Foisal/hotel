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
        Schema::create('room_reservations', function (Blueprint $table) {
            $table->id();
            $table->date('check_in');
            $table->date('check_out');
            $table->string('arival_from')->nullable();
            $table->string('booking_type')->nullable();
            $table->string('booking_reference')->nullable();
            $table->string('booking_reference_number')->nullable();
            $table->string('purpose_of_visite')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('total')->default(0);
            $table->unsignedBigInteger('vat')->default(0);
            $table->unsignedBigInteger('vat_amount')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->enum('discount_type',["Flat","Percentage"]);
            $table->unsignedBigInteger('discount_amount')->default(0);
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('paid_amount')->default(0);
            $table->unsignedBigInteger('due')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('owner_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reservations');
    }
};
