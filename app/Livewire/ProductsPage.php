<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - DCodeMania')] // titre de la page

class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = [];
    
    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured ;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range = 2500;

    #[Url]
    public $sort = 'latest';
    
    // add product to cart method
    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);

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
        $productQuery = Product::query()->where('is_active',1);
        
        $categories = Category::query()->where('is_active', 1)->get(['id','name','slug']);
        if(!empty($this->selected_categories)){
            $productQuery->whereIn('category_id', $this->selected_categories); // requete pour filtrer les categories
        }
        
        $brands = Brand::query()->where('is_active', 1)->get(['id','name','slug']);
        if(!empty($this->selected_brands)){
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        
        if($this->featured){
            $productQuery->where('is_feature',1);
        }
        if($this->on_sale){
            $productQuery->where('on_sale',1);
        }
        
        if($this->price_range){
            $productQuery->whereBetween('price', [0, $this->price_range]);  
        }

        if($this->sort == 'latest'){
            $productQuery->latest();
        }
        
        if($this->sort  == 'price'){
            $productQuery->orderBy('price');
        }
        
        return view('livewire.products-page',[
            'products' => $productQuery->paginate(9),
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}