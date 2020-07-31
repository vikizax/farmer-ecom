<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->decimal('stock_qnty');
            $table->integer('price');
            $table->enum('type', ['packet', 'g', 'kg'])->default('kg'); // true = weight based | false = packet products,
            $table->string('description');
            $table->foreignId('category_id')->constrained('product_category')->onDelete('cascade');
            $table->boolean('approved')->default(false);
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
