<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsFooter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_footer', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('footer_description');
            $table->bigInteger('contact_number');
            $table->string('contact_email');
            $table->string('location');
            $table->string('footer_copyright');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_footer');
    }
}
