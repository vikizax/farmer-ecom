<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTxnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('txn', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('seller_id')->constrained('sellers');
            $table->foreignId('user_id')->constrained('users');
            $table->string('payment_id');
            $table->decimal('paid_amt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('txn');
    }
}
