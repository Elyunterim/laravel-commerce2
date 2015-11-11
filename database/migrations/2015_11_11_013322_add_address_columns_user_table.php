<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressColumnsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('street_one')->default('');
            $table->string('city', 70)->default('');
            $table->string('state', 50)->default('');
            $table->string('country', 70)->default('');
            $table->string('postal_code', 30)->default('');
            $table->string('phone', 30)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('street_one');
            $table->removeColumn('city');
            $table->removeColumn('state');
            $table->removeColumn('country');
            $table->removeColumn('postal_code');
            $table->removeColumn('phone');
        });
    }
}
