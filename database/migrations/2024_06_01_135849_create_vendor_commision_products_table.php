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
        Schema::create('vendor_commision_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')->on('vendor_products')
                ->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->enum('type', ['flat', 'percentage']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_commision_products');
    }
};
