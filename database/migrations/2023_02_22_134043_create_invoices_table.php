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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger("campanyId")->foreign()->references('id')->on("companies")->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger("deliveryGuyId")->foreign()->references('id')->on("delivery_guys");
            $table->boolean("isPaid");
            $table->decimal("delivaryFees",4,3);
            $table->enum("status",['onDelivering','delivered','cancelled','waitingForDelivery']);
            $table->string("city")->nullable();
            $table->string("street");
            $table->char("buildingNumber",100);
            $table->char("floorNumber",100);
            $table->char("apartmentNumber",100);
            $table->decimal("totalPrice",9,5);
            $table->date('orderDate');
            $table->string("clientName",100);
            $table->string("clienPhone");
            // $table->unsignedInteger("invoiceCode"); //kyro is true
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('invoices');
    // }
};
