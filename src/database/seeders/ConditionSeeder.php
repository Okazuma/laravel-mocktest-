<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert([
            ['name' => '新品、未使用'],
            ['name' => '未使用品に近い'],
            ['name' => '目立った傷や汚れなし'],
            ['name' => 'やや傷や汚れあり'],
            ['name' => '傷や汚れあり'],
            ['name' => '全体的に状態が悪い'],
            ['name' => 'ジャンク品'],
        ]);
    }
}
