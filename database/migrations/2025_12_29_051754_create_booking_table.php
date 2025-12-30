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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('travel_date');
            $table->integer('travenlers_no');
            $table->string('pickup_address');
            $table->string('id_type');
            $table->string('id_image');
            $table->string('price')->default(0);
            $table->string('additional_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
