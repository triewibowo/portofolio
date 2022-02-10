<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class Category extends Component
{
    use WithFileUploads;
    public $name;
    public $categoryId;

    public function render()
    {
        $categories = ModelsCategory::OrderBy('created_at', 'DESC')->get();
        return view('livewire.category', compact('categories'));
    }

    public function store(){
        $this->validate([
            'name'          => 'required',
        ]);

        ModelsCategory::updateOrCreate(['id' => $this->categoryId],[
            'name'          => $this->name
        ]);

        session()->flash('info', 'Product Created Successfully');

            $this->name         = '';
    }

    public function edit($id){
        $category = ModelsCategory::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
    }

    public function resetFilter(){
        $this->reset();
    }

    public function delete($id){
        $category = ModelsCategory::findOrFail($id)->delete();
    }
}
