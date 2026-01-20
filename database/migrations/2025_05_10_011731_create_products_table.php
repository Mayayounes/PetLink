<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price_of_single_product'); // Use decimal for currency
            $table->string('category');
            $table->integer('quantity'); // Provide a default value
            $table->string('image'); // Allow null values
            $table->timestamps();
        });
    }


};