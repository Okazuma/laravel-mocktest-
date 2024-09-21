<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;


class CommentControllerTest extends TestCase
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

    // ログインユーザーがコメント追加できることを確認するテストーーーーーーーーーー
    public function test_user_can_add_comment()
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
        $response = $this->post(route('store.comment', ['id' => $item->id]), [
            'content' => 'This is a test comment.',
        ]);
        $this->assertDatabaseHas('comments', [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'content' => 'This is a test comment.',
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('message', 'コメントを追加しました');
    }



        // ゲストユーザーがコメント追加できないことを確認するテストーーーーーーーーーー
    public function test_guest_cannot_add_comment()
    {
        $item = Item::create([
            'user_id' => User::factory()->create()->id,
            'name' => 'Test Item',
            'price' => 1000,
            'item_image' => 'path/to/image.jpg',
            'description' => 'Test description',
            'condition_id' => 1,
        ]);
        $response = $this->post(route('store.comment', ['id' => $item->id]), [
            'content' => 'This is a test comment.',
        ]);
        $this->assertDatabaseMissing('comments', [
            'item_id' => $item->id,
            'content' => 'This is a test comment.',
        ]);
        $response->assertRedirect(route('login'));
    }



    // ログインユーザーが自分のコメントを削除できることを確認するテストーーーーーーーーーー
    public function test_user_can_delete_own_comment()
    {
        $user = User::factory()->create();
        $item = Item::create([
            'user_id' => $user->id,
            'name' => 'Test Item',
            'price' => 1000,
            'item_image' => 'path/to/image.jpg',
            'description' => 'Test description',
            'condition_id' => 1,
        ]);
        $comment = Comment::create([
            'item_id' => $item->id,
            'user_id' => $user->id,
            'content' => 'This is a test comment.',
        ]);
        $this->actingAs($user);

        $response = $this->delete(route('comment.destroy', ['comment' => $comment->id]));

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'コメントが削除されました');
    }



    // ログインユーザーが他人のコメントを削除できないことを確認するテストーーーーーーーーーー
    public function test_user_cannot_delete_other_users_comment()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $item = Item::create([
            'user_id' => $user->id,
            'name' => 'Test Item',
            'price' => 1000,
            'item_image' => 'path/to/image.jpg',
            'description' => 'Test description',
            'condition_id' => 1,
        ]);
        $comment = Comment::create([
            'item_id' => $item->id,
            'user_id' => $otherUser->id,
            'content' => 'This is a test comment.',
        ]);
        $this->actingAs($user);

        $response = $this->delete(route('comment.destroy', ['comment' => $comment->id]));

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('error', '権限がありません');
    }
}
