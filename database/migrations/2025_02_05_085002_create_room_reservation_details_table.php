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
        Schema::create('room_reservation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_reservation_id');
            $table->string('room_type');
            $table->unsignedBigInteger('room_or_apartment_id');
            $table->unsignedInteger('adult')->default(0);
            $table->unsignedInteger('child')->default(0);
            $table->unsignedInteger('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reservation_details');
    }
};
