<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // buyer details
            $table->string('name');
            $table->string('city');
            $table->string('state');
            $table->string('address');
            $table->integer('pincode');
            $table->bigInteger('phone_no');

            // instamojo payment details
            // payment_id=MOJO0713D05A81715403, payment_request_id=aab23366c8a24a6c9ec7d6addf885a92
            $table->string('payment_id')->nullable();
            $table->string('payment_request_id')->nullable();

            // item purchase details
            $table->foreignId('product_id')->constrained('products');
            $table->decimal('qnty')->default(1.0);
            $table->decimal('total_amnt');

            // payment status
            $table->enum('payment_status', ['pending', 'complete'])->default('pending');

            // order status
            // $table->enum('order_status', ['processing', 'dispatched', 'delivered'])->default('processing');

            // user and seller
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}
