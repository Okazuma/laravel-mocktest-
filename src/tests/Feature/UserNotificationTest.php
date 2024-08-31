<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserNotification;

class UserNotificationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //   ユーザーにお知らせメールが送信されることを確認するテストーーーーーーーーーー
    public function test_user_notification_email_is_sent()
    {
        Mail::fake();

        $user = User::factory()->create();

        Mail::to($user->email)->send(new UserNotification('Test Subject', 'This is a test message'));

        Mail::assertSent(UserNotification::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
