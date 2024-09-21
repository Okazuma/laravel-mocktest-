<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Item;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Condition;

class ChangePaymentMethodTest extends TestCase
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
        $this->seed(\PaymentMethodSeeder::class);
        $this->seed(\ConditionSeeder::class);
    }


    // 決済方法を変更できているかの確認テストーーーーーーーーーー
    public function test_selects_payment_method()
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

        $paymentMethods = PaymentMethod::create(['name' => 'クレジットカード']);
        $paymentMethods = PaymentMethod::create(['name' => 'コンビニ払い']);
        $paymentMethods = PaymentMethod::create(['name' => '銀行振込']);

        $creditCardPaymentMethod = $paymentMethods->firstWhere('name', 'クレジットカード');

        $this->actingAs($user);

        Livewire::test('purchase-page', ['itemId' => $item->id])
            ->call('selectPaymentMethod', $creditCardPaymentMethod->id)
            ->assertSet('selectedPaymentMethod', $creditCardPaymentMethod->id);
    }
}
