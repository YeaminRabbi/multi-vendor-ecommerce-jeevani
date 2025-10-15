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
        \Illuminate\Support\Facades\DB::statement("
            CREATE VIEW seller_products AS
            SELECT
                p.*,
                s.name AS shop_name,
                u.id AS user_id,
                u.name AS user_name,
                u.email AS user_email
            FROM
                products p
            JOIN
                shops s ON p.shop_id = s.id
            JOIN
                users u ON s.user_id = u.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::statement("DROP VIEW IF EXISTS seller_products;");
    }
};
