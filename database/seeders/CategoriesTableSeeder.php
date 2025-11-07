<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        // ⚠️ Xóa dữ liệu cũ để tránh trùng khóa
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();

        // 🧠 Seed lại dữ liệu
        for ($i = 1; $i <= 10; $i++) {
            DB::table('categories')->insert([
                'cateid' => $i,
                'catename' => "Danh mục $i",
                'description' => "Mô tả $i",
            ]);
        }
    }
}
