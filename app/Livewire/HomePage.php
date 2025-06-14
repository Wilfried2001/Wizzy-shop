<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home Page - DCodeMania')] // pour changer le titre de la page

class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', 1)->get();
        //dd($brands)
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.home-page',[
            'brands' =>$brands,
            'categories' => $categories
        ]);
    }
}