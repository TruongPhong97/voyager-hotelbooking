<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Order;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', Order::$statuses)->default(Order::STATUS_PENDING);
            $table->enum('type', Order::$types)->default(Order::TYPE_BOOKING_ORDER);
            $table->string('currency', 3)->default('USD');
            $table->double('discount_total')->nullable();
            $table->double('total_tax')->nullable();
            $table->double('total');
            $table->string('order_items');
            $table->integer('user_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
