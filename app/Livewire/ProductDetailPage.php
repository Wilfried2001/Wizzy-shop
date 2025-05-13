<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - DCodeMania')]

class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    public function mount ($slug){
        $this->slug = $slug;
    }
    public function increaseQuantity(){
        $this->quantity++;
    }
    public function decreaseQuantity(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
    //  add product to cart method
    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title('')
            ->text('Product added to cart successfully !') 
            ->position('bottom-end')
            ->timer(3000)
            ->toast()
            ->success()
            ->show();
    }
    public function render()
    {
        $product = Product::query()->where('slug', $this->slug)->firstOrFail();
        return view('livewire.product-detail-page',[
            'product' => $product
        ]);
    }
}