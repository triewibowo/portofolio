<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;

class Category extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name;
    public $categoryId;

    public function render()
    {   
        if(Auth()->user()->can('CRUD')){
        $categories = ModelsCategory::where('name', 'like', '%'.$this->search.'%')->OrderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.category', compact('categories'));
        }else{
            return abort('403');
        }
    }

    public function store(){
        $this->validate([
            'name'          => 'required',
        ]);

        ModelsCategory::updateOrCreate(['id' => $this->categoryId],[
            'name'          => $this->name
        ]);

        $this->resetFilter();
        return session()->flash('success', 'Successfully'); 
        redirect('category');
    }

    public function edit($id){
        $category = ModelsCategory::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
    }

    public function resetFilter(){
        $this->reset();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id){
        $category = ModelsCategory::findOrFail($id)->delete();
    }
}
