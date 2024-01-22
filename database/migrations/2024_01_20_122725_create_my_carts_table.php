<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_carts', function (Blueprint $table) {
            $table->id();
            $table->string('foodID');
            $table->integer('quantity');
            $table->string('orderID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.S
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_carts');
    }
};
