<?php

namespace Database\Seeders;

use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        NguoiDung::create([
            'TaiKhoan' => 'admin',
            'MatKhau' => Hash::make('123456'),
            'Email' => 'nhixinhgai2110@gmail.com',
            'MaNhanVien' => '2110',
            'MaVaiTro' => '0',
        ]);
    }
}
