<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('address');
            $table->string('phone');
            $table->string('zip_code');
            $table->string('city');
            $table->string('provison');
            $table->string('country');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
            $table->dropColumn('provison');
            $table->dropColumn('country');
            $table->dropColumn('email');
        });
    }
}
