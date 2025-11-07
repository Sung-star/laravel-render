<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        // ⚠️ Xóa dữ liệu cũ
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();

        // 🧠 Lấy danh sách brand & category
        $brands = DB::table('brands')->pluck('id')->toArray();
        $categories = DB::table('categories')->pluck('cateid')->toArray();

        if (empty($brands) || empty($categories)) {
            echo "⚠️ Bảng brands hoặc categories đang trống!\n";
            return;
        }

        // 🖼 Ảnh và mô tả mẫu
        $images = [
            'airpods_pro2.jpg', 'apple_watch.jpg', 'bose_qc45.jpg', 'dell_xps13.jpg',
            'galaxy_s24.jpg', 'hp_spectre_x360.jpg', 'ipad_pro.jpg', 'iphone15.jpg',
            'logitech_mouse.jpg', 'macbook_pro.jpg', 'mechanical_keyboard.jpg',
            'rog_phone8.jpg', 'sony_headphones.jpg',
        ];

        $descriptions = [
            'Thiết kế tinh tế, hiệu năng mạnh mẽ, pin cực bền.',
            'Sản phẩm chính hãng, bảo hành 12 tháng toàn quốc.',
            'Trải nghiệm mượt mà, phù hợp học tập và làm việc.',
            'Sản phẩm bán chạy nhất, nhận ưu đãi giảm giá hôm nay!',
            'Mẫu mới ra mắt, công nghệ hiện đại, kiểu dáng thời thượng.',
        ];

        // 🔄 Sinh ngẫu nhiên 1000 sản phẩm
        for ($i = 1; $i <= 1000; $i++) {
            DB::table('products')->insert([
                'proname' => "Sản phẩm $i",
                'price' => rand(500000, 50000000),
                'description' => $descriptions[array_rand($descriptions)],
                'cateid' => $categories[array_rand($categories)],
                'brandid' => $brands[array_rand($brands)],
                'fileName' => $images[array_rand($images)],
                'sold' => rand(0, 500),
                'is_featured' => rand(0, 1),
                'stock' => rand(10, 200),
                'has_version' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "✅ Đã seed thành công 1000 sản phẩm an toàn!\n";
    }
}
