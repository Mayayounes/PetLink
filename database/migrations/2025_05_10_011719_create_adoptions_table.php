<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id(); // Add an auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->date('date'); // Corrected column name and data type
            $table->timestamps();

            // Remove composite primary key.  It's generally better to have a single auto-incrementing primary key.
            // If you need to ensure uniqueness of user_id and pet_id, add a unique index:
            $table->unique(['user_id', 'pet_id']);
        });
    }


};