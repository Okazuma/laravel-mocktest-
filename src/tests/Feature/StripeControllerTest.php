<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use Stripe\Stripe;

class StripeControllerTest extends TestCase
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
        Stripe::setApiKey(env('STRIPE_TEST_SECRET'));
    }

    //  クレジットカード選択でstripeにリダイレクトされることを確認するテスト
    public function test_create_checkout_session()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Http::fake([
            'api.stripe.com/v1/checkout/sessions' => Http::response([
                'id' => 'cs_test_4fH3v9FqFBlE2pQ33k8o3pEjH5j2MfIYF2pTn2d3',
                'url' => 'https://fake-url.com',
            ], 200),
        ]);
        $condition = Condition::create(['id' => 1, 'name' => '新品']);
        $user = User::factory()->create();
        $item = Item::create([
            'user_id' => $user->id,
            'name' => 'Test Item',
            'item_image' => '',
            'price' => 1000,
            'description' => 'Test description',
            'condition_id' => $condition->id,
        ]);
        $this->actingAs($user);
        $response = $this->post('/purchase',[
            'payment_method_id' => 1,
            'item_id' => $item->id,
            'item_name' => $item->name,
        ]);

        $response->assertRedirectContains('https://checkout.stripe.com');
    }
}
