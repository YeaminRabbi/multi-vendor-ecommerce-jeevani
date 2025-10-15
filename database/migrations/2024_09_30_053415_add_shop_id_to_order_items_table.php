<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders_items', function (Blueprint $table) {
            // Add the shop_id column
            $table->unsignedBigInteger('shop_id')->nullable();

            // Define the foreign key constraint for shop_id
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders_items', function (Blueprint $table) {
            // Drop the shop_id column and foreign key constraint
            $table->dropForeign(['shop_id']);
            $table->dropColumn('shop_id');
        });
    }
};
