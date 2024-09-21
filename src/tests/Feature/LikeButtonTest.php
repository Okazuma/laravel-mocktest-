<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;

class LikeButtonTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\ConditionSeeder::class);
    }

    // ゲストユーザーがいいねを押した時のテスト
    public function test_guest_is_redirected_to_login()
    {
        $condition = Condition::create(['id' => 1, 'name' => '新品']);
        $item = Item::create([
            'user_id' =>  User::factory()->create()->id,
            'name' => 'Test Item',
            'price' => 1000,
            'item_image' => 'path/to/image.jpg',
            'description' => 'Test description',
            'condition_id' => $condition->id,
        ]);
        Livewire::test('like-button', ['itemId' => $item->id])
            ->call('toggleLike')
            ->assertRedirect(route('loginView'));
    }



    // ログインユーザーがいいねを押した時のテスト
    public function test_user_can_like_an_item()
    {
        $condition = Condition::create(['id' => 1, 'name' => '新品']);
        $user = User::factory()->create();
        $item = Item::create([
            'user_id' => $user->id,
            'name' => 'Test Item',
            'price' => 1000,
            'item_image' => 'path/to/image.jpg',
            'description' => 'Test description',
            'condition_id' => $condition->id,
        ]);
        $this->actingAs($user);

        Livewire::test('like-button', ['itemId' => $item->id])
            ->call('toggleLike');

        $this->assertDatabaseHas('likes', [
            'item_id' => $item->id,
            'user_id' => $user->id,
        ]);
    }



    // ゲストユーザーがいいねを取り消すテスト
    public function test_user_can_unlike_an_item()
    {
        $condition = Condition::create(['id' => 1, 'name' => '新品']);
        $user = User::create([
            'name' => 'Test User',
            'email' => 'unlike-test@example.com',
            'password' => bcrypt('password'),
            'postal_code' => '123-4567',
            'address' => 'TestAddress',
            'building' => '',
            'profile_image',
        ]);
        $item = Item::create([
            'user_id' => $user->id,
            'name' => 'Test Item',
            'price' => 1000,
            'item_image' => 'path/to/image.jpg',
            'description' => 'Test description',
            'condition_id' => $condition->id,
        ]);

        Like::create([
            'item_id' => $item->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        Livewire::test('like-button', ['itemId' => $item->id])
            ->call('toggleLike');

        $this->assertDatabaseMissing('likes', [
            'item_id' => $item->id,
            'user_id' => $user->id,
        ]);
    }
}

