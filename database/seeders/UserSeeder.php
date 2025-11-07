<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ⚠️ Xóa dữ liệu cũ
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 1; $i <= 9; $i++) {
            DB::table('users')->insert([
                'fullname' => 'Nguyen Van A' . $i,
                'username' => 'user' . $i,
                'password' => Hash::make('123456'),
                'email' => 'user' . $i . '@gmail.com',
                'role' => 1,
            ]);
        }
    }
}
