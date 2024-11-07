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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customerId')->constrained('customers')->onDelete('cascade'); // Foreign key to customers
            $table->string('orderStatus')->default('pending'); // Status of the order (e.g., pending, completed)
            $table->string('orderNumber')->unique(); // Unique order number
            $table->decimal('orderTotal', 10, 2)->default(0.00); // Total order amount
            $table->date('orderDate')->default(now()); // Order date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
