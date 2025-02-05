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
        Schema::create('room_reservation_other_person_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_reservation_id');
            $table->string('name');
            $table->string('gender');
            $table->string('age')->nullable();
            $table->string('address')->nullable();
            $table->string('type_id')->nullable();
            $table->string('id_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reservation_other_person_details');
    }
};
