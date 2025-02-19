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
        Schema::create('ws_setups', function (Blueprint $table) {
            $table->id();
            $table->string('home_theme');
            $table->text('contact_breadcrumb')->nullable();//
            $table->text('contact_body')->nullable();//
            $table->string('hotel_name');//
            $table->string('slogan')->nullable();//
            $table->string('logo');
            $table->string('favicon')->nullable();
            $table->string('address')->nullable();//
            $table->string('phone')->nullable();//
            $table->string('email')->nullable();//
            $table->string('forwarding_email')->nullable();//
            $table->string('about_hotel')->nullable();//
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ws_setups');
    }
};
