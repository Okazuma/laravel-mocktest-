<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;


class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categoryIds = Category::pluck('id')->toArray();


        $items = [];

        for ($i = 1; $i <= 10; $i++){
        $items [] = [
            'user_id' => '1',
            'name' => 'インナー1',
            'item_image' => NULL,
            'price' => '4000',
            'description' => 'テストテストテストテストテストテストテストテストテストテスト',
            'condition' => '良好',
            ];
        }

        for ($i = 1; $i <= 5; $i++) {
        $items[] = [
            'user_id' => '1',
            'name' => 'パンツ' . $i,
            'item_image' => NULL,
            'price' => '5000',
            'description' => 'テストテストテストテストテストテストテストテストテストテスト',
            'condition' => '良好',
            ];
        }

        foreach ($items as $itemData) {
            $item = Item::create($itemData);
            $item->categories()->attach([1,12]);
        }

    }
}
