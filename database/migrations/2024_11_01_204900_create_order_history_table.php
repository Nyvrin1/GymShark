<?php

// database/migrations/xxxx_xx_xx_create_order_history_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->string('orderNumber');
            $table->string('product');
            $table->integer('quantity');
            $table->decimal('subtotal', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_history');
    }
}
