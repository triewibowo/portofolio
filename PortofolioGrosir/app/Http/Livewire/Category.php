<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use DB;

class Category extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name;
    public $categoryId;
    public $numbPage = 0;

    public function render()
    {   
        if(Auth()->user()->can('isAdmin')){
        $categories = ModelsCategory::where('name', 'like', '%'.$this->search.'%')->OrderBy('created_at', 'DESC')->paginate($this->numbPage);
        return view('livewire.category', compact('categories'));
        }else{
            return abort('403');
        }
    }

    public function store(){
        $this->validate([
            'name'          => 'required',
        ]);

        DB::beginTransaction();
        try{
            ModelsCategory::updateOrCreate(['id' => $this->categoryId],[
                'name'          => $this->name
            ]);
    
            $this->resetFilter();
            DB::commit();
            return session()->flash('success', 'Successfully'); 
        }catch (\Throwable $th){
            DB::rollback();
            return session()->flash('error', $th);
         }
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
