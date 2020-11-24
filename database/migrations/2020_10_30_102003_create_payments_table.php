<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_id')->nullable();
            $table->string('state');
            $table->string('method')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('user_id');
            $table->string('invoice_path')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
