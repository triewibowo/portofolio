<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use App\Models\Category as ModelsCategory;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Http\Request;

class Product extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name,$image,$desc,$qty,$price,$category_id,$productId;
    public $deleteId = '';

    public function render()
    {
        if(Auth()->user()->can('CRUD')){
            // $products = ModelsProduct::join('categories', 'products.category_id', '=', 'categories.id')->where('products.name', 'like', '%'.$this->search.'%')->orWhere('categories.name', 'LIKE',  '%' . $this->search . '%')->OrderBy('products.created_at', 'DESC')->paginate(15);
            $products = ModelsProduct::with(['category'])->where('name', 'like', '%'.$this->search.'%')->orWhereHas('category',function($query){$query->where('name', 'like', '%'.$this->search.'%');})->OrderBy('products.created_at', 'DESC')->paginate(15);
            $categories = ModelsCategory::all();
            return view('livewire.product', compact('products', 'categories'));
        }else{
            return abort('403');
        }
    }


    public function store(){
        $this->validate([
            'name'          => 'required',
            'image'         => 'image|max:2042|required',
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

        ModelsProduct::create([
            'name'          => $this->name,
            'image'         => $imageName,
            'desc'          => $this->desc,
            'category_id'   => $this->category_id,
            'qty'           => $this->qty,
            'price'         => $this->price,
        ]);

        return session()->flash('success', 'Data has been created'); 
        $this->resetFilters();       
    }

    public function resetFilters(){
        $this->reset();
    }

    public function create(){
        redirect('create');
    }

    public function updatingSearch()
    {
        $this->resetPage();
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

    public function update(){
        $this->validate([
            'name'          => 'required',
            'category_id'   => 'required',
            'desc'          => 'required',
            'qty'           => 'required',
            'price'         => 'required',
        ]);

        

        $product = ModelsProduct::findOrFail($this->productId);
        $product->update([
            'name'          => $this->name,
            'desc'          => $this->desc,
            'category_id'   => $this->category_id,
            'qty'           => $this->qty,
            'price'         => $this->price,
        ]);

        $this->resetFilters();
        return session()->flash('update', 'Data has been updated'); 
        redirect('products');
    }

    public function updateImage(){

        $this->validate([
            'image'         => 'image|max:2042|dimensions:width=500,height=500|required',
        ]);

        $imageName = md5($this->image.microtime().'.'.$this->image->extension());

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

        $product = ModelsProduct::findOrFail($this->productId);
        $product->update([
            'image'          => $imageName
        ]);

        $this->resetFilters();
        return session()->flash('update', 'Image has been updated'); 
        redirect('products');
    }

    public function deleteId($id){
        $this->deleteId = $id;
    }

    public function delete(){
        $category = ModelsProduct::findOrFail($this->deleteId)->delete();
        return session()->flash('update', 'Data has been Deleted'); 
    }
}
