<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class Product extends Component
{
    use WithFileUploads;
    public $name,$image,$desc,$qty,$price,$category_id;

    public function render()
    {
        $products = ModelsProduct::with('category')->OrderBy('created_at', 'DESC')->get();
        $categories = ModelsCategory::all();
        return view('livewire.product', compact('products', 'categories'));
    }

    public function temporaryUrl(){
        $this->validate([
            'image' => 'image|max:2048'
        ]);
    }

    public function store(){
        $this->validate([
            'name'          => 'required',
            'image'         => 'image|max:2048|required',
            'desc'          => 'required',
            'qty'           => 'required',
            'price'         => 'required',
        ]);

        $imageName = md5($this->image.microtime().'.'.$this->image->extension());

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

        ModelsProduct::create([
            'name'          => $this->name,
            'image'         => $imageName,
            'desc'          => $this->desc,
            'category_id'   => $this->category_id,
            'qty'           => $this->qty,
            'price'         => $this->price,
        ]);

        session()->flash('info', 'Product Created Successfully');

            $this->name         = '';
            $this->image        = '';
            $this->category_id  = '';
            $this->desc         = '';
            $this->qty          = '';
            $this->price        = '';

            $this->emit('confirm');
            // $this->dispatchBrowserEvent('closeModal');
    }
}
