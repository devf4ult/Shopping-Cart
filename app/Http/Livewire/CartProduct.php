<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Cart;
use App\CartProduct as AppCartProduct;
use App\Product;

class CartProduct extends Component
{
    public $id;
    public $name;
    public $price;

    public function add()
    {
        // $cart_id = Cart::first();
        // CartPro::create(['cart_id' => $cart_id->id, 'product_id' => $this->id]);
        Cart::first()->products()->attach($this->id);
    }

    public function remove()
    {
        // CartProduct::where('product_id', $this->id)->delete();
        Cart::first()->products()->detach($this->id);
    }

    public function mount($product)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
    }

    public function render()
    {
        return view('livewire.cart-product', [
            'alreadyAdded' => Cart::first()->products()->whereId($this->id)->exists(),
        ]
    );
    }
}
