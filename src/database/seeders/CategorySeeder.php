<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category' => '洋服'],
            ['category' => '家電'],
            ['category' => 'ゲーム'],
            ['category' => '雑貨'],
            ['category' => '美容'],
            ['category' => '食品'],
            ['category' => '日用品'],
            ['category' => '乗り物'],
            ['category' => 'スポーツ'],
            ['category' => 'アウトドア'],
            ['category' => 'ホビー'],
            ['category' => 'メンズ'],
            ['category' => 'レディース'],
            ['category' => 'キッズ'],
            ['category' => 'その他'],
        ]);
    }
}
