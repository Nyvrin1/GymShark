<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderId')->constrained('orders')->onDelete('cascade'); // Foreign key to orders
            $table->foreignId('productId')->constrained('products')->onDelete('cascade'); // Foreign key to products
            $table->string('productName');
            $table->decimal('productPrice', 10, 2);
            $table->integer('productQuantity');
            $table->decimal('productSubtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};

