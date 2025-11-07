<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomersTableSeeder extends Seeder
{
    public function run(): void
    {
        // ⚠️ Xóa dữ liệu cũ
        Schema::disableForeignKeyConstraints();
        DB::table('customers')->truncate();
        Schema::enableForeignKeyConstraints();

        // 🧠 Seed dữ liệu khách hàng mẫu
        for ($i = 1; $i <= 5; $i++) {
            DB::table('customers')->insert([
                'id' => $i,
                'fullname' => "Khách hàng $i",
                'tel' => "0366487029$i", // ✅ đúng tên cột trong migration
                'email' => "customer$i@gmail.com",
                'address' => "Số $i, Quận 1, TP.HCM",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "✅ Đã seed thành công bảng customers!\n";
    }
}
