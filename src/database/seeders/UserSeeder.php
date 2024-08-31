<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin =
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('00000000'),
            'postal_code' => '000-0000',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション',
            'profile_image' => NULL, // デフォルトのプロフィール画像
        ]);

        User::create([
            'name' => '東京一郎',
            'email' => 'test1@example.com',
            'password' => bcrypt('11111111'),
            'postal_code' => '105-0011',
            'address' => '東京都港区芝公園4丁目2-8',
            'building' => '東京タワー',
            'profile_image' => '',
        ]);

        User::create([
            'name' => '東京次郎',
            'email' => 'test2@example.com',
            'password' => bcrypt('22222222'),
            'postal_code' => '131-0045',
            'address' => '東京都墨田区押上1丁目1-2',
            'building' => '東京スカイツリー',
            'profile_image' => '',
        ]);

        User::create([
            'name' => '東京三郎',
            'email' => 'test3@example.com',
            'password' => bcrypt('33333333'),
            'postal_code' => '',
            'address' => '',
            'building' => '',
            'profile_image' => '',
        ]);


        $admin->assignRole('admin');
    }
}
