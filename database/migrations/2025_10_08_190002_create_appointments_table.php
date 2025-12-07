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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('doctorId');
            $table->string('day');
            $table->time('from_time');
            $table->time('to_time');
            $table->enum('status', ['available','booked','cancelled'])->default('available');
            $table->decimal('price', 8, 2)->default(0); // سعر الموعد
            $table->integer('max_bookings')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
