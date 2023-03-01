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
            $table->string("invoiceCode");
            // $table->unsignedInteger("companyId")
            //     ->foreign()
            //     ->references('id')
            //     ->on("companies")
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            // $table->unsignedInteger("deliveryGuyId")
            // ->nullable()
            // ->foreign()
            // ->references('id')
            // ->on("delivery_guys");
            $table->foreignId('companyId')->nullable()->constrained('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('deliveryGuyId')->nullable()->constrained('delivery_guys')->onDelete('cascade')->onUpdate('cascade');


            $table->boolean("isPaid");
            $table->decimal("delivaryFees", 4, 3)->nullable();
            $table->enum(
                "status",
                ['onDelivering', 'delivered', 'cancelled', 'waiting', 'returned']
            )->default('waiting');

            $table->string("city");
            $table->string("street");
            $table->char("buildingNumber", 100)->nullable();
            $table->char("floorNumber", 100)->nullable();
            $table->char("apartmentNumber", 100)->nullable();
            $table->decimal("totalPrice", 9, 5);
            $table->timestamp('orderDate')->useCurrent();
            $table->string("clientName", 100);
            $table->string("clientPhone");
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
