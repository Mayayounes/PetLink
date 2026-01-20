<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('breed'); 
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->text('medical_history');
            $table->string('image');
            $table->timestamps();
        });
    }


};
