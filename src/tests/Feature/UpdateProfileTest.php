<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    // プロフィール更新テストーーーーーーーーーー
    public function test_it_updates_user_profile_successfully()
    {
        $user = User::factory()->create();

        Storage::fake(config('filesystems.default'));

        $file = UploadedFile::fake()->image('profile.jpg');

        $this->actingAs($user);

        $data = [
            'name' => 'New Name',
            'postal_code' => '765-4321',
            'address' => 'New Address',
            'building' => 'New Building',
            'profile_image' => $file,
        ];

        $response = $this->patch(route('updateProfile', ['id' => $user->id]), $data);

        $user->refresh();
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('765-4321', $user->postal_code);
        $this->assertEquals('New Address', $user->address);
        $this->assertEquals('New Building', $user->building);
        $this->assertNotNull($user->profile_image);
        $expectedFilePath = 'profile/' . basename($user->profile_image);

        Storage::disk(config('filesystems.default'))->assertExists($user->profile_image);

        $response->assertRedirect(route('profile', ['id' => $user->id]));
        $response->assertSessionHas('message', 'プロフィールを更新しました');
    }



    // 画像ファイル無しでのプロフィール更新テストーーーーーーーーーー
    public function test_it_handles_no_profile_image()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $data = [
            'name' => 'New Name',
            'postal_code' => '765-4321',
            'address' => 'New Address',
            'building' => 'New Building',
        ];

        $response = $this->patch(route('updateProfile', ['id' => $user->id]), $data);

        $user->refresh();
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('765-4321', $user->postal_code);
        $this->assertEquals('New Address', $user->address);
        $this->assertEquals('New Building', $user->building);
        $this->assertNull($user->profile_image);

        $response->assertRedirect(route('profile', ['id' => $user->id]));
        $response->assertSessionHas('message', 'プロフィールを更新しました');
    }
}
