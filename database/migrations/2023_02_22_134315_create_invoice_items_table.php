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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger("ivoiceId")
                ->foreign()
                ->refrences('id')
                ->on("invoices")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->string("name", 100);
            $table->tinyInteger("quantity")->default(1);
            $table->decimal("itemPrice", 5, 2);
            $table->decimal("totalItemsPrice", 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('invoice_items');
    // }
};
