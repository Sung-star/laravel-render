<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // ✅ Cột customerid liên kết tới bảng customers
            $table->foreignId('customerid')
                ->constrained('customers') // trỏ đúng bảng customers
                ->onDelete('cascade');     // nếu xóa customer thì xóa luôn order

            // ✅ Sử dụng timestamp thay vì default(now())
            $table->date('orderdate')->nullable();

            // Ghi chú cho đơn hàng
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
