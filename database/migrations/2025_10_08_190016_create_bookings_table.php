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
            $table->string('userName');
            $table->enum('status', ['approved','cancelled'])->default('approved');
            $table->text('note')->nullable();
            $table->string('phone');
            $table->string('card_number')->nullable();
            $table->integer('userId');
            $table->integer('appointmentId');
            $table->integer('queue_number')->nullable();
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
