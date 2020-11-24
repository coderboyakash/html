<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('mail')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('ins_link')->nullable();
            $table->string('tw_link')->nullable();
            $table->string('you_link')->nullable();
            $table->string('pin_link')->nullable();
            $table->string('lind_link')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('contact_us');
    }
}
