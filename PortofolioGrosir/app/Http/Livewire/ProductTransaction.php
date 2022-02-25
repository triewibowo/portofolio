<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductTransaction as ModelsProductTransaction;

class ProductTransaction extends Component
{   
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $products = ModelsProductTransaction::OrderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.product-transaction', compact('products'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
