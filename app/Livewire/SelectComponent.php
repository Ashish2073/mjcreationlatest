<?php

namespace App\Livewire;
use App\Models\Productbrand;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SelectComponent extends Component
{
    use WithFileUploads;
  
    public function render()

    {
        $product_brands=Productbrand::select('name','id')->get();
        return view('livewire.select-component',['product_brands'=>$product_brands]);
    }

    


}
