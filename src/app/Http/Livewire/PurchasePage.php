<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchasePage extends Component
{
    public $searchTerm = '';
    public $items = [];
    public $itemId;
    public $item;
    public $address;
    public $postal_code;
    public $building;
    public $paymentMethods;
    public $selectedPaymentMethod;
    public $showSelect = false;


    protected $listeners = ['searchUpdated' => 'updateSearchTerm'];


    public function mount($itemId)
    {
        $this->itemId = $itemId;
        $this->item = Item::findOrFail($itemId);

        $purchase = Purchase::where('user_id', Auth::id())
                            ->where('item_id', $this->itemId)
                            ->first();
            if ($purchase) {
            $this->postal_code = $purchase->postal_code;
            $this->address = $purchase->address;
            $this->building = $purchase->building;
        } else {
            $this->postal_code = session('postal_code', Auth::user()->postal_code);
            $this->address = session('address', Auth::user()->address);
            $this->building = session('building', Auth::user()->building);
        }
        $this->paymentMethods = PaymentMethod::all();

            if ($this->paymentMethods->isNotEmpty()) {
            $this->selectedPaymentMethod = $this->paymentMethods->first()->id;
        } else {
            $this->selectedPaymentMethod = null;
        }
    }


    public function updateSearchTerm($value)
    {
        $this->searchTerm = $value;
        $this->items = !empty($value)
            ? Item::where('name', 'like', '%' . $value . '%')->get()
            : [];
    }


    public function showPaymentOptions()
    {
        $this->showSelect = true;
    }


    public function selectPaymentMethod($paymentMethodId)
    {
        $this->selectedPaymentMethod = $paymentMethodId;
        $this->showSelect = false;
    }


    public function render()
    {
        return view('livewire.purchase-page', [
            'items' => $this->items,
            'itemDetails' => $this->item,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'building' => $this->building,
            'paymentMethods' => $this->paymentMethods,
            'selectedPaymentMethod' => $this->selectedPaymentMethod,
        ]);
    }
}