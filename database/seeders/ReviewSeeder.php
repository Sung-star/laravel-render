<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // 🧹 Xoá dữ liệu cũ
        Review::truncate();

        $faker = \Faker\Factory::create('vi_VN');

        $positiveComments = [
            'Sản phẩm rất tốt, đúng mô tả, đáng tiền mua.',
            'Chất lượng tuyệt vời, giao hàng nhanh chóng.',
            'Hài lòng với dịch vụ và sản phẩm của shop.',
            'Đóng gói cẩn thận, nhân viên nhiệt tình.',
            'Sản phẩm hoạt động ổn định, pin bền và đẹp.',
        ];

        $neutralComments = [
            'Sản phẩm tạm ổn, dùng được, nhưng chưa thật sự nổi bật.',
            'Giao hàng hơi chậm một chút nhưng vẫn ổn.',
            'Chất lượng ở mức chấp nhận được so với giá tiền.',
        ];

        $negativeComments = [
            'Sản phẩm không giống mô tả, hơi thất vọng.',
            'Giao hàng trễ, đóng gói sơ sài, chưa hài lòng.',
            'Chất lượng kém, dùng vài ngày đã gặp lỗi.',
        ];

        $products = Product::all();

        foreach ($products as $product) {
            $count = rand(5, 10);
            for ($i = 0; $i < $count; $i++) {
                $rating = rand(1, 5);
                if ($rating >= 4) {
                    $comment = $faker->randomElement($positiveComments);
                } elseif ($rating == 3) {
                    $comment = $faker->randomElement($neutralComments);
                } else {
                    $comment = $faker->randomElement($negativeComments);
                }

                Review::create([
                    'product_id' => $product->id,
                    'user_id' => null,
                    'rating' => $rating,
                    'comment' => $comment,
                    'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                ]);
            }
        }

        $this->command->info('✅ Đã tạo dữ liệu đánh giá tiếng Việt có cảm xúc logic theo sao!');
    }
}
