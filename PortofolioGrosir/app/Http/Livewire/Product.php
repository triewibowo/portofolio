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
    public $name,$image = null,$desc,$qty,$price,$category_id,$productId;
    public $iteration = 1;

    // public $isOpen = 0;
    // public $edit = 0;

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
            'category_id'   => 'required',
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

        ModelsProduct::updateOrCreate(['id' => $this->productId],[
            'name'          => $this->name,
            'image'         => $imageName,
            'desc'          => $this->desc,
            'category_id'   => $this->category_id,
            'qty'           => $this->qty,
            'price'         => $this->price,
        ]);

        session()->flash('info', 'Product Created Successfully');

            $this->resetFilters();         
    }

    public function resetFilters(){
        $this->reset();
        $this->iteration++;
    }

    public function create(){
        redirect('create');
    }

    public function edit($id){


        $product = ModelsProduct::findOrFail($id);
        $this->productId = $id;
        $this->name = $product->name;
        $this->image = $product->image;
        $this->desc = $product->desc;
        $this->category_id  = $product->category_id;
        $this->qty  = $product->qty;
        $this->price    = $product->price;
    }
}
