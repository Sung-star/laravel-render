<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();

            // ✅ Khóa ngoại chuẩn hóa
            $table->foreignId('orderid')
                ->constrained('orders')
                ->onDelete('cascade');

            $table->foreignId('productid')
                ->constrained('products')
                ->onDelete('cascade');

            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};
