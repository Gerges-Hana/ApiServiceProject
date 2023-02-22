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
        Schema::create('delivery_guys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('nationalId', 100);
            $table->string('phone', 100);
            $table->string('motorCycleNumber', 100);
            $table->string('email')->unique();
            $table->string('userName', 100)->unique();
            $table->string('password');
            $table->timestamp('createdAt')->useCurrent();
            $table->decimal('salary', 9, 2);
            $table
                ->unsignedInteger('companyId')
                ->nullable()
                ->foreign()
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('delivery_guys');
    // }
};
