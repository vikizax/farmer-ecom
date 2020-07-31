<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsCustomerReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_customer_review', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('review');
            $table->string('name');
            $table->string('designation')->default('Customer');
            $table->string('image')->default('user.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_customer_review');
    }
}
