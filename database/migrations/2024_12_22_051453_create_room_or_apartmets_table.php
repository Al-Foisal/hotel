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
        Schema::create('room_or_apartmets', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['Room','Apartment']);
            $table->unsignedBigInteger('room_type_id');
            $table->unsignedBigInteger('floor_id');
            $table->string('room_number');
            $table->integer('price');
            $table->string('capacity')->nullable();
            $table->string('diameter')->nullable();
            $table->string('wifi_password')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_or_apartmets');
    }
};
