<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->string('ticket_class'); // Menambahkan kolom ticket_class
            $table->string('buyer_name');
            $table->string('email');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->enum('status', ['Pending', 'Paid', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};