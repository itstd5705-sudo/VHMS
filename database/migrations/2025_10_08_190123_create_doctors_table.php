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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('specialty')->nullable();
            $table->string('phone')->unique();
            $table->string('imgUrl')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->integer('departmentId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
