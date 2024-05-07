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
        Schema::create('product_measurment_price_deatils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')->on('vendor_products')
                ->onDelete('cascade');
            $table->unsignedBigInteger('measurment_quantity');
            $table->unsignedBigInteger('stock');
            $table->unsignedBigInteger('price');
            $table->string('currency');
            $table->json('color');
            $table->json('stock_color_wise');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_measurment_price_deatils');
    }
};
