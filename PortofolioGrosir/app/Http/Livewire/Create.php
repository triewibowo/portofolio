<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;
use DB;

class Create extends Component
{
    use WithFileUploads;
    public $name,$image = null,$desc,$qty,$price,$category_id,$productId;
    public $iteration = 1;

    public function render()
    {
        if(Auth()->user()->can('isAdmin')){
        $products = ModelsProduct::with('category')->OrderBy('created_at', 'DESC')->get();
        $categories = ModelsCategory::all();
        return view('livewire.create', compact('products', 'categories'));
        }else{
            return abort('403');
        }
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

        DB::beginTransaction();
        try{
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
        DB::commit();
        redirect('products');
     }catch (\Throwable $th){
        DB::rollback();
        return session()->flash('error', $th);
     }
    }

    public function resetFilters(){
        $this->reset();
        redirect('products');
    }
}
