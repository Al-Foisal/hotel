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
        Schema::create('ws_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('person_name');
            $table->string('person_designation')->nullable();
            $table->text('details');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ws_testimonials');
    }
};
