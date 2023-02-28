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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('userName', 100)->unique();
            $table->string('password');
            $table->integer('numberOfDeliveryGuys')->default(0);
            $table->integer('numberOfRequests')->default(0);
            $table->string('city', 100);
            $table->text('street');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('companies');
    // }
};
