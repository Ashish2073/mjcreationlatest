<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade'); // Foreign Key

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')->on('vendor_products')
                ->onDelete('cascade');

            // Foreign Key
            $table->string("product_measurment_amount");
            $table->string("product_measurment_unit");

            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
