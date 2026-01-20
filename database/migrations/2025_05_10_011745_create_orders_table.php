<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->datetime('date'); // Changed from date to datetime
            $table->decimal('total_price', 10, 2); // Added precision for decimal
            $table->integer('total_quantity'); // Added missing column
            $table->string('address');
            $table->string('city');
            $table->string('zip_code'); // Changed from integer to string
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};