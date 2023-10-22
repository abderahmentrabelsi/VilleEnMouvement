<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('orderables', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('orderable_id');
            $table->string('orderable_type');
            $table->primary(['order_id', 'orderable_id', 'orderable_type']);
            $table->integer('quantity');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orderables');
    }
}
